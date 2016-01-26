<?php

	//Arrumar codificação
	header('Content-Type: text/html; charset=UTF-8');

	//Chama a biblioteca com algumas funções
	include "LibraryPHP.php";

	//Abre a conexão com o banco de dados
	$conexao = open_connection("universidade");

	if(isset($_GET['Btn_Salvar']))
	{	
		$nome 			 = $_GET['nome']; 
		$data_nascimento = $_GET['data_nascimento'];
		$telefone 		 = $_GET['telefone'];
		$cpf 			 = $_GET['cpf'];
		$rg 			 = $_GET['rg'];

		//Tira os pontos e o traço
		$cpfInt = preg_replace("/[\.\-]/", "", $cpf);

		$SQLVerCpf = $conexao->query("SELECT COUNT(*) as linhacpf 
			 						    FROM aluno 
			 						   WHERE cpf = '$cpfInt'");
		
		if($SQLVerCpf)
		{
			$RESVerCpf = $SQLVerCpf->fetch(PDO::FETCH_ASSOC);
			if($RESVerCpf['linhacpf'] >= 1)
			{
				echo "<script language='javascript' type='text/javascript'>alert('Aluno já cadastratdo com esse cpf!');</script>";
				echo "<script language='javascript' type='text/javascript'>window.location.href='FormCadAluno.php'</script>";
				return false;
			}
			else
			{
				//Converte a data para o formato do banco de dados
				$dataFormatada = convert_date_base($data_nascimento);

				$SQLIncAluno = $conexao->query("INSERT INTO aluno(cpf,rg,data_nascimento,nome_aluno,telefone)
													 VALUES('$cpfInt', '$rg', '$dataFormatada', '$nome', '$telefone')");

				if($SQLIncAluno)
				{
					echo "<script language='javascript' type='text/javascript'>alert('Aluno cadastratdo com sucesso!');</script>";
					echo "<script language='javascript' type='text/javascript'>window.location.href='FormCadAluno.php'</script>";
					return true;
				}
				else
				{
					echo "<script language='javascript' type='text/javascript'>alert('Problemas ao cadastrar o aluno!');</script>";
					echo "<script language='javascript' type='text/javascript'>window.location.href='FormCadAluno.php'</script>";
					return false;
				}
			}
		}
	}
?>