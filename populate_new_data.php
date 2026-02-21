<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lawfirm_db";
$port = 4307;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Case Studies Data
$case_studies = [
    [
        'title' => 'General Practice',
        'subtitle' => 'Corporate',
        'category' => 'Family Matters Business Injury',
        'image' => 'assets/images/studies/1.jpg',
        'is_active' => 1,
        'order_index' => 1
    ],
    [
        'title' => 'Personal Issue',
        'subtitle' => 'General',
        'category' => 'Family-Matters Real-Estate Criminal',
        'image' => 'assets/images/studies/2.jpg',
        'is_active' => 1,
        'order_index' => 2
    ],
    [
        'title' => 'Business Accounting',
        'subtitle' => 'Business',
        'category' => 'Family-Matters Business Criminal Injury',
        'image' => 'assets/images/studies/3.jpg',
        'is_active' => 1,
        'order_index' => 3
    ],
    [
        'title' => 'Criminal Defense',
        'subtitle' => 'Criminal',
        'category' => 'Real-Estate Criminal Injury',
        'image' => 'assets/images/studies/4.jpg',
        'is_active' => 1,
        'order_index' => 4
    ],
    [
        'title' => 'Family Law',
        'subtitle' => 'Family Issue',
        'category' => 'Real-Estate Business Criminal Family-Matters Injury',
        'image' => 'assets/images/studies/5.jpg',
        'is_active' => 1,
        'order_index' => 5
    ],
    [
        'title' => 'General Practice',
        'subtitle' => 'Corporate',
        'category' => 'Family Matters Business Injury',
        'image' => 'assets/images/studies/6.jpg',
        'is_active' => 1,
        'order_index' => 6
    ]
];

// Counters Data
$counters = [
    [
        'title' => 'Cases Won',
        'count_value' => '95%',
        'icon' => 'fi flaticon-lawyer',
        'is_active' => 1,
        'order_index' => 1
    ],
    [
        'title' => 'Trusted Client',
        'count_value' => '863',
        'icon' => 'fi flaticon-user',
        'is_active' => 1,
        'order_index' => 2
    ],
    [
        'title' => 'Dedicated Lawyer',
        'count_value' => '126+',
        'icon' => 'fi flaticon-employee',
        'is_active' => 1,
        'order_index' => 3
    ],
    [
        'title' => 'Case Dismissed',
        'count_value' => '25%',
        'icon' => 'fi flaticon-scale',
        'is_active' => 1,
        'order_index' => 4
    ]
];

// Blogs Data
$blogs = [
    [
        'title' => 'Justice May For You If You Are Innocent',
        'author' => 'Aliza anne',
        'date_published' => '2019-10-12',
        'link' => '#',
        'image' => 'assets/images/blog/1.jpg',
        'is_active' => 1,
        'order_index' => 1
    ],
    [
        'title' => 'Justice May For You If You Are Innocent',
        'author' => 'Aliza anne',
        'date_published' => '2019-10-12',
        'link' => '#',
        'image' => 'assets/images/blog/2.jpg',
        'is_active' => 1,
        'order_index' => 2
    ],
    [
        'title' => 'Justice May For You If You Are Innocent',
        'author' => 'Aliza anne',
        'date_published' => '2019-10-12',
        'link' => '#',
        'image' => 'assets/images/blog/3.jpg',
        'is_active' => 1,
        'order_index' => 3
    ]
];

// Insert Case Studies
echo "Inserting Case Studies...\n";
$stmt = $conn->prepare("INSERT INTO case_studies (title, subtitle, category, image, is_active, order_index) VALUES (?, ?, ?, ?, ?, ?)");
foreach ($case_studies as $cs) {
    // Check if exists
    $check = $conn->query("SELECT id FROM case_studies WHERE title = '".$cs['title']."' AND subtitle = '".$cs['subtitle']."'");
    if ($check->num_rows == 0) {
        $stmt->bind_param("ssssii", $cs['title'], $cs['subtitle'], $cs['category'], $cs['image'], $cs['is_active'], $cs['order_index']);
        if ($stmt->execute()) {
            echo "Inserted Case Study: " . $cs['title'] . "\n";
        } else {
            echo "Error inserting Case Study: " . $stmt->error . "\n";
        }
    } else {
        echo "Case Study already exists: " . $cs['title'] . "\n";
    }
}
$stmt->close();

// Insert Counters
echo "\nInserting Counters...\n";
$stmt = $conn->prepare("INSERT INTO counters (title, count_value, icon, is_active, order_index) VALUES (?, ?, ?, ?, ?)");
foreach ($counters as $c) {
    $check = $conn->query("SELECT id FROM counters WHERE title = '".$c['title']."'");
    if ($check->num_rows == 0) {
        $stmt->bind_param("sssii", $c['title'], $c['count_value'], $c['icon'], $c['is_active'], $c['order_index']);
        if ($stmt->execute()) {
            echo "Inserted Counter: " . $c['title'] . "\n";
        } else {
            echo "Error inserting Counter: " . $stmt->error . "\n";
        }
    } else {
        echo "Counter already exists: " . $c['title'] . "\n";
    }
}
$stmt->close();

// Insert Blogs
echo "\nInserting Blogs...\n";
$stmt = $conn->prepare("INSERT INTO blogs (title, author, date_published, link, image, is_active, order_index) VALUES (?, ?, ?, ?, ?, ?, ?)");
foreach ($blogs as $b) {
    $check = $conn->query("SELECT id FROM blogs WHERE title = '".$b['title']."' AND date_published = '".$b['date_published']."'");
    if ($check->num_rows == 0) {
        $stmt->bind_param("sssssii", $b['title'], $b['author'], $b['date_published'], $b['link'], $b['image'], $b['is_active'], $b['order_index']);
        if ($stmt->execute()) {
            echo "Inserted Blog: " . $b['title'] . "\n";
        } else {
            echo "Error inserting Blog: " . $stmt->error . "\n";
        }
    } else {
        echo "Blog already exists: " . $b['title'] . "\n";
    }
}
$stmt->close();

$conn->close();
echo "\nData population completed.\n";
?>
