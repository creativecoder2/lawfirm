<?php
$conn = new mysqli('localhost', 'root', '', 'lawfirm_db', 4307);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 1. Insert Categories
$categories = [
    ['name' => 'Family Law', 'slug' => 'family-law'],
    ['name' => 'Criminal Law', 'slug' => 'criminal-law'],
    ['name' => 'Business Law', 'slug' => 'business-law'],
    ['name' => 'Personal Injury', 'slug' => 'personal-injury'],
    ['name' => 'Education Law', 'slug' => 'education-law'],
    ['name' => 'Drugs Crime', 'slug' => 'drugs-crime']
];

foreach ($categories as $cat) {
    $check = $conn->query("SELECT id FROM blog_categories WHERE slug = '{$cat['slug']}'");
    if ($check->num_rows == 0) {
        $conn->query("INSERT INTO blog_categories (name, slug, is_active) VALUES ('{$cat['name']}', '{$cat['slug']}', 1)");
        echo "Category created: {$cat['name']}\n";
    }
}

// Get Category ID for 'Family Law'
$res = $conn->query("SELECT id FROM blog_categories WHERE slug = 'family-law'");
$family_law_id = $res->fetch_assoc()['id'];

// 2. Insert Original Blog Posts
$blogs = [
    [
        'title' => 'What lawyer can do for you',
        'author' => 'Aliza anne',
        'category_id' => $family_law_id,
        'date_published' => '2018-10-12',
        'image' => 'assets/images/blog-page/1.jpg',
        'description' => 'I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.',
        'slug' => 'what-lawyer-can-do-for-you'
    ],
    [
        'title' => 'who do not know how to pursue pleasure',
        'author' => 'Aliza anne',
        'category_id' => $family_law_id,
        'date_published' => '2018-10-12',
        'image' => 'assets/images/blog-page/2.jpg',
        'description' => 'I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.',
        'slug' => 'who-do-not-know-how-to-pursue-pleasure'
    ],
    [
        'title' => 'How you can find the best justice',
        'author' => 'Aliza anne',
        'category_id' => $family_law_id,
        'date_published' => '2018-10-12',
        'image' => 'assets/images/blog-page/3.jpg',
        'description' => 'I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.',
        'video_url' => 'https://www.youtube.com/embed/uQBL7pSAXR8?autoplay=1',
        'slug' => 'how-you-can-find-the-best-justice'
    ],
    [
        'title' => 'The things only for you',
        'author' => 'Aliza anne',
        'category_id' => $family_law_id,
        'date_published' => '2018-10-12',
        'image' => 'assets/images/blog-page/4.jpg',
        'description' => 'I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.',
        'quote' => 'I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure,',
        'slug' => 'the-things-only-for-you'
    ]
];

foreach ($blogs as $b) {
    $check = $conn->query("SELECT id FROM blogs WHERE slug = '{$b['slug']}'");
    if ($check->num_rows == 0) {
        $cols = implode(", ", array_keys($b));
        $vals = "'" . implode("', '", array_map([$conn, 'real_escape_string'], array_values($b))) . "'";
        $conn->query("INSERT INTO blogs ($cols, is_active) VALUES ($vals, 1)");
        echo "Blog inserted: {$b['title']}\n";
    }
}

$conn->close();
?>
