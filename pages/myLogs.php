<?php
  $userid = $_SESSION['user_id'];
  $myLogs = getUserLogs($userid);
?>
<section class="show-my-logs">
  <div class="container">
    <h2 class="post-title">Saját logjaim</h2>
    <div class="table-responsive table--logs">
      <table class="table tablesorter">
        <thead>
          <tr>
            <th>#</th>
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
            if( $myLogs ){
              $count = 0;
              $output = '';
              if( $_SESSION['role'] == 'admin' )
              {
                foreach( $myLogs as $log){
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
              }
              else
              {
                foreach( $myLogs as $log){
                  $count++;
                  $reasonsmall = "";
                  $reasonlong = "<div>" . $log['reason'] . "</div>";
                  if( strlen( $log['reason'] ) >= 60 )
                  {

                    $smalltext = substr( $log['reason'], 0, 60 );
                    $reasonsmall = "<div class=smalltext>" . $smalltext . " <span class='glyphicon glyphicon-plus'></span></div>";
                    $reasonlong = "<div class=longtext>" . $log['reason'] . " <span class='glyphicon glyphicon-minus'></span></div>";
                  }
                  $output .= '<tr>';
                  $output .= '<td>' . $count . '</td>';
                  $output .= '<td>' . $log['log_type'] . '</td>';
                  $output .= '<td class="col-sm-3 fulltext">';
                    $output .= $reasonsmall == "" ? "" : $reasonsmall;
                    $output .= $reasonlong;
                  $output .= '</td>';
                  $output .= '<td>' . $log['date_from'] . '</td>';
                  $output .= '<td>' . $log['date_to'] . '</td>';
                  $output .= '</tr>';
                }
              }
              echo $output;
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</section>
