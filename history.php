<?php 

require "function.php";
// header("refresh: 2");
date_default_timezone_set('Asia/Jakarta');

$time = date("Y-m-d H:i:s", mktime(date('H'),date('i'), date('s'), date('m'),date('d'),date('Y')));
// echo $time;

$FilterSatu =querykondisi("SELECT * FROM history ORDER BY id DESC LIMIT 20");
if (isset($_POST['submit'])) {
	$fil = $_POST['key'];
	// echo $fil;
	if ($fil == "Benda 1" or $fil == "Benda 2" ) {
		// echo "iya disini";
		$FilterSatu = queryKondisi("SELECT * FROM history WHERE namabenda LIKE '%$fil%' ORDER BY id DESC LIMIT 20");
	}
}



foreach ($FilterSatu as $key) {
	$latitude = $key['titik1'];
	$longitude = $key['titik2'];
	// @-7.3634772,112.6317722,15z
	$maps = "http://www.google.com/maps/place/$latitude, $longitude";
	
}

// echo "hemm " . $tampilkan . "<br>";



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>DTags-History</title>
	<link href="history.css?version=<?php echo filemtime('history.css'); ?>" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="header">
		<a href="https://ittelkom-sby.ac.id"><img src="img/kampus.png" alt="kampus"></a>
		<h1 class="nav">Informasi Pelacakan</h1>
	</div>
    <div class="form">
    	<form action="history.php" method="post">
    		<select class="" id="key" name="key">
				<option selected>Please select ...</option>
				<option value="Benda 1">Benda 1</option>
				<option value="Benda 2">Benda 2</option>
			</select>
            <input type="submit" name="submit" class="btn">
    	</form>
    	<a href="index.php">Back to Dashboard</a>
    </div>
	<div class="container-1">
		<?php foreach($FilterSatu as $Satu): ?>
			<div class="card">
				<?php if ($Satu['namabenda'] == 'Benda 1' && $Satu['mode'] == "Outdoor"): ?>
					<a href="#"><img src="img/key-icon.png" alt="key-icon"></a>
					<div class="content">
						<div class="content-up">
						    <?php $tampilkan = lastSeen($Satu['id']); ?>
							<h2 class="title"><?php echo $Satu['namabenda']; ?></h2>
							<h2 class="mode"><?php echo $Satu['mode'];?></h2>
							<h2 class="loc"><?php echo $Satu['titik1'] . "," . $Satu['titik2']; ?></h2>
						</div>
						<div class="content-down">
							<h2 class="last-sent"><?php echo "ID " . $Satu['id'] ." - " . $tampilkan; ?></h2>
						</div>
					</div>
					<div class="btn-location">
						<a href="http://www.google.com/maps/place/<?php echo $Satu['titik1'] . ',' . $Satu['titik2']; ?>" target="_blank"></a>
					</div>
				<?php elseif($Satu['namabenda'] == 'Benda 1' && $Satu['mode'] == "Indoor"): ?>
					<a href="#" class="indoor-img"><img src="img/key-icon.png" alt="key-icon" ></a>
					<div class="content">
						<div class="content-up">
						    <?php $tampilkan = lastSeen($Satu['id']); ?>
							<h2 class="title"><?php echo $Satu['namabenda']; ?></h2>
							<h2 class="mode"><?php echo $Satu['mode'];?></h2>
							<h2 class="loc"><?php echo $Satu['tempat'] ?></h2>
						</div>
						<div class="content-down">
							<h2 class="last-sent"><?php echo "ID " . $Satu['id'] ." - " . $tampilkan; ?></h2>
						</div>
					</div>
				<?php elseif($Satu['namabenda'] == 'Benda 2' && $Satu['mode'] == "Outdoor"): ?>
					<a href="#"><img src="img/wallet-icon.png" alt="wallet-icon"></a>
					<div class="content">
						<div class="content-up">
						    <?php $tampilkan = lastSeen($Satu['id']); ?>
							<h2 class="title"><?php echo $Satu['namabenda']; ?></h2>
							<h2 class="mode"><?php echo $Satu['mode'];?></h2>
							<h2 class="loc"><?php echo $Satu['titik1'] . "," . $Satu['titik2']; ?></h2>
						</div>
						<div class="content-down">
							<h2 class="last-sent"><?php echo "ID " . $Satu['id'] ." - " . $tampilkan; ?></h2>
						</div>
					</div>
					<div class="btn-location">
						<a href="http://www.google.com/maps/place/<?php echo $Satu['titik1'] . ',' . $Satu['titik2']; ?>" target="_blank"></a>
					</div>
				<?php elseif($Satu['namabenda'] == 'Benda 2' && $Satu['mode'] == "Indoor"): ?>
					<a href="#" class="indoor-img"><img src="img/wallet-icon.png" alt="wallet-icon"></a>
					<div class="content">
						<div class="content-up">
						    <?php $tampilkan = lastSeen($Satu['id']); ?>
							<h2 class="title"><?php echo $Satu['namabenda']; ?></h2>
							<h2 class="mode"><?php echo $Satu['mode'];?></h2>
							<h2 class="loc"><?php echo $Satu['tempat'] ?></h2>
						</div>
						<div class="content-down">
							<h2 class="last-sent"><?php echo "ID " . $Satu['id'] ." - " . $tampilkan; ?></h2>
						</div>
					</div>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
</body>
</html>