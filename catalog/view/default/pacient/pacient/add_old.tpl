<?php echo $header; ?>
<?php echo $menu; ?>
<script>
    $(function() {
        $("#tabs").tabs();
        permission('<?php echo $level['id'] ;?>' , '<?php echo $level['label'] ;?>');
    });
</script>

<div class="clear">&nbsp;</div>
<div class="title">Gerenciamento de Pacientes /  Adicionar Novo Paciente</div>
<div class="desktop">        
        <form name="form">
        <div id="tabs">
            <ul>
                <li rel="1"><a href="./pacient/home/add/#tab-1">Paciente</a></li>
                <li rel="2"><a href="./pacient/home/add/#tab-2">Pessoa para Contato</a></li>
            </ul>
            <!---- nivel de acess = 0 --->
            <div id="tab-1">
                <div class="form_desktop">
                    <table style="width:650px">
                        <tr>
                            <td colspan="4" style="width:300px;"><h4>Nome Completo</h4></td>
                            <td colspan="1"><h4>Data de Nascimento</h4></td>
                            <td colspan="1"><h4>Idade</h4></td>
                        </tr>
                        <tr>
                            <td colspan="4"><input name="nome" type="text" rel="req" style="width:350px"/></td>
                            <td colspan="1"><input name="data_nascimento" type="text" rel="req"/></td>
                            <td colspan="1"><input name="idade" type="text"  rel="req"/></td>
                        
                        </tr>
                        <tr>
                            <td colspan="6"><h4>Endereço</h4></td>
                        </tr>
                        <tr>
                            <td colspan="6"><input name="endereco" type="text"/></h4></td>
                        </tr>
                        <tr>
                            <td colspan="3"><h4>Telefone</h4></td>
                            <td colspan="3"><h4>Celular</h4></td>
                        </tr>
                        <tr>
                            <td colspan="3"><input name="telefone" type="text"/></td>
                            <td colspan="3"><input name="celular" type="text"/></td>
                        </tr>
                        <tr>
                            <td colspan="3"><h4>Telefone Internacional </h4></td>
                            <td colspan="3"><h4>Celular Internacional</h4></td>
                        </tr>
                        <tr>
                            <td colspan="3"><input name="int_telephone" type="text"/></td>
                            <td colspan="3"><input name="int_mobile" type="text"/></td>
                        </tr>
                        <tr>
                            <td colspan="3"><h4>E-mail </h4></td>
                            <td colspan="3"><h4>indicação</h4></td>
                        </tr>
                        <tr>
                            <td colspan="3"><input name="email" type="text"/></td>
                            <td colspan="3"><input name="indicacao" type="text"/></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!---- nivel de acess = 0 --->
            <div id="tab-2">
                <div class="form_desktop">
                    <table style="width:600px">
                        <tr>
                            <td colspan="4"><h4> Nome Completo</h4></td>
                            <td colspan="2"> <h4>Relaç&atilde;o</h4></td>
                        </tr>
                        <tr>
                            <td colspan="4"> <input name="ppc_nome" type="text" /></td>
                            <td colspan="2"> <input name="ppc_relacao" type="text" /></td>
                        </tr>
                        <tr>
                            <td colspan="6"><h4>Endereço</h4></td>
                        </tr>
                        <tr>
                            <td colspan="6"><input name="ppc_endereco" type="text" /></td> 
                        </tr>
                        <tr>
                            <td colspan="3"><h4>Numero Para Contato</h4></td>
                            <td colspan="3"><h4> Email</h4></td>
                        </tr>
                        <tr>
                            <td colspan="3"><input name="ppc_telefone" type="text"/></td> 
                            <td colspan="3"><input name="ppc_email" type="text" /></td> 
                        </tr>
                    </table>
                </div>
            </div>
      </div>
      <div id="gravar"><input name="save" type="button" value="Salvar" /></div>        
    </form>
</div>

<script type="text/javascript">
    $(function() {
        
        /** set mask */
         $("input[name=telephone]").mask("(99) 9999 999 9999");
         $("input[name=mobile]").mask("(99) 9999 999 9999");
         $("input[name=ppc_telefone]").mask("(99) 9999 999 9999");         
         $("input[name=data_nascimento]").mask("99/99/9999");
         $("input[name=data_nascimento]").blur(function(){
            var data = $(this).val();
            var str = data.split("/");
            var dia = str[0];
            var mes = str[1];
            var ano = str[2];
            
            $("input[name=idade]").val( calculateAge(mes, dia,ano));
            
            
         });
         
        $("input[name=save]").click(function() {
            var data = $("form[name=form]").serialize();
            $.ajax({
                url: '<?php echo $url; ?>',
                data: data,
                dataType: 'json',
                type: 'post',
                beforeSend: function() {
                  return valida("form[name=form]");
                },
                success: function(e) {
                    if (e.success) {
                        $("#tab-1").html('...Salvo');
                        setTimeut(redirect(e.url), 4000);
                    }
                }
            });
        })

        function redirect(url) {
            window.location = url;
        }


        $(function() {
            'use strict';
            // Change this to the location of your server-side upload handler:
            var url = './catalog/view/default/JS/upload-file/server/php/';
            $('#fileupload').fileupload({
                url: url,
                dataType: 'json',
                done: function(e, data) {
                    $.each(data.result.files, function(index, file) {
                        var lista = '<input name="listfile[]" value="'+file.name +'" type="hidden"/>';
                        $('#doc-list').append('<li><div class="delete">'+file.name+'</div></li>');
                        $('#files').append(lista);
                    });
                },
                progressall: function(e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .progress-bar').css('width', progress + '%'  );
                }
            }).prop('disabled', !$.support.fileInput)
                    .parent().addClass($.support.fileInput ? undefined : 'disabled');
        });

    });
</script>
<script type="text/javascript" src="./catalog/view/default/JS/mask.input.js"></script>


<?php echo $bottom; ?>