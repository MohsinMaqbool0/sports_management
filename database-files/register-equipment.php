<?php

require('db_con.php');
// Get the date; this is the predefined function in PHP
$date = date('Y-m-d');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $itemName = $_POST["itemName"];
    $sportCategory = $_POST["sportCategory"];
    $brandName = $_POST["brandName"];
    $purchaseDate =  $date;
    $serailID = $_POST["serailID"];

    // Check if the item name already exists
    $checkQuery = "SELECT COUNT(*) AS count FROM c_equipment WHERE e_name = '$itemName'";

    $result = $conn->query($checkQuery);

    if ($result) {
        $row = $result->fetch_assoc();
        $count = $row['count'];


        if ($count > 0) {
            // Item name already exists, redirect with an error message
            unset($_SESSION['message-fail']);
            session_start();
            $_SESSION['message-fail'] = "Item name '$itemName' already exists. Please choose a different name.";
            header("Location: ../add-equipment.php");
            exit();
        } else {
            // Item name is unique, proceed with insertion
            $sql = "INSERT INTO c_equipment (e_name, e_category, e_brand_name, e_purchased_date, e_serail_id)
                    VALUES ('$itemName', '$sportCategory', '$brandName', '$purchaseDate', '$serailID')";

            if ($conn->query($sql) === TRUE) {
                // Redirect on success
                session_start();
                $_SESSION['message-success'] = "Record inserted successfully";
                header("Location: ../add-equipment.php");
                exit();
            } else {
                session_start();
                $_SESSION['message-fail'] = "Error: " . $sql . "<br>" . $conn->error;
                header("Location: ../add-equipment.php");
                exit();
            }
        }
    } else {
        // Error in the database query
        session_start();
        $_SESSION['message-fail'] = "Error checking item name.";
        header("Location: ../add-equipment.php");
        exit();
    }
}

// Close the database connection
$conn->close();
?>
