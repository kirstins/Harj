<?php
session_start();
$user = "test";
$pass = "t3st3r123";
$db = "test";
$host = "localhost";
$link = mysqli_connect($host, $user, $pass, $db) or die("ei saanud ühendatud");
$connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ühendust mootoriga- ".mysqli_error());
mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));

$adre=$_SERVER['REMOTE_ADDR'];
echo "$adre";

$sql="INSERT INTO kas_ip (ip) VALUES ('$adre')";
if ($connection->query($sql) === TRUE) { //kontrollib kas salvestas v''rtuse
    echo "<br> Panime su IP kirja! <br> <br>";
} else {
    echo "Viga: " . $sql . "<br>" . $connection->error;
}

$query2="SELECT ip FROM kas_ip";
$aadressid = array();
$tulemus = mysqli_query($connection, $query2) or die("$query2 - ".mysqli_error($connection));
while($row = mysqli_fetch_assoc($tulemus)){
	$aadressid[]=$row;	}


$query="SELECT COUNT(DISTINCT ip) AS unikaalne FROM kas_ip";
$results = array();
$result = mysqli_query($connection, $query) or die("$query - ".mysqli_error($connection));
while($rida = mysqli_fetch_assoc($result)){
	$results[]=$rida;	}
?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>IP aadressid</title>
</head>

<body>
<div>

<p>Seda lehekülge on kasutanud järgmised IP aadressid: </p>
<?php if(!empty($aadressid)):
	foreach($aadressid as $a):?>
	<?php echo $a['ip']; ?> <br>

	<?php	endforeach; endif; ?>
	
<p>Unikaalseid külastusi on lehel olnud: </p>
<?php if(!empty($results)):
	foreach($results as $r):?>
	<?php echo $r['unikaalne']; ?> <br>

	<?php	endforeach; endif; ?>

</div>
</body>
</html>