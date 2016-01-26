<!DOCTYPE html>
<html lang="pt-br">
	<head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    
    	<title>Cadastro de alunos</title>
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
                <legend>Cadastro de alunos</legend>
                <form action="ModelCadAluno.php" method="get" onsubmit="return validarPreenchimentoDosCampos();">
                    <div class="form-group">
                        <label>Nome: *</label>
                        <input type="text" id="nome" name="nome" class="form-control inputUnico">
                    </div>
                     <div class="form-group">
                        <label>Data de nascimento: *</label>
                        <input type="text" id="data_nascimento" name="data_nascimento" class="form-control inputUnico" onblur="return veriAnoBissexto(this.value);">
                    </div>
                    <div class="form-group">
                        <label>Telefone: *</label>
                        <input type="text" id="telefone" name="telefone" class="form-control inputUnico">
                    </div>
                    <div class="form-group">
                        <label>CPF: *</label>
                        <input type="text" id="cpf" name="cpf" class="form-control inputUnico" onblur="return validaCpf(this.value);">
                    </div>
                    <div class="form-group">
                        <label>RG: *</label>
                        <input type="text" id="rg" name="rg" class="form-control inputUnico">
                    </div>
                    <input type="submit" class="btn btn-primary" name="Btn_Salvar" value="Salvar">
                </form>
            </fieldset>
        </div>
    	
    	<?php include "LibraryJavaScript.php"; ?>
        <script>
            jQuery(function($){
                $("#telefone").mask("(99)9999-9999");
                $("#cpf").mask("999.999.999-99");
                $("#data_nascimento").mask("99/99/9999");
            });

            function validaCpf(cpf)
            {
                if(cpf == "")
                {
                    return true;
                }
                else
                {
                    cpfNovo = cpf.replace(/[\-\.]/g , "");
                    x = 10;
                    soma = 0;
                    resto = 0;
                    primeiro_dig_veri = 0;
                    segundo_dig_veri  = 0;

                    if( cpfNovo == "11111111111" ||
                        cpfNovo == "22222222222" ||
                        cpfNovo == "33333333333" ||
                        cpfNovo == "44444444444" ||
                        cpfNovo == "55555555555" ||
                        cpfNovo == "66666666666" ||
                        cpfNovo == "77777777777" ||
                        cpfNovo == "88888888888" ||
                        cpfNovo == "99999999999")
                    {
                        alert("CPF inválido");
                        document.getElementById("cpf").value = "";
                        document.getElementById("cpf").focus();
                        return false;
                    }

                    for(i = 0; i <= 8; i++)
                    {
                        soma = soma + (cpfNovo[i] * x);
                        x--;
                    }

                    resto = soma % 11;

                    if(resto < 2) 
                        primeiro_dig_veri = 0;
                    else
                        primeiro_dig_veri = 11 - resto;

                    x = 11;
                    soma = 0;

                    for(i = 0; i <= 9; i++)
                    {
                        soma = soma + (cpfNovo[i] * x);
                        x--;
                    }

                    resto = 0;
                    resto = soma % 11;

                    if(resto < 2) 
                        segundo_dig_veri = 0;
                    else
                        segundo_dig_veri = 11 - resto;

                    if(cpfNovo[9] != primeiro_dig_veri || cpfNovo[10] != segundo_dig_veri)
                    {
                        alert("CPF inválido");
                        document.getElementById("cpf").value = "";
                        document.getElementById("cpf").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
            }

            function veriAnoBissexto(data_nascimento)
            {
                ano = data_nascimento.split("/");

                if(((ano[2] % 4) == 0) && ((ano[2] % 100) != 0) || ((ano[2] % 400) == 0))
                {
                    alert("Este é um ano bissexto!");
                    return true;
                }
            }

            function validarPreenchimentoDosCampos()
            {
                if(document.getElementById("nome").value == "")
                {
                    alert("É necessário informar seu nome!");
                    document.getElementById("nome").focus();
                    return false;
                }
                if(document.getElementById("telefone").value == "")
                {
                    alert("É necessário informar seu telefone!");
                    document.getElementById("telefone").focus();
                    return false;
                }
                if(document.getElementById("cpf").value == "")
                {
                    alert("É necessário informar seu cpf!");
                    document.getElementById("cpf").focus();
                    return false;
                }
                if(document.getElementById("rg").value == "")
                {
                    alert("É necessário informar seu rg!");
                    document.getElementById("rg").focus();
                    return false;
                }
                if(document.getElementById("data_nascimento").value == "")
                {
                    alert("É necessário informar sua data de nascimento!");
                    document.getElementById("data_nascimento").focus();
                    return false;
                }
                return true;
            }
        </script>
  	</body>
</html>