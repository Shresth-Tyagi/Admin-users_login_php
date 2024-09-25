<?php

if(isset($_FILES['image'])){

$file_name = $_FILES['image']['name'];
$file_tmp = $_FILES['image']['tmp_name'];
$uploaded = "folder\image" . $file_name;

$uploaded = move_uploaded_file($file_tmp, "folder\Images" . $file_name);

if($uploaded){
    echo "Image is uploaded";
    echo "<br><br>";
}
else{
     echo "Image is not uploaded";
     echo "<br><br>";
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File like images etc</title>
</head>
<body>
<form action="" method="POST" enctype="multipart/form-data">
<input type="file" name="image" /><br><br>

<input type="submit" />
</form>

<script>



</script>
</body>
</html>