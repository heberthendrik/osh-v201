<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//$_GET['lid'] = '1803120001';
$id = $_GET['lid'];
$executor = "/usr/local/bin/wkhtmltoimage --width 1000 --quality 100";
$urlcontent = "http://localhost/development_site/osh-v200/module/lab/print_custom.php?lid=".$id;
$destinationurl = "/Applications/MAMP/htdocs/development_site/osh-v200/media_library/hasillab/".$id.".png";
exec($executor." ".$urlcontent." ".$destinationurl);
?>
<img src="http://localhost/development_site/osh-v200/media_library/hasillab/<?php echo $id;?>.png">
<script>
	//window.print();
</script>