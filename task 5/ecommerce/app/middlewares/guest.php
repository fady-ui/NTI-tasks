<?php
if(!empty($_SESSION['user'])){
    //authenticated 3aml login
    header('location: index.php');
    die;
}