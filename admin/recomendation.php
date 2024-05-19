<?php

require('inc/db_config.php');
 require('inc/links.php');

// Function to calculate cosine similarity
function cosineSimilarity($vec1, $vec2)
{
    $dotProduct = 0;
    $magnitude1 = 0;
    $magnitude2 = 0;

    foreach ($vec1 as $key => $value) {
        if (isset($vec2[$key]) && is_numeric($value) && is_numeric($vec2[$key])) {
            $dotProduct += $value * $vec2[$key];
            $magnitude1 += $value * $value;
            $magnitude2 += $vec2[$key] * $vec2[$key];
        }
    }

    $magnitude = sqrt($magnitude1) * sqrt($magnitude2);

    return $magnitude != 0 ? $dotProduct / $magnitude : 0;
}



// Get selected room's attributes from the database
$selectedRoomId = $_GET['id']; // Assuming you are using POST to send selected room ID
$selectedRoomAttributes = array();

$sql = "SELECT area, adult,children, price FROM rooms WHERE id = $selectedRoomId ";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $selectedRoomAttributes = array(
            'facilities' => explode(",", $row['area']),
            'num_adults' => $row['adult'],
            'num_children' => $row['children'],
            'price' => $row['price']
        );
    }
}

// Get all other room attributes from the database
$allRoomsAttributes = array();

$sql = "SELECT id, area, adult,children, price FROM rooms WHERE id != $selectedRoomId AND status=1 AND removed=0";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $allRoomsAttributes[$row['id']] = array(
            'facilities' => explode(",", $row['area']),
            'num_adults' => $row['adult'],
            'num_children' => $row['children'],
            'price' => $row['price']
        );
    }
}

// Calculate cosine similarity for each room
$similarities = array();

foreach ($allRoomsAttributes as $roomId => $attributes) {
    $similarity = cosineSimilarity($selectedRoomAttributes, $attributes);
    $similarities[$roomId] = $similarity;
}

// Display recommended rooms (limited to top 5)
echo "Recommended Rooms:\n";
$top5Similarities = array_slice($similarities, 0, 5, true); // Get the top 5 similarities

foreach ($top5Similarities as $roomId => $similarity) {
    // Fetch room details from the database
    $sql = "SELECT * FROM rooms WHERE id = $roomId";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $facilities = implode(", ", explode(",", $row['area']));
        

        // Display room details
        echo "Room ID: $roomId\n";
        echo "Similarity: $similarity\n";
        echo "Facilities: $facilities\n";
        echo "Number of Adults: {$row['adult']}\n";
        echo "Number of Children: {$row['children']}\n";
        echo "Price: {$row['price']}\n";
        // echo "Image URL: $image_url\n";
        echo "\n";
    }
}


// Close the database connection
$con->close();

?>
