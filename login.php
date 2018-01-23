<?php
  require('config.php');
  $error=''; // Variable To Store Error Message

  if (isset($_POST['logIn'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
      $error = "Username or Password is invalid";
    }
    else
    {
      // Define $username and $password
      $username=$_POST['username'];
      $password=$_POST['password'];

      global $database;
      // To protect MySQL injection for Security purpose
      $username = stripslashes($username);
      $username = $database->quote($username);
      $password = hash( 'sha256', $password);

      // SQL query to fetch information of registerd users and finds user match.
      $get_current_user = $database->prepare("SELECT * FROM users WHERE pass='$password' AND username=$username");
      $rows = count($get_current_user);

      $get_current_user->execute();
      $get_user = $get_current_user->fetchAll();
      $get_current_user->closeCursor();

      if ($rows == 1)
      {
        foreach($get_user as $user)
        {
          $_SESSION['user_id']=$user['id'];
          $_SESSION['login_user']=$user['username'];
          $_SESSION['role']=$user['role'];
          $_SESSION['first_name']=$user['first_name'];
          $_SESSION['last_name']=$user['last_name'];
        }

        if( $_SESSION['role'] == 'admin' )
        {
          header("Location: /?page=newLog"); // Redirecting To Other Page
          exit;
        }
        else if( $_SESSION['role'] == 'user' )
        {
          header("Location: /?page=myLogs"); // Redirecting To Other Page
          exit;
        }
        else
        {
          header("Location: /"); // Redirecting To Other Page
          exit;
        }
      } else {
        $error = "Username or Password is invalid";
      }
      // mysql_close($connection); // Closing Connection
    }
  }
?>
