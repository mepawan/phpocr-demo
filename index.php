<?php
error_reporting(0);
chmod(dirname(__FILE__). '/upload', 0777);
chmod(dirname(__FILE__). '/temp', 0777);

if(isset($_POST['submit'])){
	require_once dirname(__FILE__).'/TesseractOCR/TesseractOCR.php';
	
	$file = dirname(__FILE__). '/upload/' . $_FILES['image']['name'];
	move_uploaded_file($_FILES['image']['tmp_name'], $file);
	
	$obj = new TesseractOCR($file);
	$obj->setTempDir(dirname(__FILE__).'/temp');
	$text = $obj->recognize();

}

?>

<div style="width:80%; margin:20px auto;">
	<div style="float:left; width:45%;">
		<form method="post" enctype="multipart/form-data" >
			Upload file: <input type="file" name="image" /> <br /><br />
			<!--
			Or <br /><br />
			Image url : <input type="text" name="image_url" /><br /><br /> -->
			
			<input type="submit" value="Submit"  name="submit" />
		</form>
	</div>
	<div style="float:right; width:50%;">
		<?php
			if(isset($_POST['submit'])){
				echo '<b>Recognized Data:</b><br /> <br />' . $text;
				
				echo '<br /><br /> <br /><img style="max-width:500px;" src="./upload/'.$_FILES['image']['name'].'" />'; 
			}
		?>
	</div>
	<div style="clear:both;"></div>
</div>
