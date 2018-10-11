<?php
	function bufferFiles($fileName,$data)
	{
		ob_start();
		extract($data);
		require $fileName;
		$contents=ob_get_clean();
		return $contents;
	}
?>
