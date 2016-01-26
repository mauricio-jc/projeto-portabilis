<?php

	//Arrumar codificação
	header('Content-Type: text/html; charset=UTF-8');

	require "LibraryPHP.php";

	$conexao = open_connection("universidade");

	$cod_matricula = $_GET['cod_matricula'];

	$SQLInativarMatricula = $conexao->query("UPDATE matricula
												SET ativo = 0
											  WHERE cod_matricula = $cod_matricula");
	if($SQLInativarMatricula)
	{
		echo "<script language='javascript' type='text/javascript'>alert('Matrícula inativada!');</script>";
		echo "<script language='javascript' type='text/javascript'>window.location.href='FormLisMatricula.php'</script>";
		return true;
	}
	else
	{
		echo "<script language='javascript' type='text/javascript'>alert('Não foi possível inativar a matrícula!');</script>";
		echo "<script language='javascript' type='text/javascript'>window.location.href='FormLisMatricula.php'</script>";
		return false;	
	}

?>