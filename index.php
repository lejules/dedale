<?php
include("connect.inc.php");
isset($_GET['dedale']) ? include("dedale".$_GET['dedale'].".php") : include("dedale.php");
$dedale = isset($_GET['dedale']) ? $_GET['dedale'] : '0';
$table = '';
$c = 0;

$test_dedale = $cnx->query("SELECT * FROM dedales WHERE dedale = '".$dedale."' ORDER BY id DESC LIMIT 1");
$resultat = $test_dedale->fetchAll();
$position = isset($resultat[0]) ? $resultat[0]['position'] : NULL;
$marco		= isset($resultat[0]) ? $resultat[0]['marco'] : NULL;
$matteo		= isset($resultat[0]) ? $resultat[0]['matteo'] : NULL;

$lignes = count($tab);
for ($a = 0 ; $a < $lignes ; ++$a){
  $table .= '
  <tr>';
  $col = count($tab[$a]);
  for ($b = 0 ; $b < $col ; ++$b){
    $class = ' class="'.$tab[$a][$b].'"';
		$checked = ($position == $c) ? ' checked="checked"' : NULL;
    $contenu = (isset($_GET['mode']) AND $_GET['mode'] == 'debug') 
		? (array_key_exists($c, $obj) ? $obj[$c] : '<span style="color:red;">'.$c.'</span>') 
		: (array_key_exists($c, $obj) ? '<span onclick="assommer(this);">'.$obj[$c].'</span>' : '<input type="radio"'.$checked.' name="position" value="'.$c.'" />');

    $table .= '
	<td'.$class.'>'.$contenu.'</td>';
    ++$c;
  }
  $table .= '
	</tr>
	';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <title>Jouons maintenant !</title>
        <script src="queryjs.js"></script>

</head>
<body>
<form action="" id="form" method="post">
<table>
	<caption>
EE=double épée, E=épée, H=hache de guerre, V=fiole de vie, Gde=gourde, Gto=gâteau, B=boussole magique, S=soldat(30, -5), C=Chevalier(60, -10), R=roi(100, -20)
	</caption>
	<?php echo $table; ?>
	<tr><td colspan="<?php echo $col; ?>" id="result1"></td></tr>
</table>
<p>
	<input type="button" id="bouton" name="x" value="Lancement des d&eacute;s" />  -  <span id="result"></span>
</p>
	<input type="hidden" name="dedale" value="<?php echo $dedale; ?>" />
	<textarea id="matteo" name="matteo"><?php echo !is_null($matteo) ? $matteo : 'MATTEO'; ?></textarea>
	<textarea id="marco" name="marco"><?php echo !is_null($marco) ? $marco : 'MARCO'; ?></textarea>
</form>

</body>
</html>
