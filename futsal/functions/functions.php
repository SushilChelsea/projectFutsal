<?php
	//@Functions that is used to keep the files on buffer
	function bufferFiles($fileName,$data)
	{
		ob_start();
		extract($data);
		require $fileName;
		$contents=ob_get_clean();
		return $contents;
	}
?>
