<?php
session_start();
unset($_SESSION['idAdmine']);
header('location: ../Login/'); 
?>