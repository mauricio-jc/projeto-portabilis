<script type="text/javascript">
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
</script>