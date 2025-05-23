<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);

            // Database connection
            // Only need to make changes in below section reset will be exact same
        $servername = "mysql_container_name";
        $username = "root";         // change if needed
        $password = "mysql_db_password";           // change if needed
        $dbname = "mysql_db_name";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data
    $stmt = $conn->prepare("INSERT INTO users (name, phone, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $phone, $email);

    if ($stmt->execute()) {
        echo "<h2 style='text-align:center; color:green;'>Login Successful!</h2>";
        echo "<p style='text-align:center;'>Welcome, $name</p>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
