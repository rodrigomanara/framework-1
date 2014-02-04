<?php echo $header; ?>
<?php echo $menu; ?>
<style type="text/css">
    table{width: 550px; border: 1px solid black; padding: 5px; }
    table thead{background-color:#e2cb6e; color: "chocolate"; }
    table thead th{padding: 2px;padding-left: 5px;}
    table > tbody td{ border: 1px dotted black; }
</style>
<div class="desktop"> 
    <form method="post" action="./calender/home/calendar/" autocomplete="no" name="form">
        <?php $limit = 7; ?>
        <table>
            <thead>
            <th colspan="7">
                Procurar Agendamento Por Data
            </th>
            </thead>
            <tbody>
            <td colspan="7"> 
                <table>
                    <tr>
                        <td> M&ecirc;s</td>
                        <td> Ano</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="mes">
                                <?php for ($i = 1; $i < 12; $i++) { ?>
                                    <option <?php echo ((int)$i === (int)$month ? "selected" : "");?> value="<?php echo $i; ?>"> <?php echo date('M', mktime(0, 0, 0, $i)); ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>
                            <select name="ano">
                                <?php for ($i = 2010; $i < (date('Y') + 5); $i++) { ?>
                                    <option <?php echo ((int)$i === (int)$year ? "selected" : "");?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td style="width: 100px;"><input name="procurar" type="button" value="Procura"/></td>
                    </tr>
                </table>
            </td>
            </tbody>
            <thead>
                <?php foreach ($week_list as $d) { ?>
                <th><?php echo $d; ?></th>
            <?php } ?>
            </thead>
            <?php foreach ($calendar as $cal) { ?> 
                <?php foreach ($week_list as $key => $d) { ?>
                    <?php if ($cal['day_week'] === $d) { ?>
                        <?php
                        if ((int) $cal['day'] === 1) {
                            for ($a = 1; $a < $key; $a++) {
                                echo "<td></td>";
                            }
                        }
                        ?>
                        <td onclick="buscarHora('<?php echo $cal['day']; ?>')"><?php echo $cal['day']; ?></td>
                    <?php } ?>
                <?php } ?>
                <?php if ($cal['day_week'] === $week_list[$limit]) { ?>

                </tbody><tbody>
            <?php } ?>
        <?php } ?>
     </div> 
</form>
 <?php echo $bottom; ?>
    <script>
        $(document.body).ready(function() {
            $("input[name=procurar]").click(function() {
                $("form").submit();
            })
            
        });
        
        function buscarHora(element){
           var mes =  $("select[name=mes]").val();
           var ano =  $("select[name=ano]").val();
           var dia =  element;
           var data = "&data=" + dia +"-" + mes + "-" + ano;
           
           $.ajax({
               data : data,
               url : './pacient/pacient/getTime/',
               dataType : 'json',
               type : 'post',
               success :function(){
                   
               }
           });
           
        }
    </script>