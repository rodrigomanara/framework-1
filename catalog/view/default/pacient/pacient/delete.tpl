<?php echo $header; ?>
<?php echo $menu; ?>

    <div class="desktop"> 
        <form name="form">
        <div class="div_form">
            <div class="div_form_body div_space_between width-550"> Deseja Realmente excluir este paciente</div>
        </div>
        <div><input name="excluir" type="button" value="excluir"/></div>
        </form>
    </div>
<script>
    $(function(){
        $('input[name=excluir]').click(function(){
            $.ajax({
                url : '<?php echo $url; ?>',
                data : '&id_paciente=' + <?php echo $id_paciente;?>,
                type : 'post',
                dataType : 'json',
                success : function(e){
                     if(e.success)
                         $('.desktop').html('Paciente excluido do sistema!!!');
                }
            });
        })
    })
</script>
<?php echo $bottom; ?>
