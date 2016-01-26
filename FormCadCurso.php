<!DOCTYPE html>
<html lang="pt-br">
	<head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    
    	<title>Cadastro de cursos</title>
        <?php include "LibraryCss.php";?>
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
            <fieldset class="col-md-8 col-md-offset-2">
                <legend>Cadastro de cursos</legend>
                <form action="ModelCadCurso.php" method="get" onsubmit="return validarPreenchimentoDosCampos();">
                    <div class="form-group">
                        <label>Nome do curso: *</label>
                        <input type="text" id="nome_curso" name="nome_curso" class="form-control inputUnico">
                    </div>
                    <div class="form-group">
                        <label>Período: *</label>
                        <select id="periodo" name="periodo" class="form-control inputUnico">
                            <option value="0">----Selecione um período----</option>
                            <option value="1">Matutino</option>
                            <option value="2">Vespertino</option>    
                            <option value="3">Integral</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Valor da inscrição: *</label>
                        <input type="text" id="valor_inscricao" name="valor_inscricao" class="form-control inputUnico">
                    </div>
                    <input type="submit" class="btn btn-primary" id="Btn_Salvar" name="Btn_Salvar" value="Salvar">
                </form>
            </fieldset>
        </div>

        <?php include "LibraryJavaScript.php"; ?>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#valor_inscricao").maskMoney({decimal:",", thousands:".", defaultZero: false, allowZero: true});
            });

            function validarPreenchimentoDosCampos()
            {
                if(document.getElementById("nome_curso").value == "")
                {
                    alert("É necessário informar o nome do curso!");
                    document.getElementById("nome_curso").focus();
                    return false;   
                }
                if(document.getElementById("periodo").value == 0)
                {
                    alert("É necessário informar o período!");
                    document.getElementById("periodo").focus();
                    return false;
                }
                if(document.getElementById("valor_inscricao").value == "")
                {
                    alert("É necessário informar o valor da inscrição!");
                    document.getElementById("valor_inscricao").focus();
                    return false;
                }
                return true;
            }
        </script>
    </body>
</html>