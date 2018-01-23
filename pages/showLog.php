<?php
  $users = getUsers();
  $alldata = getAllData();
?>
<section class="show-logs">
  <div class="container">
    <h2 class="post-title">Logok</h2>
    <form class="show-logs-form" action="" method="post">
      <div class="form-group">
        <div class="row">
          <div class="col-sm-4">
            <select class="form-control" id="show-logs-select-person" name="show-logs-select-person">
              <option value="all" selected>Összes...</option>
              <?php
                foreach( $users as $user ){
                  echo '<option value="' . $user['id'] . '"> ' . $user['first_name'] . ' ' . $user['last_name'] . '</option>';
                }
              ?>
            </select>
          </div>
        </div>
      </div>
    </form>
    <div class="table-responsive table--logs">
      <table class="table tablesorter">
        <thead>
          <tr>
            <th>#</th>
            <th>Név</th>
            <th>Típus</th>
            <th>Távollét oka</th>
            <th>-tól</th>
            <th>-ig</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
            // jajdeszep($alldata);
            if( $alldata ){
              $count = 0;
              $output = '';
              foreach( $alldata as $log){
                $count++;
                $reasonsmall = "";
                $reasonlong = "<div>" . $log['reason'] . "</div>";
                if( strlen( $log['reason'] ) >= 60 )
                {

                  $smalltext = substr( $log['reason'], 0, 60 );
                  $reasonsmall = "<div class=smalltext>" . $smalltext . " <span class='glyphicon glyphicon-plus'></span></div>";
                  $reasonlong = "<div class=longtext>" . $log['reason'] . " <span class='glyphicon glyphicon-minus'></span></div>";
                }

                $output .= '<tr data-logid="' . $log['id'] . '">';
                $output .= '<td>' . $count . '</td>';
                $output .= '<td>' . $log['last_name'] . ' ' . $log['first_name'] . '</td>';
                $output .= '<td>' . $log['log_type'] . '</td>';
                $output .= '<td class="col-sm-3 fulltext">';
                  $output .= $reasonsmall == "" ? "" : $reasonsmall;
                  $output .= $reasonlong;
                $output .= '</td>';
                $output .= '<td>' . $log['date_from'] . '</td>';
                $output .= '<td>' . $log['date_to'] . '</td>';
                $output .= '<td><button onclick="deleteLog(' . $log['id'] . ')"><span class="glyphicon glyphicon-trash"></span></button></td>';
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
