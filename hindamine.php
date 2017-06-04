<?php
session_start();

if (isset($_GET['hinda'])){
	$hindefail = 'hinded.txt';

	if (isset($_POST['upload'])){

		$saadetudhinne = htmlspecialchars($_POST['hinne']);	
		file_put_contents($hindefail, $saadetudhinne. "\n", FILE_APPEND);
	}

	$lines = array();
	$lines=file($hindefail);

	$arv = count($lines);
	$summa = array_sum($lines);
	$avg = $summa/$arv;

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

     <?php if (!empty($avg)) :?>
		
		<p>
			<h2>Keskmine hinne lehele (salvestades andmed tekstifaili): <?php echo $avg; ?></h2> 
			<h2> Hinnete arv: <?php echo $arv; ?></h2>
			<h2> Hinnete summa: <?php echo $summa; ?></h2>
		</p>

	<?php else: ?>
		<p> Keegi pole veel hinnanud! Ole esimene! </p>

		
	
		<?php endif; ?>

	</div>
</body>

