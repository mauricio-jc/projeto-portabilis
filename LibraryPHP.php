<?php
	function open_connection()
	{
		$connection = new PDO("pgsql:dbname=dfumdjqfopbnno;user=lhbkmjtcgikinc;password=8VxzPVjVSIgcMFELP-tkynhMSE;host=ec2-54-225-197-143.compute-1.amazonaws.com");
		
		if(!$connection)
		{
			echo "<script>alert('Problemas de conexão com banco de dados!');</script>";
			exit();
		}

		return $connection;
	}

	function convert_date_base($data)
	{
		$arrayDate = explode("/", $data);
		$newDate   = $arrayDate[2] . "-" . $arrayDate[1] . "-" . $arrayDate[0];

		return $newDate;
	}

	function convert_date_screen($data)
	{
		$arrayDate = explode("-", $data);
		$newDate   = $arrayDate[2] . "/" . $arrayDate[1] . "/" . $arrayDate[0];

		return $newDate;
	}
?>