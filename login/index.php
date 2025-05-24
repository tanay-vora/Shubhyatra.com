<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Shubh Yatra</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #EEE5DA;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }

        /* Navbar Styles */
        .navbar {
            position: absolute;
            top: 0;
            width: 100%;
            background: #262424; /* Blue background */
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar .logo img {
            height: 40px;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
        }

        .navbar ul li {
            display: inline;
        }

        .navbar ul li a {
            text-decoration: none;
            color: #262424; /* White text */
            font-size: 16px;
            font-weight: bold;
            padding: 8px 12px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .navbar ul li a:hover {
            background: #EEE5DA;
            color: #262424; /* Blue text on hover */
        }

        .login-container {
            background: #262424; /* Updated to requested color */
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 320px;
            margin-top: 80px;
        }

        .login-container h2 {
            margin-bottom: 1rem;
            color: #EEE5DA;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #DFE8E6;
            border-radius: 5px;
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background: #EEE5DA;
            border: none;
            color: #262424;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-container button:hover {
            background: #EFE9E0;
        }

        .login-container p {
            margin-top: 10px;
            font-size: 14px;
            color: #EEE5DA;
        }

        .login-container a {
            color: #EEE5DA;
            text-decoration: none;
        }

        .login-container a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <a href="new.html">
                <img src="assets/Logo.png" alt="Shubh Yatra Logo">
            </a>
        </div>
        <ul>
            <li><a href="new.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
    </nav>

    <!-- Login Form -->
    <div class="container" id="signup" style="display:none;">
        <h1 class="form-title">Register</h1>
        <form method="post" action="register.php">
          <div class="input-group">
             <i class="fas fa-user"></i>
             <input type="text" name="fName" id="fName" placeholder="First Name" required>
             <label for="fname">First Name</label>
          </div>
          <div class="input-group">
              <i class="fas fa-user"></i>
              <input type="text" name="lName" id="lName" placeholder="Last Name" required>
              <label for="lName">Last Name</label>
          </div>
          <div class="input-group">
              <i class="fas fa-envelope"></i>
              <input type="email" name="email" id="email" placeholder="Email" required>
              <label for="email">Email</label>
          </div>
          <div class="input-group">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" id="password" placeholder="Password" required>
              <label for="password">Password</label>
          </div>
         <input type="submit" class="btn" value="Sign Up" name="signUp">
        </form>
        <p class="or">
          ----------or--------
        </p>
        <div class="icons">
          <i class="fab fa-google"></i>
          <i class="fab fa-facebook"></i>
        </div>
        <div class="links">
          <p>Already Have Account ?</p>
          <button id="signInButton">Sign In</button>
        </div>
      </div>
  
      <div class="container" id="signIn">
          <h1 class="form-title">Sign In</h1>
          <form method="post" action="register.php">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <p class="recover">
              <a href="#">Recover Password</a>
            </p>
           <input type="submit" class="btn" value="Sign In" name="signIn">
          </form>
          <p class="or">
            ----------or--------
          </p>
          <div class="icons">
            <i class="fab fa-google"></i>
            <i class="fab fa-facebook"></i>
          </div>
          <div class="links">
            <p>Don't have account yet?</p>
            <button id="signUpButton">Sign Up</button>
          </div>
        </div>
        <script src="script.js"></script>
</body>
</html>

