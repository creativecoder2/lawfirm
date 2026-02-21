<?php
include 'index.php';
$CI =& get_instance();

$data = [
    'bio' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.',
    'education' => "Admization Institute of Law and Technology\nAcademy University School of Law, Boston, MA\nThe Syntify High School Of New York\nEducation & Court Admissions",
    'experience' => '10 Years',
    'phone' => '+92 322 4490008',
    'email' => 'legallaw669@gmail.com',
    'address' => 'Office no 3 2nd floor, Kareem chamber, road, Mozang Chungi, Lahore, 54000',
    'languages' => 'French(fluent), English (fluent), Greek, Chinese'
];

// Update all team members with these defaults if they are empty
$teams = $CI->db->get('teams')->result();
foreach ($teams as $team) {
    $update = [];
    foreach ($data as $key => $value) {
        if (empty($team->$key)) {
            $update[$key] = $value;
        }
    }
    if (!empty($update)) {
        $CI->db->where('id', $team->id)->update('teams', $update);
        echo "Updated team member: " . $team->name . "\n";
    }
}

echo "Done!";
