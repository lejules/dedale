<?php
$t = isset($_GET['t']) ? $_GET['t'] : NULL;
include("connect.inc.php");

if ($t == 'des'){
  echo rand(2, 12);
}else{
	$position = isset($_GET['position']) ? $_GET['position'] : NULL;
	$matteo		= isset($_GET['matteo']) ? $_GET['matteo'] : NULL;
	$marco		= isset($_GET['marco']) ? $_GET['marco'] : NULL;
	$dedale		= isset($_GET['dedale']) ? $_GET['dedale'] : '0';

	$sql = "INSERT INTO dedales SET position = '".$position."', marco = '".$marco."', matteo = '".$matteo."', dedale = '".$dedale."'";
	$res = $cnx->query($sql);

	echo '<p title="' . $sql . '">Enregistrement terminé !</p>';
}
?>
