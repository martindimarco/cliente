<!-- controlador para la destruccion de las sesiones -->
<?php
session_start();

var_dump(session_id($_SESSION['usu']));
 
if (isset($_SESSION['usu'])) {
  session_unset();
  session_destroy();
  header("Location: ../index.html");
}
