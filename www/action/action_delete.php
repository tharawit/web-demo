<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
session_start();

/* Check is image and login */
if (empty($_GET['img']) || $_SESSION['user'] != 1) {
    header('location:./../');
}elseif($_GET['img'] == "allimg"){
    // clear all file in database
    require_once("condb.php");
    $con = new Condb();
    $con->db_query("DELETE FROM images");
    $con->db_close();
    // delete all files
    array_map('unlink', glob("./../imgs/*.png"));
    $_SESSION['status'] = 3;
    header('location:./../');
}else{
    /* make name */
    $img = $_GET['img'];
    unset($_GET['img']);
    $img = explode('.',$img);
    $img = explode('/imgs/',$img[0]);
    $img = $img[1];
    /* Remove from database */
    // Call function condb
    require_once("condb.php");
    $sql = "
        DELETE FROM images WHERE name LIKE '%".$img ."%'
    ";
    $con = new Condb();
    // Check real string
    if($con->db_fillter($img) == "err"){
        $con->db_close();
        $_SESSION['status'] = 4;
        header('location:./../');
        exit(0);
    }else{
        $con->db_query($sql);
        $_SESSION['status'] = 3;
    }
    $con->db_close();

    /* Remove file from local */
    $location_save_image = "./../imgs/";
    unlink($location_save_image.$img.".png");
    header('location:./../');
}
?>