<?php
if(empty($_SESSION['user'])){
    //guest msh 3aml login
    header('location: signin.php');
    die;
}