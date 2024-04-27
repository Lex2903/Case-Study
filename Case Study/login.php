<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" a href="login.css" />
  <title>Login</title>

</head>

<body>
  <div class="container">
    <div class="dbtk">
      <img src="pic.jpg " alt="">
    </div>
    <div class="login-container">
      <h2>Login</h2>
      <form action="" method="post">
        <div class="input-container">
          <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
            <path d="M24 21h-24v-18h24v18zm-23-16.477v15.477h22v-15.477l-10.999 10-11.001-10zm21.089-.523h-20.176l10.088 9.171 10.088-9.171z" />
          </svg>
          <input type="text" id="username" name="username" />
        </div>
        <div class="input-container">
          <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
            <path d="M16 1c-4.418 0-8 3.582-8 8 0 .585.063 1.155.182 1.704l-8.182 7.296v5h6v-2h2v-2h2l3.066-2.556c.909.359 1.898.556 2.934.556 4.418 0 8-3.582 8-8s-3.582-8-8-8zm-6.362 17l3.244-2.703c.417.164 1.513.703 3.118.703 3.859 0 7-3.14 7-7s-3.141-7-7-7c-3.86 0-7 3.14-7 7 0 .853.139 1.398.283 2.062l-8.283 7.386v3.552h4v-2h2v-2h2.638zm.168-4l-.667-.745-7.139 6.402v1.343l7.806-7zm10.194-7c0-1.104-.896-2-2-2s-2 .896-2 2 .896 2 2 2 2-.896 2-2zm-1 0c0-.552-.448-1-1-1s-1 .448-1 1 .448 1 1 1 1-.448 1-1z" />
          </svg>
          <input type="password" id="password" name="password" />
          <input type="checkbox" onclick="togglePasswordVisibility('password')"> Show Password
        </div>
        <input type="submit" value="submit" />
        <div class="register">  
          <p>Not Registered? <a href="Registration.php">Sign up here</a></p>
        </div>

        <?php
        session_start(); // Start the session

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Database connection
            $con = mysqli_connect('localhost', 'root', '', 'ecommerse');

            // Sanitize and validate input fields
            $username = $_POST["username"];
            $password = $_POST["password"];

            // Fetch user data from the database
            $query = "SELECT * FROM sanitation WHERE username = '$username' LIMIT 1";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $hashed_password = $row['password'];

                // Compare the entered password with the hashed password from the database
                if (password_verify($password, $hashed_password)) {
                    // Password is correct, redirect the user
                    $_SESSION['username'] = $username; // Store the username in session
                    header("Location: homepage.php"); // Redirect to dashboard or any other page
                    exit();
                } else {
                    echo "<script>alert('Invalid username or password');</script>";
                }
            } else {
                echo "<script>alert('Invalid username or password');</script>";
            }

            // Close the database connection
            mysqli_close($con);
        }
        ?>


      </form>
    </div>
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

            
        }
    </script>

</body>

</html>