<?php
if(session_destroy()) // Destroying All Sessions
{
header("Location: /"); // Redirecting To Home Page
exit;
}
?>
