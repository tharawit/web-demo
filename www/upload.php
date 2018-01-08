<?php session_start(); ?>
<!DOCTYPE html>
<html>
<body>
<h1> Upload Images </h1>
<p style="color:red;">
    <?php 
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    ?>
</p>
<form action="./action/action_upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="filename">
    <select name="type" >
        <option value="view">View</option>
        <option value="type2">Type2</option>
        <option value="type3">Type3</option>
        <option value="type4">Type4</option>
    </select>
    <button type="submit"  >Upload</button>
</form>

</body>
</html>