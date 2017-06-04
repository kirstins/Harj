<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

if(isset($_FILES['image'])){
	$errors= array();
    $file_name = $_FILES['image']['name'];


 if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["image"]["name"];
        $filetype = $_FILES["image"]["type"];

        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

        if(in_array($filetype, $allowed)){
		move_uploaded_file($_FILES["image"]["tmp_name"], "images/" . $_FILES["image"]["name"]);
                echo "Your file was uploaded successfully.";
        } else{
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
        }
    
}
}

$directory = "images/";
$filecount = 0;
$files = glob($directory . "*");
if ($files){
 $filecount = count($files);
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Faili saatmise vorm</title>
</head>

<body>
	<div>
<h2>Laadi oma fail üles siin</h2><br>
<form action="" method="POST" enctype="multipart/form-data">
         <input type="file" name="image" />
         <input type="submit" name="upload" value="Lae fail üles!"/>
      </form>

 <p> Kaustas on <?php echo $filecount?> faili</p>

<?php if(!empty($errors)):
	foreach($errors as $e):?>
		<p style="color:red"><?php echo $e; ?></p>
<?php	endforeach;
endif;?>


	</div>
</body>
</html>