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

echo "Populating original case studies...\n";

// TRUNCATE case_studies to start fresh
$conn->query("TRUNCATE TABLE case_studies");
echo "Table 'case_studies' truncated.\n";

// Helper function to get category ID
function getCategoryId($conn, $slug) {
    $result = $conn->query("SELECT id FROM case_categories WHERE slug = '$slug'");
    if ($result->num_rows > 0) {
        return $result->fetch_assoc()['id'];
    }
    return null; // Should not happen if populate_categories.php ran
}

// Common Description (from the details page design)
$common_desc = "I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born. I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. \n\nNor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it?";

// Original Case Studies Data (reconstructed from standard template/previous context)
$cases = [
    [
        'category_slug' => 'Family-Matters',
        'title' => 'Family Issue',
        'subtitle' => 'Legal advice for family related issues', // Restoring assumed subtitle
        'image' => 'assets/images/studies/1.jpg',
        'description' => $common_desc
    ],
    [
        'category_slug' => 'Real-Estate',
        'title' => 'House Problem',
        'subtitle' => 'Real estate dispute resolution',
        'image' => 'assets/images/studies/2.jpg',
        'description' => $common_desc
    ],
    [
        'category_slug' => 'Business',
        'title' => 'Business Accounting',
        'subtitle' => 'Corporate financial legal services',
        'image' => 'assets/images/studies/3.jpg',
        'description' => $common_desc
    ],
    [
        'category_slug' => 'Criminal',
        'title' => 'Criminal Defense',
        'subtitle' => 'Expert defense for criminal charges',
        'image' => 'assets/images/studies/4.jpg',
        'description' => $common_desc
    ],
    [
        'category_slug' => 'Injury',
        'title' => 'Personal Injury',
        'subtitle' => 'Compensation for accident victims',
        'image' => 'assets/images/studies/5.jpg',
        'description' => $common_desc
    ],
    [
        'category_slug' => 'Education-Law',
        'title' => 'Education Dispute',
        'subtitle' => 'Legal support for educational matters',
        'image' => 'assets/images/studies/1.jpg', // Reusing image if 6.jpg not guaranteed
        'description' => $common_desc
    ]
];

$stmt = $conn->prepare("INSERT INTO case_studies (category_id, title, subtitle, image, description, is_active, order_index) VALUES (?, ?, ?, ?, ?, 1, ?)");

$order = 0;
foreach ($cases as $case) {
    $cat_id = getCategoryId($conn, $case['category_slug']);
    
    if ($cat_id) {
        $order++;
        $stmt->bind_param("issssi", $cat_id, $case['title'], $case['subtitle'], $case['image'], $case['description'], $order);
        if ($stmt->execute()) {
            echo "Inserted: " . $case['title'] . " (Category ID: $cat_id)\n";
        } else {
            echo "Error inserting " . $case['title'] . ": " . $stmt->error . "\n";
        }
    } else {
        echo "Category ID not found for slug: " . $case['category_slug'] . "\n";
    }
}

$stmt->close();
$conn->close();
?>
