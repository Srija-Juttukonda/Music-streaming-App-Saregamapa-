<?php
include("includes/includedFiles.php");
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the commentText and albumId are set
    if (isset($_POST['commentText']) && isset($_POST['albumId'])) {
        $commentText = $_POST['commentText'];
        $albumId = $_POST['albumId'];
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert the comment into the database (adjust column names accordingly)
        $sql = "INSERT INTO comments (albumId, comment_text) VALUES ('$albumId', '$commentText')";

        if ($conn->query($sql) === TRUE) {
            echo "Comment added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        echo "Missing data to add comment";
    }
} else {
    echo "Invalid request";
}
?>