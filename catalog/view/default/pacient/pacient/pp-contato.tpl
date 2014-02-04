<div class="form_desktop">
    <form name="pp-contato" action="<?php echo $url; ?>">
        <input name="id_paciente" value="<?php echo $id_paciente; ?>" type="hidden"/>
        
        <table >
                <tr>
                    <td colspan="4"><h4> Nome Completo</h4></td>
                    <td colspan="2"> <h4>Relaç&atilde;o</h4></td>
                </tr>
                <tr>
                    <td colspan="4"> <input name="ppc_nome" type="text" value="<?php echo isset($pp_contato['ppc_nome']) ? $pp_contato['ppc_nome'] : ''; ?>"/></td>
                    <td colspan="2"> <input name="ppc_relacao" type="text" value="<?php echo isset($pp_contato['ppc_relacao']) ? $pp_contato['ppc_relacao'] : ''; ?>" /></td>
                </tr>
                <tr>
                    <td colspan="6"><h4>Endereço</h4></td>
                </tr>
                <tr>
                    <td colspan="6"><input name="ppc_endereco" type="text" value="<?php echo isset($pp_contato['ppc_endereco']) ? $pp_contato['ppc_endereco'] : ''; ?>" /></td> 
                </tr>
                <tr>
                    <td colspan="3"><h4>Numero de Contato</h4></td>
                    
                </tr>
                <tr>
                    <td colspan="3"><input name="ppc_telefone" id="telefone"type="text" value="<?php echo isset($pp_contato['ppc_telefone']) ? $pp_contato['ppc_telefone'] : ''; ?>"/></td> 
                </tr>
                <tr><td colspan="3"><h4> Email</h4></td></tr>
                <tr>
                    <td colspan="6"><input name="ppc_email" type="text" value="<?php echo isset($pp_contato['ppc_email']) ? $pp_contato['ppc_email'] : ''; ?>"/></td> 
                </tr>
            </table> 
       
    </form>
</div>
<script>
    $(document).ready(function(){
        $("#telefone").mask("(99) 9999 999 9999");
    });
</script>
