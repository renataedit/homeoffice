<?php

require_once('config.php');
$home = "http://" . $_SERVER['SERVER_NAME'];

function jajdeszep($array, $echo = true)
{
    $out = '<pre>';
    $out .= print_r($array, true);
    $out .= '</pre>';

    if ($echo) {
        echo $out;
    } else {
        return $out;
    }
}

function userLoggedIn()
{
  if(isset($_SESSION['login_user']))
  {
    return true;
  }
  else
  {
    return false;
  }
}

function getUsers()
{
  global $database;
  $stm = $database->prepare("SELECT id, username, role, first_name, last_name FROM users WHERE 1");
  $stm->execute();

  $get_users = $stm->fetchAll();
  $stm->closeCursor();
  return $get_users;

  // global $database;
  // $query_users = "SELECT * FROM users WHERE 1";
  // $get_users = $database->query($query_users);
  // return $get_users;
}

function getUser($userid)
{
  global $database;
  $stm = $database->prepare("SELECT id, username, role, first_name, last_name FROM users WHERE userid = $userid");
  $stm->execute();

  $get_user = $stm->fetchAll();
  $stm->closeCursor();
  return $get_user;
}

function saveNewUser($post)
{
  global $database;

  // Get data from $_POST
  $username = $post['username'];
  $pass = hash( 'sha256', $post['pass1'] );
  $role = $post['role'];
  $firstname = $post['first_name'];
  $lastname = $post['last_name'];

  // Check if there's a user like this already
  $stm = $database->prepare("SELECT * FROM users WHERE username = '$username'");
  $stm->execute();

  $result = $stm->fetchAll();
  $stm->closeCursor();

  if( empty($result) ) {
    //INSERT
    $stm = $database->prepare("INSERT INTO users ( username, pass, role, first_name, last_name ) VALUES (?, ?, ?, ?, ?)");
    $stm->bindParam(1, $username);
    $stm->bindParam(2, $pass);
    $stm->bindParam(3, $role);
    $stm->bindParam(4, $firstname);
    $stm->bindParam(5, $lastname);
    try
    {
      $stm->execute();
    }
    catch(PDOException $e)
    {
      echo $stm . "<br />" . $e->getMessage();
    }

    $message = "<div class='form-response'>Sikeresen mentve</div>";
  } else {
    $message = "<div class='form-response'>Van már ilyen felhasználó</div>";
  }
}

function getUserLogs($userid = 'all')
{
  global $database;
  if( $userid == 'all')
  {
    $stm = $database->prepare("SELECT users.id, users.username, users.role, users.first_name, users.last_name, logs.* FROM users, logs WHERE users.id = logs.userid");
  }
  else
  {
    $stm = $database->prepare("SELECT users.id, users.username, users.role, users.first_name, users.last_name, logs.* FROM users, logs WHERE users.id = logs.userid AND users.id = $userid");
  }
  $stm->execute();

  $get_user_logs = $stm->fetchAll();
  $stm->closeCursor();
  return $get_user_logs;
}

function sendLogEmail($who, $from, $to, $reason)
{
    global $database;
    $stm = $database->prepare("SELECT first_name, last_name FROM users WHERE id = $who");
    $stm->execute();

    $logEmailDetails = $stm->fetchAll();
    $stm->closeCursor();

    $headers  = "From: Home Office < web@lampyon.com >\n";
    $headers .= "X-Sender: Home Office < web@lampyon.com >\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();
    $headers .= "X-Priority: 1\n"; // Urgent message!
    $headers .= "Return-Path: sz.renata@lampyon.com\n"; // Return path for errors
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\n";

    $msg = "<br />Új log lett rögzítve a rendszerben a következő adatokkal: <br />";
    $msg .= $logEmailDetails[0]['last_name'] . ' ' . $logEmailDetails[0]['first_name'] . '<br />';
    $from != ' ' ? $msg .= $from . ' -tól<br />' : '';
    $to != ' ' ? $msg .= $to . ' -ig<br />' : '';
    $reason != '' ? $msg .= $reason . '<br />' : '';
    mail("sz.renata@lampyon.com","Új log",$msg, $headers);
}

function saveLog($post)
{
  // var_dump($post);
  global $database;
  $message = '';

  // Get data from $_POST
  $userid = $post['userid'];
  $reason = $post['reason'];
  $log_type = $post['log_type'];
  $date_from = $post['date_from'];
  $string_time_from = $post['datetime_from'];
  $date_to = $post['date_to'];
  $string_time_to = $post['datetime_to'];

  $sum_from = $date_from . ' ' . $string_time_from;
  // $from_timestamp = strtotime($sum_from);
  // $datetime_from = date_create_from_format('Y-m-d H:i', $sum_from);
  // $from_timestamp = $datetime_from->getTimestamp();

  $sum_to = $date_to . ' ' . $string_time_to;
  // $to_timestamp = strtotime($sum_to);
  // $datetime_to = date_create_from_format('Y-m-d H:i', $sum_to);
  // $to_timestamp = $datetime_to->getTimestamp();

  // Check if there's a log to this user with the same time
  $stm = $database->prepare("SELECT * FROM logs WHERE userid = $userid AND date_from = '$sum_from' AND date_to = '$sum_to'");
  $stm->execute();

  $result = $stm->fetchAll();
  $stm->closeCursor();

  if( empty($result) ) {
    //INSERT
    $stm = $database->prepare("INSERT INTO logs ( userid, reason, date_from, date_to, log_type ) VALUES (? ,? ,?, ?, ?)");
    $stm->bindParam(1, $userid);
    $stm->bindParam(2, $reason);
    $stm->bindParam(3, $sum_from);
    $stm->bindParam(4, $sum_to);
    $stm->bindParam(5, $log_type);
    try
    {
      $stm->execute();
    }
    catch(PDOException $e)
    {
      echo $stm . "<br />" . $e->getMessage();
    }

    sendLogEmail($userid, $sum_from, $sum_to, $reason);

    $message = "<div class='form-response'>Sikeresen mentve</div>";

  } else {
    $message = "<div class='form-response'>Ez a bejegyzés már létezik</div>";
  }

  return $message;
}

function getAllData()
{
  global $database;
  $stm = $database->prepare("SELECT users.id, users.username, users.role, users.first_name, users.last_name, logs.* FROM users, logs WHERE users.id = logs.userid");
  $stm->execute();

  $get_all_data = $stm->fetchAll();
  $stm->closeCursor();
  return $get_all_data;
}

if(isset($_POST['submitNewLog']))
{
  $log_status = saveLog($_POST);
  echo $log_status;
}

if(isset($_POST['submitNewUser']))
{
  $save_user_status = saveNewUser($_POST);
  return $save_user_status;
}

//
// function getLogs($userid, $date_from, $date_to, $log_type){
//   global $database;
//   $where = '';
//   if( $userid ){
//     if($where != ''){
//       $where .= ','
//     }
//     $where .= $userid;
//   }
//   if( $date_from ){
//     if($where != ''){
//       $where .= ','
//     }
//     $where .= $date_from;
//   }
//   if( $date_to ){
//     if($where != ''){
//       $where .= ','
//     }
//     $where .= $date_to;
//   }
//   if( $log_type ){
//     if($where != ''){
//       $where .= ','
//     }
//     $where .= $log_type;
//   }
//   $query_logs = "SELECT * FROM logs WHERE $where";
// }
