<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    
    	<title>Listagem de matrícula</title>
        <?php include "LibraryCss.php"; ?>
    	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    	<!--[if lt IE 9]>
      		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    	<![endif]-->
	</head>
	<body>
		<?php include "header.php"; ?>
			<div class="container">
				<fieldset>
					<legend>Listagem de matrículas</legend>
					<form action="FormLisMatricula.php" method="get">
						<div class="form-group col-md-4">
	                        <input type="text" id="aluno" name="aluno" class="form-control inputUnico" placeholder="Aluno (campo auto-complete)">
                    	</div>
                    	<div class="form-group col-md-3">
	                        <input type="text" id="curso" name="curso" class="form-control inputUnico" placeholder="Curso (campo auto-complete)">
                    	</div>
                    	<div class="form-group col-md-1">
	                        <input type="text" id="ano_matricula" name="ano_matricula" class="form-control inputUnico" placeholder="Ano">
                    	</div>
						<div class="form-group col-md-2">
    	                    
    	                    <select id="situacao" name="situacao" class="form-control inputUnico">
  								<option value="1">Ativo</option>
  								<option value="0">Inativo</option>
  								<option value="">Todos</option>	
							</select>
                    	</div>
                    	<div class="checkbox col-md-1">
    						<label>
      							<input type="checkbox" id="checkPago" name="checkPago" value="0"> Pago
    						</label>
  						</div>
  						<input type="submit" class="btn btn-primary" name="Btn_Listar" value="Listar">
					</form>
						
					<br><br>

					<table id="matriculas" class="table table-hover">
						<thead>
        					<tr>
            					<th>Aluno</th>
            					<th>Curso</th>
					            <th>Período</th>
					            <th>Ano</th>
					            <th>Situação</th>
					            <th>Pago</th>
					            <th>Telefone</th>
					            <th>Ativa/Inativar</th>
        					</tr>
    					</thead>
						<tbody>
	    					<?php
	    						if(isset($_GET['Btn_Listar']))
	    						{
		    						require "LibraryPHP.php";

		    						$conexao = open_connection("universidade");

		    						$aluno         = explode("-", $_GET['aluno']);
		    						$codigo_aluno  = $aluno[0];

		    						$curso         = explode("-", $_GET['curso']);
		    						$codigo_curso  = $curso[0];

		    						$ano_matricula = $_GET['ano_matricula'];
		    						$situacao      = $_GET['situacao'];

		    						$ChWhereAluno = "";
		    						if($codigo_aluno <> "") $ChWhereAluno = " matricula.cod_aluno = $codigo_aluno AND ";

		    						$ChWhereCurso = "";
		    						if($codigo_curso <> "") $ChWhereCurso = " matricula.cod_curso = $codigo_curso AND ";

		    						$ChWhereAno = "";
		    						if($ano_matricula <> "") $ChWhereAno = " ano = $ano_matricula AND ";

		    						$ChWhereSituacao = "";
		    						if($situacao <> "") $ChWhereSituacao = " ativo = $situacao AND ";

		    						$ChWherePago = "";
		    						if(isset($_GET['checkPago'])) $ChWherePago = " pago = 1 AND ";
		    						

    								$SQLListarMatriculas = $conexao->query("SELECT cod_matricula,
    																			   nome_aluno,
       																			   nome_curso,
																		           periodo,
																		           ano,
																		           ativo,
																		           pago,
																		           telefone
																		      FROM aluno, curso, matricula
  																			 WHERE $ChWhereAluno
																				   $ChWhereCurso
																				   $ChWhereAno
																				   $ChWhereSituacao
																				   $ChWherePago
  																			 	   matricula.cod_aluno = aluno.cod_aluno AND
       																			   matricula.cod_curso = curso.cod_curso");
		    						if($SQLListarMatriculas)
    								{
    									while ($RESListarMatriculas = $SQLListarMatriculas->fetch(PDO::FETCH_ASSOC)) 
    									{
    										$cod_matricula = $RESListarMatriculas['cod_matricula'];
    										$nome_aluno    = $RESListarMatriculas['nome_aluno'];
    										$nome_curso    = $RESListarMatriculas['nome_curso'];
    										$ano 		   = $RESListarMatriculas['ano'];
											$telefone 	   = $RESListarMatriculas['telefone'];

		    								if($RESListarMatriculas['periodo'] == 1) $periodo = "Matutino";
    										if($RESListarMatriculas['periodo'] == 2) $periodo = "Vespertino";
    										if($RESListarMatriculas['periodo'] == 3) $periodo = "Integral";

		    								if($RESListarMatriculas['ativo'] == 1)
		    								{
    											$ativo = "Ativo";
    											$botao = "<button type='button' class='btn btn-sm btn-primary' name='Btn_Inativar' onclick='inativar($cod_matricula)'>Inativar</button>";
		    								}
    										else
    										{
    											$ativo = "Inativo";
    											$botao = "<button type='button' class='btn btn-sm btn-primary' name='Btn_Ativar' onclick='ativar($cod_matricula)'>Ativar</button>";
    										}

											if($RESListarMatriculas['pago'] == 1) 
    											$pago = "Sim";
    										else
    											$pago = "Não";
    										?>
												<tr>
													<td><?php echo $nome_aluno; ?></td>
													<td><?php echo $nome_curso; ?></td>
													<td><?php echo $periodo; ?></td>
													<td><?php echo $ano; ?></td>
													<td><?php echo $ativo; ?></td>
													<td><?php echo $pago; ?></td>
													<td><?php echo $telefone; ?></td>
													<td><?php echo $botao; ?></td>
												</tr>
    										<?php
	    								}
    								}
    							}
    						?>
						</tbody>
					</table>
				</fieldset>
			</div>

		<?php include "LibraryJavaScript.php"; ?>
		<script>
            jQuery(function($){
                $("#ano_matricula").mask("9999");
            });

            $(function (){
                $('#aluno').autocomplete({
                    source : 'buscarPessoa.php'
                });
            });

            $(function (){
                $('#curso').autocomplete({
                    source : 'buscarCurso.php'
                });
            });

            $(document).ready(function() {
			    $('#matriculas').DataTable({
			    	"language": {
			    		"sUrl" : "DataTables/br.txt"
			    	}
			    });
			});

			function inativar(cod_matricula)
    		{
    	    	var pergunta = confirm("Deseja mesmo inativar esta matrícula?");
    	 
    	     	if(pergunta == true)
        	    {
    	        	window.location.href = "ModelInativarMatricula.php?cod_matricula="+cod_matricula;
    	     	}
    		}

    		function ativar(cod_matricula)
    		{
    	    	var pergunta = confirm("Deseja mesmo ativar esta matrícula?");
    	 
    	     	if(pergunta == true)
        	    {
    	        	window.location.href = "ModelAtivarMatricula.php?cod_matricula="+cod_matricula;
    	     	}
    		}
        </script>
	</body>
</html>