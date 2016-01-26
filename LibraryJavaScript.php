<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jqueryMask.js"></script>
<script src="js/maskMoney.js"></script>
<script src="js/numberFormat.js"></script>
<script src="DataTables/media/js/jquery.dataTables.js"></script>
<script src="DataTables/media/js/dataTables.bootstrap.js"></script>
<script src="jquery-ui.custom/jquery-ui.min.js"></script>
<script>
	$(document).ready(function(){
    	$('.inputUnico').keypress(function(e)
       	{
        	var tecla = (e.keyCode?e.keyCode:e.which);
            if(tecla == 13)
            {
                campo =  $('.inputUnico');
                indice = campo.index(this);
                if(campo[indice+1] != null)
                {
            	    proximo = campo[indice + 1];
                    proximo.focus();
                }
                else
                {
                    return true;
                } 
            }
            if(tecla == 13)
            {
            	e.preventDefault(e);
                return false;
            }
            else
            {
                return true;
            }
        })
    });
</script>