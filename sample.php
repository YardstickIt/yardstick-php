<?php

	require("yardstick.php");
	
	$yardstick = new Yardstick("your-api-key");
	
	$result = $yardstick->track();
	
	if($result === true)
		echo "Metric tracked";

?>