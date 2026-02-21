<?php
// Database configuration
$servername = "localhost";
$username = "";
$password = "";
$dbname = "lawfirm_db";
$port = 4307;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully\n";

// Function to execute query
function run_query($conn, $sql) {
    if ($conn->query($sql) === TRUE) {
        echo "Query executed successfully\n";
    } else {
        echo "Error: " . $sql . "\n" . $conn->error . "\n";
    }
}

// Clear existing data to prevent duplicates
$tables = ['sliders', 'features', 'practice_areas', 'testimonials', 'teams'];
foreach ($tables as $t) {
    run_query($conn, "TRUNCATE TABLE $t");
}

// Sliders
$sliders = [
    ['assets/images/slider/3.jpg', 'We Fight For Your Justice As Like A Friend.', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form'],
    ['assets/images/slider/1.jpg', 'We Fight For Your Justice As Like A Friend.', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form'],
    ['assets/images/slider/4.jpg', 'We Fight For Your Justice As Like A Friend.', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form']
];

foreach ($sliders as $index => $s) {
    $img = $conn->real_escape_string($s[0]);
    $title = $conn->real_escape_string($s[1]);
    $sub = $conn->real_escape_string($s[2]);
    $sql = "INSERT INTO sliders (image, title, subtitle, order_index) VALUES ('$img', '$title', '$sub', $index)";
    run_query($conn, $sql);
}

// Features
$features = [
    ['fi flaticon-employee', 'Book Your', 'Appointment'],
    ['fi flaticon-balance', 'Get Free', 'Expert Advice'],
    ['fi flaticon-network', 'You Can Easily', 'Join Our Team']
];

foreach ($features as $index => $f) {
    $icon = $conn->real_escape_string($f[0]);
    $sub = $conn->real_escape_string($f[1]);
    $title = $conn->real_escape_string($f[2]);
    $sql = "INSERT INTO features (icon, title, subtitle, order_index) VALUES ('$icon', '$title', '$sub', $index)";
    run_query($conn, $sql);
}

// Settings
$settings = [
    'about_image' => 'assets/images/about/img-2.png',
    'video_url' => 'https://www.youtube.com/embed/uQBL7pSAXR8?autoplay=1',
    'about_title' => 'Building Trust Through Decades of Service',
    'about_text' => "Founded in 2020 by Maaz Ahmed, our firm began with a simple mission: to provide exceptional legal representation to those who needed it most. What started as a small practice has grown into one of the region’s most respected law firms.\n\nOver the years, we’ve expanded our practice areas and welcomed talented attorneys who share our commitment to excellence. Today, our team of over 6 attorneys brings diverse expertise and a unified dedication to achieving the best possible outcomes for our clients.",
    'consultation_title' => 'Ready to Discuss Your Case?',
    'consultation_text' => "Don’t wait to protect your rights. Contact us today for a free, confidential consultation and let our experienced attorneys fight for the justice you deserve.",
    'contact_address' => 'Office no 3 2nd floor, Kareem chamber, road, Mozang Chungi, Lahore, 54000',
    'contact_phone' => '+92 322 4490008',
    'contact_email' => 'legallaw669@gmail.com'
];

foreach ($settings as $key => $value) {
    $k = $conn->real_escape_string($key);
    $v = $conn->real_escape_string($value);
    $sql = "REPLACE INTO settings (key_name, value) VALUES ('$k', '$v')";
    run_query($conn, $sql);
}

// Practice Areas
$practice = [
    ['fi flaticon-mafia', 'Crinimal Defence', 'Protecting your freedom with aggresive defence strategies for all crinimal and charges'],
    ['fi flaticon-grandparents', 'Family Law', 'Compassionate guidance through divorce, custody and family legal matters'],
    ['fi flaticon-wounded', 'Immigration Law', 'Navigating complex immigration processes with expertise and dedication.'],
    ['fi flaticon-manager', 'Real Estate Law', 'Expert legal assistance in property transactions, transfers, leasing, and real estate dispute resolution.'],
    ['fi flaticon-balance', 'Tax Lawyer', 'Strategic legal advice on tax compliance, disputes, and regulatory matters to protect your financial interests.'],
    ['fi flaticon-balance', 'Civil Ligitation', 'Effective representation in civil disputes, offering strategic advice and courtroom advocacy to achieve fair outcomes.']
];

foreach ($practice as $index => $p) {
    $icon = $conn->real_escape_string($p[0]);
    $title = $conn->real_escape_string($p[1]);
    $desc = $conn->real_escape_string($p[2]);
    $sql = "INSERT INTO practice_areas (icon, title, description, order_index) VALUES ('$icon', '$title', '$desc', $index)";
    run_query($conn, $sql);
}

// Testimonials
$testimonials = [
    ['assets/images/testimonials/1.png', 'Ahmad Naeem', 'Tax Law Client', 'I highly recommend Muhammad Mazz Ahmad for Criminal and Tax cases. They handled all my cases with exceptional knowledge and communication, keeping me informed every step of the way. Mazz was incredibly responsive and empathetic, making a stressful time much easier.'],
    ['assets/images/testimonials/2.png', 'Uzair Afridi', 'Family law', 'Great Experience with Legal Eagle Law Firm Legal Eagle Law Firm is professional, knowledgeable, and reliable. They explained everything clearly and handled my case efficiently. The team was responsive and supportive throughout the process.'],
    ['assets/images/testimonials/3.png', 'Rana Awais', 'Customer Title', 'Great Experience with Legal Eagle Law Firm Highly professional law firm delivering accurate legal opinions with integrity, clarity, timely guidance, and client-focused expertise in law firm industry']
];

foreach ($testimonials as $index => $t) {
    $img = $conn->real_escape_string($t[0]);
    $name = $conn->real_escape_string($t[1]);
    $desig = $conn->real_escape_string($t[2]);
    $msg = $conn->real_escape_string($t[3]);
    $sql = "INSERT INTO testimonials (image, name, designation, message, order_index) VALUES ('$img', '$name', '$desig', '$msg', $index)";
    run_query($conn, $sql);
}

// Teams
$teams = [
    ['assets/images/team/1.jpg', 'Maaz Ahmed Warriach AHC', 'Head Founder', 'Family gaurdian and constitutional law'],
    ['assets/images/team/2.jpg', 'Shoaib Ashraf Bhatti', 'Partner', 'Secretary Lahore Bar Association'],
    ['assets/images/team/3.jpg', 'Muhammad Umer Farooq', 'Partner', 'Criminal Lawyer'],
    ['assets/images/team/4.jpg', 'Malik Kafeel Khokhar', 'Partner', 'Corporate Lawyer'],
    ['assets/images/team/5.jpg', 'Arshad Aziz AHC', 'Partner', 'Civil Litigation']
];

foreach ($teams as $index => $t) {
    $img = $conn->real_escape_string($t[0]);
    $name = $conn->real_escape_string($t[1]);
    $desig = $conn->real_escape_string($t[2]);
    // Added description matching static content although schema doesn't have description column for teams?
    // Wait, update_db.php for teams: name, designation, image, facebook, twitter, linkedin, order_index.
    // There is NO description column in teams table.
    // I should NOT try to insert description.
    // I should stick to the schema.
    $sql = "INSERT INTO teams (image, name, designation, order_index) VALUES ('$img', '$name', '$desig', $index)";
    run_query($conn, $sql);
}

$conn->close();
?>
