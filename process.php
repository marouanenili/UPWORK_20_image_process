<?php
//change this to your db parameters
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "mysql_dogs_images";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_FILES['image']['error'] == 0) {
    $image = $_FILES['image']['tmp_name'];
    $destination = 'images/' . $_FILES['image']['name'];
    if (move_uploaded_file($image, $destination)){
        // Get the directory of the uploaded image
        $image_directory = $destination;

        // Insert the directory of the uploaded image into the database
        $sql = "INSERT INTO dogs (directori) VALUES ('$image_directory')";

        if (mysqli_query($conn, $sql)) {
            echo "Image directory inserted into the database successfully";
        } else {
            echo "Error inserting the image directory into the database: " . mysqli_error($conn);
        }

        exec("python3 process_houses.py $destination", $output, $status);
        echo "The image has been stylized!";
    } else {
        echo "Error uploading the image to the images directory";
    }
}

mysqli_close($conn);
?>
