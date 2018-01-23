<?php session_start();?>
<!DOCTYPE html>
<?php
  require('functions.php');
  include('login.php'); // Includes Login Script
?>
<html lang="hu">
  <head>
    <meta charset="utf-8">
    <title>Manage Home Office Dates</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="public/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,700" rel="stylesheet">
  </head>
  <body>
    <header>
      <div class="container">
        <div class="row">
          <nav class="navbar navbar-toggleable-md">
            <div class="col-sm-2">
              <a class="navbar-brand" href="<?php echo $home ?>"><img src="/img/logo.png" alt="Lampyon Logo" /></a>
            </div>
            <div class="col-sm-2 pull-right text-right">
              <?php if( userLoggedIn() ) : ?>
                  <div class="collapse navbar-collapse" id="main-menu">
                      <a class="btn dropdown-toggle" type="button" id="main-navigation" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Hello <?php echo $_SESSION['first_name']; ?>!
                        <span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="main-navigation">
                        <?php
                        if( $_SESSION['role'] == 'admin'){
                          $menu_elements = '';
                          $menu_elements .= '<div class="dropdown-item"><a type="button" href="?page=newLog">Új log</a></div>';
                          $menu_elements .= '<div class="dropdown-item"><a type="button" href="?page=showLog">Logok megtekintése</a></div>';
                          $menu_elements .= '<div class="dropdown-item"><a type="button" href="?page=myLogs">Saját logjaim</a></div>';
                          $menu_elements .= '<div class="dropdown-item"><a type="button" href="?page=newUser">Új személy felvétele</a></div>';
                          $menu_elements .= '<div class="dropdown-item"><a type="button" href="?page=showUsers">Munkatársak listája</a></div>';
                          $menu_elements .= '<div class="dropdown-item"><a type="button" href="?page=logout">Kijelentkezés</a></div>';
                        } else if( $_SESSION['role'] == 'user' ) {
                          $menu_elements = '';
                          $menu_elements .= '<div class="dropdown-item"><a type="button" href="?page=myLogs">Saját logjaim</a></div>';
                          $menu_elements .= '<div class="dropdown-item"><a type="button" href="?page=logout">Kijelentkezés</a></div>';
                        }
                        echo $menu_elements;
                        ?>
                      </div>
                  </div>
              <?php endif; ?>
            </div>
          </nav>
        </div>
      </div>
    </header>
