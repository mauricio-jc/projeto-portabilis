<?php
	function open_connection($banco)
	{	
		$base = $banco;
		$connection = new PDO("pgsql:dbname=" . $base . ";user=postgres;password=pg5804;host=localhost");
		
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