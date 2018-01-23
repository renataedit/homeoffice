<?php
  $users = getUsers();
?>
<section class="show-users">
  <div class="container">
    <h2 class="post-title">Munkatársak listája</h2>
    <div class="table-responsive table--users">
      <table class="table tablesorter">
        <thead>
          <tr>
            <th>#</th>
            <th>Felhasználónév</th>
            <th>Vezetéknév</th>
            <th>Keresztnév</th>
            <th>Jogkör</th>
          </tr>
        </thead>
        <tbody>
          <?php
            // jajdeszep($alldata);
            if( $users ){
              $count = 0;
              $output = '';
              foreach( $users as $user){
                $count++;
                $output .= '<tr data-userid="' . $user['id'] . '">';
                $output .= '<td>' . $count . '</td>';
                $output .= '<td>' . $user['username'] . '</td>';
                $output .= '<td>' . $user['last_name'] . '</td>';
                $output .= '<td>' . $user['first_name'] . '</td>';
                $output .= '<td>' . $user['role'] . '</td>';
                $output .= '<td><button onclick="deleteUser(' . $user['id'] . ')"><span class="glyphicon glyphicon-trash"></span></button></td>';
                $output .= '</tr>';
              }

              echo $output;
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</section>
