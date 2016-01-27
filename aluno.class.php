<?php
	//Arrumar codificação
	header('Content-Type: text/html; charset=UTF-8');

	require "LibraryPHP.php";

	class Alunos
	{
		public function buscar_alunos($nomePessoa)
		{
			$conexao = open_connection();

			$dados = array();

			$Where = "";
			if($nomePessoa == " ")
			{
				$Where = "";
			}
			else
			{
				$Where = " WHERE nome_aluno LIKE '%$nomePessoa%' ";
			}

			$SQLBusAluno = $conexao->query("SELECT cod_aluno,
												   nome_aluno
											  FROM aluno 
											$Where
											 LIMIT 7");
			if($SQLBusAluno)
			{
				while ($RESBusAluno = $SQLBusAluno->fetch(PDO::FETCH_ASSOC)) 
				{
					$dados[] = array("value" => $RESBusAluno['cod_aluno'] . "-" . $RESBusAluno['nome_aluno']);
				}
			}
			return $dados;
		}
	}	
?>