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
                <fieldset>
                    <legend>Pagamento de matrículas</legend>
                        
                        <table id="example" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Código da matrícula</th>
                                <th>Aluno</th>
                                <th>Curso</th>
                                <th>Data da matrícula</th>
                                <th>Valor da inscrição</th>
                                <th>Pago</th>
                                <th>Pagar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                require "LibraryPHP.php";

                                $conexao = open_connection("universidade");

                                $SQLLisPagMatricula = $conexao->query("SELECT matricula.cod_aluno,
                                                                              cod_matricula,
                                                                              nome_aluno,
                                                                              nome_curso,
                                                                              valor_inscricao,
                                                                              data_matricula,
                                                                              pago
                                                                         FROM aluno, curso, matricula
                                                                        WHERE aluno.cod_aluno = matricula.cod_aluno AND
                                                                              curso.cod_curso = matricula.cod_curso AND
                                                                              ativo = 1");
                                if($SQLLisPagMatricula)
                                {
                                    while($RESLisPagMatricula = $SQLLisPagMatricula->fetch(PDO::FETCH_ASSOC))
                                    {
                                        $cod_matricula   = $RESLisPagMatricula['cod_matricula'];
                                        $nome_aluno      = $RESLisPagMatricula['nome_aluno'];
                                        $nome_curso      = $RESLisPagMatricula['nome_curso'];
                                        $valor_inscricao = number_format($RESLisPagMatricula['valor_inscricao'], 2, ",", ".");
                                        $dateScreen      = convert_date_screen($RESLisPagMatricula['data_matricula']);

                                        if($RESLisPagMatricula['pago'] == 0) 
                                        {
                                            $pago = "Não";
                                            $botaoPagar = "<button type='button' class='btn btn-sm btn-primary' name='Btn_Pagar' onclick='pagar($cod_matricula)'>Pagar</button>";
                                        }
                                        if($RESLisPagMatricula['pago'] == 1) 
                                        {
                                            $pago = "Sim";
                                            $botaoPagar = "";
                                        }

                                        ?>
                                            <tr>
                                                <td align="center"><?php echo $cod_matricula; ?></td>
                                                <td><?php echo $nome_aluno; ?></td>
                                                <td><?php echo $nome_curso; ?></td>
                                                <td><?php echo $dateScreen; ?></td>
                                                <td><?php echo $valor_inscricao; ?></td>
                                                <td><?php echo $pago; ?></td>
                                                <td><?php echo $botaoPagar; ?></td>
                                            </tr>                                            
                                        <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </fieldset>
            </div>
        <?php include "LibraryJavaScript.php"; ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#example').DataTable({
                    "language": {
                        "sUrl" : "DataTables/br.txt"
                    }
                });
            });

            function pagar(cod_matricula)
            {
                window.location.href = "FormPagMatricula.php?cod_matricula="+cod_matricula;
            }
        </script>
    </body>
</html>