<?php
$TO = "kamel.derrar@laposte.net";

$h  = "From: " . $TO;

$message = "";

while (list($key, $val) = each($_POST)) {
  $message .= "$key : $val\n";
}

mail($TO, $subject, $message, $h);

Header("Location: http://<C:\wamp\www\Nouveau dossier (2)\merci>");

?>