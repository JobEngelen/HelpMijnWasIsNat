<?php
    if (!isset($_SESSION['id'])){
        session_start();
    }

    function isLoggedIn() {
        if (isset($_SESSION['id'])) {
            return true;
        } else {
            return false;
        }
    }
?>