<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="reg.css">

</head>

<body>
    <div class="container">
        <div class="dbtk">
        <img src="pic.jpg " alt="">
        </div>
    <div class="registration-container">
        <h1>Register Your Account</h1>
        <form action="" method="post">
            <div class="input-container">
                <label for="fname">First name:</label>
                <input type="text" id="fname" name="fname" required>
            </div>
            <div class="input-container">
                <label for="lname">Last name:</label>
                <input type="text" id="lname" name="lname" required>
            </div>
            <div class="input-container">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-container">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-container">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <input type="checkbox" onclick="togglePasswordVisibility('password')"> Show Password
            </div>
            <div class="input-container">
                <label for="cpassword">Confirm Password:</label>
                <input type="password" id="cpassword" name="cpassword" required>
                <input type="checkbox" onclick="togglePasswordVisibility('cpassword')"> Show Password
            </div>
            <div class="input-container">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender">
                    <option value="" selected disabled>Select Gender</option>
                    <option value="men">Men</option>
                    <option value="women">Women</option>
                </select>
            </div>
                <div class="input-container">
                    <label for="province">Province:</label>
                    <input type="text" id="province" name="province" required>
                </div>
                <div class="input-container">
                    <label for="city">City/Municipality:</label>
                    <input type="text" id="city" name="city" required>
                </div>
                <div class="input-container">
                    <label for="barangay">Barangay:</label>
                    <input type="text" id="barangay" name="barangay" required>
                </div>
                <button type="submit" class="btn" name="submit">Register</button>

                <?php
                if (isset($_POST['submit'])) {
                    $con = mysqli_connect('localhost', 'root', '', 'ecommerse');

                    $first_name = $_POST["fname"];
                    $last_name = $_POST["lname"];
                    $username = $_POST["username"];
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    $cpassword = isset($_POST['cpassword']) ? $_POST['cpassword'] : '';
                    $gender = $_POST["gender"];
                    $province = $_POST["province"];
                    $city = $_POST["city"];
                    $barangay = $_POST["barangay"];

                    $password_pattern = '/^(?=.*[A-Z])(?=.*\d).{6,}$/';
                    if (!preg_match($password_pattern, $password)) {
                        echo "<script>alert('Password must contain at least one uppercase letter, one number, and at least 6 characters long');</script>";
                        exit;
                    }

                    if ($password !== $cpassword) {
                        echo "<script>alert('Password and Confirm Password do not match');</script>";
                        exit; 
                    }

                    $password = password_hash($password, PASSWORD_DEFAULT);

                    $checkUsername = mysqli_query($con, "SELECT * FROM sanitation WHERE username = '$username' LIMIT 1");
                    $count = mysqli_num_rows($checkUsername);
                    if ($count == 1) {
                        echo "Username already exists";
                    } else {
                        $result = mysqli_query ($con, "INSERT INTO sanitation (first_name, last_name, username, email, password, gender, province, city, barangay, registration_date)
                        VALUES ('$first_name', '$last_name', '$username', '$email', '$password', '$gender', '$province', '$city', '$barangay', current_timestamp())");

                        if ($result) {
                            $registration_successful = true;
                            echo "<script>alert('Successfully registered');</script>";
                            echo "<script>window.location.href='login.php';</script>";
                            exit();
                        } else {
                            echo "<script>alert('Unable to register');</script>";
                        }
                    }
                }
                ?>


        </form>
    </div>

    <script>
        function togglePasswordVisibility(fieldId) {
            var field = document.getElementById(fieldId);
            if (field.type === "password") {
                field.type = "text";
            } else {
                field.type = "password";
            }

        }

        function validateForm() {
            var password = document.getElementById("password").value;
            var cpassword = document.getElementById("cpassword").value;

            
        }
    </script>

</body>
</html>
