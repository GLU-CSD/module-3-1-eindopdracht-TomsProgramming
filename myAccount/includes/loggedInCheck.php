<?php
if($loggedIn){
    if ($deviceData['emailVerified'] != 1){
        echo '<script>location.href = "/email-verificatie";</script>';
    }
}else{
    echo '<script>location.href = "/inloggen";</script>';
}
?>