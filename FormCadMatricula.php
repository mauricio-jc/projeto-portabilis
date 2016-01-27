<!DOCTYPE html>
<html lang="pt-br">
	<head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>Cadastro de matriculas</title>
        <?php include "LibraryCss.php"; ?>
    	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    	<!--[if lt IE 9]>
      		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    	<![endif]-->
  	</head>
  	<body>
        <?php include "LibraryPHP.php"; ?>
        <?php include "header.php"; ?>

        <div class="container">
            <fieldset class="col-md-8 col-md-offset-2">
                <legend>Cadastro de matrículas</legend>
                <form action="ModelCadMatricula.php" method="get" onsubmit="return validarPreenchimentoDosCampos();">
                    <div class="form-group">
                        <label>Aluno: *</label>
                        <input type="text" id="nome_aluno" name="nome_aluno" class="form-control inputUnico" placeholder="Campo auto-complete">
                    </div>
                    <div class="form-group">
                        <label>Curso: *</label>
                        <select id="curso" name="curso" class="form-control inputUnico">
                            <option value="0">----Selecione um curso----</option>
                                <?php 
                                    $conexao = open_connection();

                                    $SQLBusCurso = $conexao->query("SELECT cod_curso,
                                                                           nome_curso,
                                                                           periodo
                                                                      FROM curso");
                                    if($SQLBusCurso)
                                    {
                                        while($RESBusCurso = $SQLBusCurso->fetch(PDO::FETCH_ASSOC))
                                        {
                                            $cod_curso  = $RESBusCurso['cod_curso'];
                                            $nome_curso = $RESBusCurso['nome_curso'];
                                            $periodo    = $RESBusCurso['periodo'];

                                            if($periodo == 1) $periodo = "Matutino";
                                            if($periodo == 2) $periodo = "Vespertino";
                                            if($periodo == 3) $periodo = "Integral";

                                            ?>
                                                <option value="<?php echo $cod_curso; ?>"><?php echo $nome_curso ." - ". $periodo ; ?></option>
                                            <?php 
                                        }
                                    }

                                ?>  
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Data da matrícula: *</label>
                        <input type="text" id="data_matricula" name="data_matricula" class="form-control inputUnico">
                    </div>
                    <div class="form-group">
                        <label>Ano da matrícula: *</label>
                        <input type="text" id="ano_matricula" name="ano_matricula" class="form-control inputUnico">
                    </div>
                    <input class="btn btn-primary" type="submit" id="Btn_Salvar" name="Btn_Salvar" value="Salvar">
                </form>    
            </fieldset>
        </div>
        <?php include "LibraryJavaScript.php"; ?>
        <script type="text/javascript">
            $(function (){
                $('#nome_aluno').autocomplete({
                    source : 'buscarPessoa.php'
                });
            });

            jQuery(function($){
                $("#data_matricula").mask("99/99/9999");
                $("#ano_matricula").mask("9999");
            });

            function validarPreenchimentoDosCampos()
            {
                if(document.getElementById("nome_aluno").value == "")
                {
                    alert("É necessário informar o nome do aluno!");
                    document.getElementById("nome_aluno").focus();
                    return false;
                }
                if(document.getElementById("curso").value == 0)
                {
                    alert("É necessário informar o curso!");
                    document.getElementById("curso").focus();
                    return false;
                }
                if(document.getElementById("data_matricula").value == "")
                {
                    alert("É necessário informar a data de matricula!");
                    document.getElementById("data_matricula").focus();
                    return false;
                }
                if(document.getElementById("ano_matricula").value == "")
                {
                    alert("É necessário informar o ano da matricula!");
                    document.getElementById("ano_matricula").focus();
                    return false;
                }
                return true;
            }   
        </script>
    </body>
</html>