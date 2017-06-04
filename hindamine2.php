<?php
session_start();
$user = "test";
$pass = "t3st3r123";
$db = "test";
$host = "localhost";
$link = mysqli_connect($host, $user, $pass, $db) or die("ei saanud ühendatud");
$connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ühendust mootoriga- ".mysqli_error());
mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));

if (isset($_GET['hinda'])){

	$keskmine=array();

	$query="SELECT AVG (hinne) AS average FROM kas_hinded";
	$result = mysqli_query($connection, $query) or die("$query - ".mysqli_error($connection));
	while($rida = mysqli_fetch_assoc($result)){
	$keskmine[]=$rida;	}


	if (isset($_POST['upload'])){
		$grade=mysqli_real_escape_string($connection, $_POST["hinne"]);

		$sql="INSERT INTO kas_hinded (hinne) VALUES ('$grade')";


	if ($connection->query($sql) === TRUE) { //kontrollib kas salvestas v''rtuse
   	 echo "<br> Sinu hinne on kirjas! <br> <br>";
	} else {
    echo "Viga: " . $sql . "<br>" . $connection->error;
	}

	}
}
	


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Lehekülje hindamine</title>
</head>

<body>
	<div>
		<p> Sinu hinne lehele: </p>
		<form action="?hinda" method="POST">

		<ul>
    		<li>
        		<input type="radio" id="r1" name="hinne" value="1"><label for="r1">1 - kohutav leht</label>
        	</li>
        	<li>
	            <input type="radio" id="r2" name="hinne" value="2"><label for="r2">2 - kehvavõitu</label>
	        </li>
	        <li>
	            <input type="radio" id="r3" name="hinne" value="3"><label for="r3">3 - keskpärane</label>
	        </li>
	        <li>
	            <input type="radio" id="r4" name="hinne" value="4"><label for="r4">4 - normaalne leht</label>
	        </li>
	        <li>
	            <input type="radio" id="r5" name="hinne" value="5"><label for="r5">5 - suurepärane</label>
	        </li>
	    </ul>

	     <p>
  			<input type="submit" name="upload" value="SAADA HINNE">
  		</p>
    </form>

    <?php if(!empty($keskmine)):
	foreach($keskmine as $k):?>
		
		<p>
			<h2>Keskmine hinne lehele: <?php echo $k['average']; ?></h2> 
		</p>
</div>
		<?php	endforeach; endif; ?>
</body>

</html>