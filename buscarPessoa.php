<?php
	
	include "aluno.class.php";

	$aluno = new Alunos();

	echo json_encode($aluno->buscar_alunos($_GET['term']));

?>