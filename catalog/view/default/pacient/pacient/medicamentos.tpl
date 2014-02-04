<form name='medicamentos' action="<?php echo $url; ?>">
    <input name='id_paciente' value='<?php echo $id_paciente; ?>' type="hidden" />
    <div class="clear">&nbsp;</div>
    <div>
        <input name="cal" value="Adicionar Medicamento" type="button" style="width: 300px;"/>
    </div>
    <div id="calculo-medicamento"></div> 
    <div class="clear">&nbsp;</div>
</form>
<script type="text/javascript">
    $(document.body).ready(function() {

        $('input[name=cal]').click(function() {
            var id = '&id_paciente=' + ' <?php echo $id_paciente; ?>';
            openWindow('./pacient/home/medicamentosForm/' + id);
        });
        loadAccount();
        function openWindow(url) {
            $.colorbox({
                iframe: true, width: "50%", height: "75%", href: url, onClosed: function() {
                        loadAccount();
                }
            });
        }
        function loadAccount() {
            $.ajax({
                url: '<?php echo $url; ?>',
                data: 'id_paciente=' + $('input[name=id_paciente]').val(),
                type: 'post',
                dataType: 'json',
                success: function(e) {
                    var html = '<div class="fin-header">';
                        html += '<div> <h4>Servico Serviço / ou Produto </h4></div>';
                        html += '<div> <h4>Valor </h4></div>';
                        html += '<div> <h4>Metodo de Pagamento </h4></div>';
                        html += '<div> <h4>Total Pago </h4></div>';
                        html += '<div> <h4>quantidade </h4></div>'; 
                        html += '</div>';
                     var totaldevedor = 0;
                    $.each(e , function(i , v){
                        html += '<div class="fin-body">';
                        html += '<div> ' + v.servico + ' </div>';
                        html += '<div>  ' + v.value + ' </div>';
                        html += '<div>  ' + v.metodo + ' </div>';
                        html += '<div> ' + v.totalpago + ' </div>';
                        html += '<div> ' + v.quantidade + ' </div>'; 
                        html += '</div>';
                        
                        totaldevedor += (v.value - v.totalpago);
                    });
                    html += '</div>';
                    html += '<div class="fin-total"><div>Total Devedor:</div><div>'+ totaldevedor +'</div></div>';
                    $('#calculo-medicamento').html(html);
                    
                }
            })
        }
    })
</script>
<link href='./catalog/view/default/CSS/colorbox.css' rel='stylesheet' />
<script src="./catalog/view/default/JS/colorbox-master/jquery.colorbox.js"></script>
