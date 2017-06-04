
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>IP aadressid</title>
</head>

<body>
<div>
<?php
$file='ip.txt';
$adre=$_SERVER['REMOTE_ADDR'];

file_put_contents($file, $adre. "\n", FILE_APPEND);

$aadressid=array();
$aadressid=file($file);
$arv=count($aadressid);
$unikaalsed = array_count_values($aadressid);
$unique = count($unikaalsed);
$aeg = date('Y-m-d H:i:s');

echo "Külajastajate arv on olnud kokku: ".$arv."<br>";
echo "Unikaalseid külajastajaid on olnud: ".$unique."<br>";
echo "Viimase külastuse aeg: ".$aeg."<br>";

echo "ip aadressid on:</br>";
	for ($x = 0; $x < $arv; $x++) {	
	echo $aadressid[$x]."</br>";
	}			

?>



</div>
</body>
</html>