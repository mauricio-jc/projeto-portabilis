<?php
	//Arrumar codificação
	header('Content-Type: text/html; charset=UTF-8');

	include "LibraryPHP.php";

	$conexao = open_connection("universidade");

	if(isset($_GET['Btn_Salvar']))
	{
		$nome_curso 	 = $_GET['nome_curso'];
		$periodo    	 = $_GET['periodo'];
		$valor_inscricao = $_GET['valor_inscricao'];

		//Tira os pontos
		$valor_inscricao = preg_replace("/\./", "", $valor_inscricao);

		//Substitui a vírgula por pontos para poder gravar no banco
		$valor_inscricao = preg_replace("/[\,]/", ".", $valor_inscricao);

		$SQLIncCurso = $conexao->query("INSERT INTO curso(nome_curso, valor_inscricao, periodo)
											       VALUES('$nome_curso', $valor_inscricao, $periodo)");
		if($SQLIncCurso)
		{
			echo "<script language='javascript' type='text/javascript'>alert('Curso cadastrado com sucesso!');</script>";
			echo "<script language='javascript' type='text/javascript'>window.location.href='FormCadCurso.php'</script>";
			return true;
		}
		else
		{
			echo "<script language='javascript' type='text/javascript'>alert('Problemas ao cadastrar curso!');</script>";
			echo "<script language='javascript' type='text/javascript'>window.location.href='FormCadCurso.php'</script>";
			return false;
		}
	}
?>