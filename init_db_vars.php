<?php
    $_SESSION['servername'] = null;
    $_SESSION['username'] = null;
    $_SESSION['password'] = null;
    $_SESSION['hitstbl'] = null;
    $_SESSION['dupstbl'] = null;

    function InitDBVars($servername, $username, $password, $hitstbl, $dupstbl) {
        $_SESSION['servername'] = $servername;
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['hitstbl'] = $hitstbl;
        $_SESSION['dupstbl'] = $dupstbl;
    }    
?>