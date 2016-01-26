<?php
	
	include "curso.class.php";

	$curso = new Cursos();

	echo json_encode($curso->buscar_cursos($_GET['term']));

?>