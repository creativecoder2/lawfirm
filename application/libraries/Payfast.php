<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payfast {

    protected $CI;
    protected $merchant_id;
    protected $secured_key;
    protected $base_url;
    protected $port;
    protected $mode;
    protected $grant_type = "client_credentials";

    public function __construct($params = array()) {
        $this->CI =& get_instance();
        
        // Load from settings if not passed
        $this->merchant_id = isset($params['merchant_id']) ? $params['merchant_id'] : $this->_get_setting('payfast_merchant_id', '');
        $this->secured_key = isset($params['secured_key']) ? $params['secured_key'] : $this->_get_setting('payfast_secured_key', '');
        $this->base_url    = isset($params['base_url']) ? $params['base_url'] : $this->_get_setting('payfast_base_url', 'https://ipguat.apps.net.pk/Ecommerce/api/Transaction/');
        $this->port        = isset($params['port']) ? $params['port'] : $this->_get_setting('payfast_port', '8443');
        $this->mode        = isset($params['mode']) ? $params['mode'] : $this->_get_setting('payfast_mode', 'sandbox');
    }

    private function _get_setting($key, $default = '') {
        $q = $this->CI->db->get_where('settings', ['key_name' => $key])->row_array();
        return $q ? $q['value'] : $default;
    }

    public function get_token($amount = 0, $basket_id = '', $currency = 'PKR') {
        if (empty($this->merchant_id) || empty($this->secured_key)) {
            return ['status' => 'error', 'error' => 'Merchant ID or Secured Key is missing in settings.'];
        }
        
        // Match Documentation: https://ipguat.apps.net.pk/Ecommerce/api/Transaction/GetAccessToken
        $url = rtrim($this->base_url, '/') . "/GetAccessToken";
        
        $post_params = array(
            'MERCHANT_ID'  => $this->merchant_id,
            'SECURED_KEY'  => $this->secured_key,
            'BASKET_ID'    => $basket_id,
            'TXNAMT'       => $amount,
            'CURRENCY_CODE'=> $currency
        );

        $response = $this->_curl_request($url, 'POST', $post_params);
        $data = json_decode($response, true);
        
        // Match Documentation Response: ACCESS_TOKEN
        if (isset($data['ACCESS_TOKEN'])) {
            $data['token'] = $data['ACCESS_TOKEN']; // Legacy support for my implementation
        }
        
        return $data;
    }

    public function initiate_transaction($token, $appointment_data) {
        $url = $this->base_url . "/transaction";
        
        $ip = $this->CI->input->ip_address();
        if ($ip == '::1') $ip = '127.0.0.1';

        // Prepare parameters for transaction
        // Based on user provided docs for "Initiate Transaction"
        $params = [
            'basket_id'              => $appointment_data['uuid'],
            'txnamt'                 => $appointment_data['consultation_fee'],
            'customer_email_address' => $appointment_data['email'] ?: 'no-reply@legal-eagle.com',
            'customer_mobile_no'     => substr(str_replace(['+', '-', ' '], '', $appointment_data['phone']), 0, 15),
            'order_date'             => date('Y-m-d H:i:s'),
            'customer_ip'            => $ip,
            'merCatCode'             => '1', // Default or from settings
            'account_type_id'        => '1', // Default payment type
            // Add other mandatory fields based on doc
        ];

        // Generate Secured Hash if required (Conditional in docs)
        $params['secured_hash'] = $this->generate_hash($params, 'transaction');

        $headers = [
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $token
        ];

        $response = $this->_curl_request($url, 'POST', $params, $headers);
        return json_decode($response, true);
    }

    public function generate_hash($params, $type) {
        // Based on "Hashed Parameters" section of documentation
        // Example for Initiate Transaction without Token: basket_id + txnamt + card_number+ expiry_month+expiry_year+cvv+otp
        // This needs careful implementation based on which API is being called.
        // For now, providing a helper.
        $data = "";
        
        if ($type === 'transaction') {
            // Simplified hash based on common fields for Bank Account (example in docs: basket_id + txnamt + account_number + cnic_number+otp)
            $data = ($params['basket_id'] ?? '') . ($params['txnamt'] ?? '');
        }

        return hash_hmac('sha256', $data, $this->secured_key);
    }

    public function get_transaction_status($token, $transaction_id) {
        $url = $this->base_url . "/transaction/" . $transaction_id;
        
        $headers = [
            'Authorization: Bearer ' . $token
        ];

        $response = $this->_curl_request($url, 'GET', [], $headers);
        return json_decode($response, true);
    }

    private function _curl_request($url, $method = 'GET', $params = [], $headers = []) {
        if (!function_exists('curl_init')) {
            return json_encode(['status' => 'error', 'message' => 'PHP cURL extension is not enabled on this server. Please enable it in php.ini.']);
        }
        $curl = curl_init();
        
        $default_headers = array(
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
            "User-Agent: Legal Eagle Law Firm" // Mandatory per documentation
        );
        $headers = array_merge($default_headers, $headers);
        
        $options = [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => $method,
        ];

        if ($method == 'POST' && !empty($params)) {
            $options[CURLOPT_POSTFIELDS] = http_build_query($params);
        }

        $options[CURLOPT_HTTPHEADER] = $headers;

        if (!empty($this->port)) {
            $options[CURLOPT_PORT] = $this->port;
        }

        curl_setopt_array($curl, $options);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return json_encode(['error' => $err]);
        }
        
        return $response;
    }
}
