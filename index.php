<?php
session_start();

if(isset($_SESSION['user_id'])){
    header("Location: http://localhost:3000");
    exit();
}

// Redirect everyone to React app
header("Location: http://localhost:3000");
exit();
?>