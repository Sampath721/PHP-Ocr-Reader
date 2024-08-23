<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_FILES['photo']['name'])) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['photo']['name']);
        
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
            header("Location: process.php?file=" . urlencode($uploadFile));
            exit;
        } else {
            echo "Failed to upload file.";
        }
    } else {
        echo "No file selected.";
    }
} else {

    echo "Invalid request method.";
}
