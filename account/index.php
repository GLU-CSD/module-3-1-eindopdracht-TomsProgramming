<?php
require "../config.php";

if($loggedIn){
    if ($deviceData['emailVerified'] === 1){
        echo '<script>location.href = "/mijn-account";</script>';
    }
}else{
    echo '<script>location.href = "/inloggen";</script>';
}
?>