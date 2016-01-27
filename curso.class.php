<?php
	//Arrumar codificação
	header('Content-Type: text/html; charset=UTF-8');

	require "LibraryPHP.php";

	class Cursos
	{
		public function buscar_cursos($nomeCurso)
		{
			$conexao = open_connection();

			$dados = array();

			$Where = "";
			if($nomeCurso == " ")
			{
				$Where = "";
			}
			else
			{
				$Where = " WHERE nome_curso LIKE '%$nomeCurso%' ";
			}

			$SQLBusCurso = $conexao->query("SELECT cod_curso,
												   nome_curso,
												   periodo 
											  FROM curso 
											$Where
											 LIMIT 7");
			if($SQLBusCurso)
			{
				while ($RESBusCurso = $SQLBusCurso->fetch(PDO::FETCH_ASSOC)) 
				{
					if($RESBusCurso['periodo'] == 1) $periodo = "Matutino";
					if($RESBusCurso['periodo'] == 2) $periodo = "Vespertino";
					if($RESBusCurso['periodo'] == 3) $periodo = "Integral";

					$dados[] = array("value" => $RESBusCurso['cod_curso'] . "-" . $RESBusCurso['nome_curso'] . "-" . $periodo);
				}
			}
			return $dados;
		}
	}	
?>