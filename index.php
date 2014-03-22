<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="utf-8">
    <title>index</title>
    <meta name="robots" content="noindex, nofollow">

</head>

<body>

<?php 
if (isset($_GET['phpinfo']))
	phpinfo();
else {

	$handle=opendir(".");
	$projectContents = '<ul>';
	$projectsListIgnore = array ('..');
	
	function getHtml($dir) {
		$dirHandle = opendir($dir);
		$res = '<ul>';
	
		while ($file = readdir($dirHandle)) {
	
			if (!is_dir($file) && preg_match('/(\.html)|(\.php)/', $file)) {
				$res .= '<li><a href="'.$dir.'/' . $file.'">'.$file .'</a></li>';
			}
		}
	
		closedir($dirHandle);
		
		$res .= '</ul>';
		
		return $res;
	}
	
	while ($file = readdir($handle)) 
	{
		if (is_dir($file) && !in_array($file,$projectsListIgnore)) 
		{		
			$projectContents .= '<li><a href="'.$file.'">'.$file.'</a>' .  date("Y-m-d H:i:s.", filemtime($file));
			$projectContents .= getHtml($file);
			$projectContents .= '</li>';
		}
	}
	closedir($handle);
	$projectContents .= '</li>';
	
	echo($projectContents);

}
?>
</ul>
</body>

</html>
