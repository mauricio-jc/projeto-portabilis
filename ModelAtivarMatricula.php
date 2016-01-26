<?php

	//Arrumar codificação
	header('Content-Type: text/html; charset=UTF-8');

	require "LibraryPHP.php";

	$conexao = open_connection("universidade");

	$cod_matricula = $_GET['cod_matricula'];

	$SQLAtivarMatricula = $conexao->query("UPDATE matricula
												SET ativo = 1
											  WHERE cod_matricula = $cod_matricula");
	if($SQLAtivarMatricula)
	{
		echo "<script language='javascript' type='text/javascript'>alert('Matrícula ativada!');</script>";
		echo "<script language='javascript' type='text/javascript'>window.location.href='FormLisMatricula.php'</script>";
		return true;
	}
	else
	{
		echo "<script language='javascript' type='text/javascript'>alert('Não foi possível ativar a matrícula!');</script>";
		echo "<script language='javascript' type='text/javascript'>window.location.href='FormLisMatricula.php'</script>";
		return false;	
	}

?>