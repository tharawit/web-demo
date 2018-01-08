<?php
    session_start();
    /* Set variable for cache file */
    $img_source= $_FILES['filename']['tmp_name'];
    $img_name = $_FILES['filename']['name'];    
    $img_type = $_FILES['filename']['type'];
    $post_type = $_POST['type'];
    
    /* Check is real image and png */
    if (empty($img_source) || $img_type != "image/png") {
        $_SESSION['error'] = "can't upload !!! ";
        header('location:./../upload.php');
    }

    /* Save file image in sever */
    $location_save_image = "./../imgs";
    $image_new_name =  md5($img_name.date("Y-m-d H:i:s").rand(0,9)).".png";     // Make image name
    $image_save = $location_save_image."/".$image_new_name;                     // Define name for save 
    // move_uploaded_file($img_source, $image_save);                               // Save


    /* Connect database */
    require("condb.php");
    $sql = "
        INSERT INTO images (name, type, time)
        VALUES ('".$server_location_path.$image_new_name."', '".$post_type."', now())
    ";
    // Call connect database class
    $db = new condb();
    $db.query($sql);
?>