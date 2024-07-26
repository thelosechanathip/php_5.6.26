<?php

    session_start();

    session_destroy();
    echo '<script>';
        echo "window.location = 'login.php'";
    echo '</script>';


?>