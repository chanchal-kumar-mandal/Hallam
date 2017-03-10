<?php
session_start();
session_unset($_SESSION["username"]);
session_unset($_SESSION["user_id"]);
echo '<script>window.location.href="login.php"</script>';
?>