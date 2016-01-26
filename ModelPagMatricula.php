<?php

	//Arrumar codificação
	header('Content-Type: text/html; charset=UTF-8');

	include "LibraryPHP.php";

	$conexao = open_connection("universidade");

	$cod_matricula = $_GET['cod_matricula'];

	$SQLPagarMatricula = $conexao->query("UPDATE matricula
											 SET pago = 1
										   WHERE cod_matricula = $cod_matricula");
	if($SQLPagarMatricula)
	{
		echo "<script language='javascript' type='text/javascript'>alert('Pagamento efetuado!');</script>";
		echo "<script language='javascript' type='text/javascript'>window.location.href='FormLisPagMatricula.php'</script>";
		return true;
	}
	else
	{
		echo "<script language='javascript' type='text/javascript'>alert('Problemas ao efetuar pagamento!');</script>";
		echo "<script language='javascript' type='text/javascript'>window.location.href='FormPagMatricula.php'</script>";
		return false;	
	}
?>