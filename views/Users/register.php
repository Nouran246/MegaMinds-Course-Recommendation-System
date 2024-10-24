<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="../../public/js/signup_and_in.js"></script>
    <link rel="stylesheet" href="../../public/css/templatemo-edu-meeting.css"></head>
    <link href="..\..\public\css\user css\signup_and_in.css" rel="stylesheet">
    
  
<!--     <link href="..\..\MegaMinds-Course-Recommendation-System\public\css\user css\bootstrap.min.css" rel="stylesheet">
 -->
<body>
            
             <div class="scroll-to-section">
                <a href="javascript:void(0)" id="openModal">Join Us Now!</a>
            </div>
          
            
            <div id="loginModal" class="modal">
          
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Sign up</h2>
                    <form>
       
                        <label for="fullname">Full Name</label>
                        <input type="fullname" id="fullname" name="fullname" placeholder="Enter your Full Name" required>
            
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your Email" required>
          
                        
                        <label for="password">Password</label>
                        <div class="password-container">
                            <input type="password" id="password" name="password" placeholder="Enter a Password" required>
                            <button type="button" class="toggle-password" onclick="togglePassword()">&#128065;</button>
                        </div>
                     
                      <label for="password">Confirm Password</label>
                        <div class="password-container">
                            <input type="password" id="password" name="password" placeholder="Confirm your Password" required>
                            <button type="button" class="toggle-password" onclick="togglePassword()">&#128065;</button>
                        </div> 
                       
                        <button type="submit" class="login-btn">Create Account</button>
          
                        
                        <div class="divider">or</div>
                        <button type="button" class="google-btn">
                            <img src="../../public/images/google.png" id="google" alt="Google Logo" class="google-icon">
                            Continue with Google
                        </button>
                        <button type="button" class="microsoft-btn">
                            <img src="../../public/images/microsoft.png" id="microsoft" alt="Google Logo" class="google-icon">
                            Continue with Microsoft
                        </button>
                        <button type="button" class="apple-btn">
                            <img src="../../public/images/apple.png" id="apple" alt="Google Logo" class="google-icon">
                            Continue with Apple
                        </button>
                      
                        <p>Already has an account? <a href="index.php">Sign in</a></p>
                    </form>
                </div>
            </div>
            <script src="../../public/js/user js/Signin_and_up.js"></script>

</body>

</html> 
