<?php
session_start();
session_destroy();
setcookie("cook_id", false);
echo "<meta http-equiv='refresh' content='0;url=index.php'>";
?>