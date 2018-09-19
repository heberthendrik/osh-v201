<?php

if( is_numeric($_SESSION['OSH']['FUNCTION_RESULT']) && $_SESSION['OSH']['FUNCTION_RESULT'] == 1 ){
	?>
	<div class="alert alert-success"> <?php echo $_SESSION['OSH']['SYSTEM_MESSAGE'];?> </div>
	<?php
}

else if( is_numeric($_SESSION['OSH']['FUNCTION_RESULT']) && $_SESSION['OSH']['FUNCTION_RESULT'] == 0  ){
	?>
	<div class="alert alert-danger"> <?php echo $_SESSION['OSH']['SYSTEM_MESSAGE'];?> </div>
	<?php
}

unset($_SESSION['OSH']['FUNCTION_RESULT']);
unset($_SESSION['OSH']['SYSTEM_MESSAGE']);

?>

			<!--

			<div class="alert alert-info"> <strong>Heads up!</strong> This <a class="alert-link" href="#">alert needs your attention</a>, but it's not super important. </div>
			<div class="alert alert-warning"> <strong>Warning!</strong> Better check yourself, you're <a class="alert-link" href="#">not looking too good</a>. </div>
			
-->
