<form name="dados-paciente" action="<?php echo $url; ?>">
    <input name="id_paciente" value="<?php echo $id_paciente; ?>" type="hidden"/>
    <div class="form_desktop">
        <table>
            <tr>
                <td colspan="6"><h4>Nome Completo</h4></td>

            </tr>
            <tr>
                <td colspan="6"><input name="nome" type="text" rel="req" value="<?php echo isset($dados['nome']) ? $dados['nome'] : ''; ?>"/></td>
            </tr>
            <tr>
                <td colspan="3"><h4>Data de Nascimento</h4></td>
                <td colspan="3"><h4>Idade</h4></td>
            </tr>
            <tr>
                <td colspan="3"><input name="data_nascimento" type="text" rel="req" value="<?php echo isset($dados['data_nascimento']) ? $dados['data_nascimento'] : ''; ?>"/></td>
                <td colspan="3"><input name="idade" type="text"  rel="req" value="<?php echo isset($dados['idade']) ? $dados['idade'] : ""; ?>"/></td>

            </tr>
            <tr>
                <td colspan="6"><h4>Endereço</h4></td>
            </tr>
            <tr>
                <td colspan="6"><input name="endereco" type="text"  value="<?php echo isset($dados['endereco']) ? $dados['endereco'] : ''; ?>"/></h4></td>
            </tr>
            <tr>
                <td colspan="3"><h4>Telefone</h4></td>
                <td colspan="3"><h4>Celular</h4></td>
            </tr>
            <tr>
                <td colspan="3"><input name="telefone" type="text"   value="<?php echo isset($dados['telephone']) ? $dados['telephone'] : ''; ?>"/></td>
                <td colspan="3"><input name="celular" type="text"  value="<?php echo isset($dados['mobile']) ? $dados['mobile'] : ''; ?>"/></td>
            </tr>
            <tr>
                <td colspan="3"><h4>Telefone Internacional </h4></td>
                <td colspan="3"><h4>Celular Internacional</h4></td>
            </tr>
            <tr>
                <td colspan="3"><input name="int_telephone" value="<?php echo isset($dados['int_telephone']) ? $dados['int_telephone'] : ""; ?>" type="text"/></td>
                <td colspan="3"><input name="int_mobile" type="text" value="<?php echo isset($dados['int_mobile']) ? $dados['int_mobile'] : ""; ?>"/></td>
            </tr>
            <tr>
                <td colspan="3"><h4>E-mail </h4></td>
                <td colspan="3"><h4>indicação</h4></td>
            </tr>
            <tr>
                <td colspan="3"><input name="email" type="text"  value="<?php echo isset($dados['email']) ? $dados['email'] : ''; ?>"/></td>
                <td colspan="3"><input name="indicacao" type="text"  value="<?php echo isset($dados['indicacao']) ? $dados['indicacao'] : ''; ?>"/></td>
            </tr>
        </table>
    </div>
</form>
<script>
    $(document).ready(function() {
        $("input[name=telefone]").mask("(99) 9999 999 9999");
        $("input[name=celular]").mask("(99) 9999 999 9999");
        $("input[name=int_telephone]").mask("(99)(99)9999 9999");
        $("input[name=int_mobile]").mask("(99)(99)9999 9999");
        $("input[name=data_nascimento]").mask("99/99/9999");
        $("input[name=data_nascimento]").blur(function() {
            var data = $(this).val();
            var str = data.split("/");
            var dia = str[0];
            var mes = str[1];
            var ano = str[2];
            $("input[name=idade]").val(calculateAge(mes, dia, ano));
        });
    });
</script>