<?php
session_start();
session_destroy();
header("location:/wp-content/themes/consultup-child/login.php");
                            exit;
?>