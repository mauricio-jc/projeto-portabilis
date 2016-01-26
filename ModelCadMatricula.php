<?php

	//Arrumar codificação
	header('Content-Type: text/html; charset=UTF-8');

	//Chama a biblioteca com algumas funções
	include "LibraryPHP.php";

	//Abre a conexão com o banco de dados
	$conexao = open_connection("universidade");

	if(isset($_GET['Btn_Salvar']))
	{
		$nome_aluno = $_GET['nome_aluno'];
		$cod_curso = $_GET['curso'];
		$data_matricula = $_GET['data_matricula'];
		$ano_matricula = $_GET['ano_matricula'];

		//Pegar apenas o código do aluno
		$nome_aluno = explode("-", $nome_aluno);
		$cod_aluno  = $nome_aluno[0];

		//Converter data para o formato do banco;
		$data_matricula_formatada = convert_date_base($data_matricula);

		$SQLVerificarCurso = $conexao->query("SELECT COUNT(*) AS matricula 
									            FROM matricula
										       WHERE cod_aluno = $cod_aluno AND
      									 	   		 cod_curso = $cod_curso AND
      										   		 ano       = $ano_matricula");
		if($SQLVerificarCurso)
		{
			$RESVerificarCurso = $SQLVerificarCurso->fetch(PDO::FETCH_ASSOC);
			if($RESVerificarCurso['matricula'] >= 1)
			{
				echo "<script language='javascript' type='text/javascript'>alert('Aluno já cadastratdo neste curso para este periodo e ano!');</script>";
				echo "<script language='javascript' type='text/javascript'>window.location.href='FormCadMatricula.php'</script>";
				return false;
			}
			else
			{
				$SQLIncMatricula = $conexao->query("INSERT INTO matricula(cod_aluno, cod_curso, data_matricula, ano, ativo, pago)
														 VALUES ($cod_aluno, $cod_curso, '$data_matricula_formatada', $ano_matricula, 1, 0)");
				if($SQLIncMatricula)
				{
					echo "<script language='javascript' type='text/javascript'>alert('Aluno matriculado com sucesso!');</script>";
					echo "<script language='javascript' type='text/javascript'>window.location.href='FormCadMatricula.php'</script>";
					return true;
				}
				else
				{
					echo "<script language='javascript' type='text/javascript'>alert('Problemas ao matricular aluno!');</script>";
					echo "<script language='javascript' type='text/javascript'>window.location.href='FormCadMatricula.php'</script>";
					return true;
				}
			}
		}
	}
?>