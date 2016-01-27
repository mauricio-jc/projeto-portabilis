<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    
    	<title>Pagamento de matrícula</title>
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

             <?php 
                require "LibraryPHP.php";

                $conexao = open_connection();

                $cod_matricula = $_GET['cod_matricula'];

                $SQLBusValorInscricao = $conexao->query("SELECT curso.cod_curso,
                                                                valor_inscricao,
                                                                cod_matricula
                                                           FROM curso, matricula
                                                          WHERE curso.cod_curso = matricula.cod_curso AND
                                                                cod_matricula   = $cod_matricula");
                if($SQLBusValorInscricao)
                {
                    $RESBusValorInscricao = $SQLBusValorInscricao->fetch(PDO::FETCH_ASSOC);
                    $valor_inscricao = number_format($RESBusValorInscricao['valor_inscricao'], 2, ",", ".");
                }
                
            ?>

            <fieldset class="col-md-8 col-md-offset-2">
                <legend>Pagamento de matrícula # <?php echo $cod_matricula . " Valor da inscrição - R$ " . $valor_inscricao; ?></legend>
                <form action="ModelPagMatricula.php" onsubmit="return validarCampo();">
                     <div class="form-group">
                        <input type="hidden" id="cod_matricula" name="cod_matricula" class="form-control" value="<?php echo $cod_matricula; ?>">
                    </div>

                    <div class="form-group">
                        <input type="hidden" id="valor_inscricao" name="valor_inscricao" class="form-control" value="<?php echo $valor_inscricao; ?>">
                    </div>

                    <div class="form-group">
                        <label>Valor: *</label>
                        <input type="text" id="valor_pago" name="valor_pago" class="form-control inputUnico" onblur="return retornarTroco();">
                    </div>
                    <div class="form-group">
                        <label>Troco:</label>
                        <input type="text" id="valor_troco" name="valor_troco" class="form-control inputUnico">
                    </div>
                    <input type="submit" id="Btn_Pagar" name="Btn_Pagar" class="btn btn-primary" value="Efetuar pagamento">
                </form>
            </fieldset>
        </div>
        
        <?php include "LibraryJavaScript.php"; ?>
        <script>
            $(document).ready(function(){
                $("#valor_pago").maskMoney({decimal:",", thousands:".", defaultZero: false, allowZero: true});
            });

            function validarCampo()
            {
                if(document.getElementById("valor_pago").value == "")
                {
                    alert("É necessário informar o valor da inscrição!");
                    document.getElementById("valor_pago").focus();
                    return false;
                }
                return true;
            }

            function retornarTroco()
            {
                pago      = document.getElementById("valor_pago").value;
                inscricao = document.getElementById("valor_inscricao").value;

                pago = pago.replace(/[\.]/ , "");
                pago = pago.replace(/[\,]/ , ".");

                inscricao = inscricao.replace(/[\.]/ , "");
                inscricao = inscricao.replace(/[\,]/ , ".");

                troco = pago - inscricao;

                troco = number_format(troco, 2, ",", ".");

                document.getElementById("valor_troco").value = troco;
                return true;
            }
        </script>
    </body>
</html>