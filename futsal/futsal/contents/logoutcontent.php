<?php

if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    session_unset();
    unset($_SESSION['login']);
    unset($_SESSION['userId']);
    unset($_SESSION['email']);
    header("Location: home");
}

?>