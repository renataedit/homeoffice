  <?php require('header.php');
  if( !userLoggedIn() ) {
  ?>
    <section class="log-in">
      <div class="container">
        <div class="row">
          <div class="col-sm-5 col-sm-offset-3">
            <form class="log-in" action="/" method="post">
              <div class="form-group row">
                <div class="col-xs-12">
                  <input type="text" class="form-control" id="username" name="username" placeholder="Felhasználónév">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-xs-12">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Jelszó">
                </div>
              </div>
              <input type="submit" name="logIn" value="Belépés">
            </form>
          </div>
        </div>
      </div>
    </section>
  <?php } else {
    //BEJELENTKEZETT FELÜLET
    $userRole = $_SESSION['role'];
    if( $userRole == 'admin')
    {
      $availablePages = array('newLog', 'newUser', 'showUsers', 'showLog', 'myLogs', 'logout');
    }
    else if ( $userRole == 'user' )
    {
      $availablePages = array('myLogs', 'logout');
    }

    // Ha a link ?page= -t tartalmaz, töltse be a megfelelő paget
    if(isset($_GET['page']))
    {
      $page = $_GET['page'];

      // Ha a usernek van jogosultsága a page megtekintéséhez
      if( in_array($page, $availablePages) ) {
        include_once('pages/'.$page.'.php');
      } else {
        echo '<div class="container">Ez a lap nem megjeleníthető</div>';
      }
    }
    // Ha nincs ?page= a linkben
    else
    {
      if( $userRole == 'admin')
      {
        include_once('pages/newLog.php');
      }
      else
      {
        include_once('pages/myLogs.php');
      }
    }
   }
   ?>

  <?php require('footer.php'); ?>
