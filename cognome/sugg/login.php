<!DOCTYPE html>
<html>
<head>
  <!--
    References: https://www.rexegg.com/regex-php.html
    https://www.washington.edu/accesscomputing/webd2/student/unit5/module2/lesson5.html
    https://zinoui.com/blog/storing-passwords-securely
  -->
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Hippocampus Region Models and Theories</title>
  <link rel="stylesheet" type="text/css" href="../main.css">
  <?php include('set_theme.php'); ?>
  <?php include('../function/hc_header.php'); ?>
  <script type="text/javascript">
    function toggle_vis(elem_name) {
       var elem = document.getElementById(elem_name);
       if (elem.style.display === "none") {
        elem.style.display = "block";
      } else {
        elem.style.display = "none";
      }
    }
  </script>
</head>
<body>
  <?php include("../function/hc_body.php"); ?>
  <div style="width:90%;position:relative;left:5%;"> 
    <br><br>
  <!-- start of header -->
  <?php echo file_get_contents('header.html'); ?>
  <script type='text/javascript'>
    document.getElementById('header_title').innerHTML="<a href='login.php' style='text-decoration: none;color:black !important'><span class='title_section'>Please Log In or Register</span></a>";
  </script>
  <!-- end of header -->
  
  <?php
  include('mysql_connect.php');  

  if (isset($_POST['username']) & isset($_POST['password'])) {
    include('secret_key.php');
    //echo $_POST['username']."<br><br>".$_POST['password'];
    $sql = "SELECT AES_DECRYPT(`password`, '".$pass_enc_secret_key."') AS `password` FROM natemsut_cog_sug.accounts WHERE username='".$_POST['username']."';";
    echo $sql;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) { 
      $pass_match = $result->fetch_assoc()['password'];
      if ($pass_match == $_POST['password']) {
        $_SESSION['user_login'] = $_POST['username'];
        echo '<br>Registered user found. Redirecting in 3 seconds.<br>';
        sleep(3);
        header("Location: mod_art.php"); 
        exit();        
      }
    }    
  }

  echo "<div class='article_details' style='text-align: center;margin: 0 auto;padding: .4rem;font-size:.7em;'>";
  if (isset($_GET['logout'])) {
    if ($_GET['logout'] == 'true') {
      $_SESSION['user_login'] = '';
      echo "<br><span style='font-size:1.3em;'>Successfully logged out.</span>";
    }
  }
  echo "<form action='login.php' method='POST'><br>Username &nbsp&nbsp<input type='text' name='username'></input><br><br>Password &nbsp&nbsp<input type='password' name='password'></input><br><br><input type='submit' value='Login' style='font-size:.9em;padding-top:5px;padding-bottom:5px;padding-left:20px;padding-right:20px;'></form><br><br><span style='font-size:1.3em'><a href='reset_pass.php'>Reset Password</a></span><br><span style='font-size:1.3em'><a href='register.php'>Register a New Account</a></span><br><br>";

  echo "</div><br><br>";  
  
  $conn->close();

  ?>
</div>
</body>
</html>  