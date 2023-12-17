<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name=$_POST["name"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $dob = $_POST["dob"];
    if (empty($name) || empty($mobile) || empty($email) || empty($dob)) {
        echo "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
    } elseif (!preg_match('/^\d{10}$/', $mobile)) {
        echo "Invalid mobile number. It should be 10 digits.";
    } else {
        $db_host = "localhost:3308";
        $db_username = "root";
        $db_password = "";
        $db_name = "register";
        $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name); 
        if (!$conn) {
            die("Database connection failed:".mysqli_connect_error());
        }
        $query_email = "SELECT * FROM form WHERE email = '$email'";
        $query_mobile = "SELECT * FROM form WHERE mobile = '$mobile'";
        $result_email = mysqli_query($conn, $query_email);
        $result_mobile = mysqli_query($conn, $query_mobile);
        if (mysqli_num_rows($result_email) > 0) {
            echo "Email already exists.";
        } elseif (mysqli_num_rows($result_mobile) > 0) {
            echo "Mobile number already exists.";
        } else {
            $currentDate = new DateTime();
            $dobDate = new DateTime($dob);
            $age = $currentDate->diff($dobDate)->y;
            if ($age < 18) {
                echo "You must be at least 18 years old to register.";
            } else {
                $name = mysqli_real_escape_string($conn, $name);
                $mobile = mysqli_real_escape_string($conn, $mobile);
                $email = mysqli_real_escape_string($conn, $email);
                $dob = mysqli_real_escape_string($conn, $dob);

                $insert_query = "INSERT INTO form (name,mobile, email, dob) VALUES ('$name','$mobile', '$email', '$dob')";

                if (mysqli_query($conn, $insert_query)) {
                    header("location:password_set.php");
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            }
        }
        mysqli_close($conn);
    }
}
?>