<?php
  require('functions.php');

  if( isset($_POST['action']) && $_POST['action'] == 'getUserLog' )
  {
    echo getUserLog($_POST['userid']);
    exit;
  }

  if( isset($_POST['action']) && $_POST['action'] == 'deleteLog' )
  {
    deleteLog($_POST['logid']);
    exit;
  }

  if( isset($_POST['action']) && $_POST['action'] == 'deleteUser' )
  {
    deleteUser($_POST['userid']);
    exit;
  }

  function getUserLog($userid)
  {
    $userAllLogs = getUserLogs($userid);
    $tabledata = '';
    $count = 0;
    foreach( $userAllLogs as $log ){
        $count++;
        $tabledata .= '<tr data-logid="' . $log['id'] . '">';
        $tabledata .= '<td>' . $count . '</td>';
        $tabledata .= '<td>' . $log['last_name'] . ' ' . $log['first_name'] . '</td>';
        $tabledata .= '<td>' . $log['log_type'] . '</td>';
        $tabledata .= '<td>' . $log['reason'] . '</td>';
        $tabledata .= '<td>' . $log['date_from'] . '</td>';
        $tabledata .= '<td>' . $log['date_to'] . '</td>';
        $tabledata .= '<td><button onclick="deleteLog(' . $log['id'] . ')"><span class="glyphicon glyphicon-trash"></span></button></td>';
        $tabledata .= '</tr>';
    }

    return $tabledata;
  }

  function deleteLog($logid)
  {
    global $database;
    $stm = $database->prepare("DELETE FROM logs WHERE id = $logid");
    $stm->execute();
    $stm->closeCursor();
  }

  function deleteUser($userid)
  {
      global $database;
      $stm = $database->prepare("DELETE FROM users, logs WHERE users.ID = $userid");
      // TODO foreign keyt beállítani hozzá, hogy a logokat is törölje
      $stm->execute();
      $stm->closeCursor();
  }
?>
