<?php
session_start();
session_destroy();
header("Location: games/memory/index.php");
?>