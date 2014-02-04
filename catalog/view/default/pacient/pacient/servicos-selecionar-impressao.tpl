<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <meta name="robots" content="noindex">
            <meta http-equiv="X-UA-Compatible" content='IE=edge,chrome=1'/>
            <base href="<?php echo $server; ?>" />
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Rody-RH ::  Seja Bem Vindo</title>
            <link href="./catalog/view/default/CSS/style.css" rel=stylesheet />
            <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
            <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
            <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
            <script type="text/javascript" src="./catalog/view/default/JS/js-default.js"></script>


            <style>
                .roda-pe{position: absolute; bottom: 50px ;  width: 100%; text-align: center; border-top: 1px solid #ff3333;}
                .roda-pe{font-family: verdana; font-size: 10pt; color: #2b81af;}
                .table{top: 30%; position: absolute;}
                table{width: 100%; font-size: 10px;}
                table tr{ padding: 2px;}
                table thead th { border:  1px solid #000;}
                table td{border-bottom:  1px solid #000; text-align: right; padding-right: 5px;}
            </style>
    </head>
    <body> 

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $func = new functions();
            $returno = $func->ordanizadorArray($_POST, 'print', 'print_');
            
             
            
            $totalpago = 0;
            $subTotalGasto = 0;
            $TotalGasto = 0;
            $TotalQuantidade = 0;
            ?> 
            <img src="<?php echo $img; ?>messina-clinic.jpg"/>
            <script>
                window.print();
            </script>
            <table>
                <tr>
                    <td><?php echo $pessoal['nome']; ?></td>
                </tr>
            </table>
            <table class="table"> 
                <thead>
                    <th>Servico Serviço / ou Produto</th>
                    <th>Data</th>
                    <th>Valor</th>
                    <th>Total Pago</th>
                    <th>quantidade</th>
                </thead> 
                <?php  
              
                foreach ( $returno['print'] as $dado) {
                    
                    if (isset($dado['id_print'])) {
                        $cal = 0;
                        ?>
                        <tr>    
                            <tbody>
                                <td><?php echo $dado['servico']; ?></td>
                                <td><?php echo date('d-m-Y h:m', strtotime($dado['data'])); ?> </td>
                                <td><?php echo number_format((double) $dado['value'], 2, '.', ''); ?> </td>

                                <td><?php echo number_format((double) $dado['totalpago'], 2, '.', ''); ?> </td>
                                <td><?php echo $dado['quantidade']; ?> </td>

                            </tbody>
                        </tr>
                        <?php
                        $totalpago += $dado['totalpago'];
                        $subTotalGasto += $dado['value'];
                        $TotalGasto += $dado['value'] - $totalpago;
                        $TotalQuantidade += $dado['quantidade'];
                    }
                }
                    ?>
                    <tbody>
                        <tr>
                            <td colspan="4" style="text-align: right;"> <b>Total de Produtos/ Serviços</b></td>
                            <td><?php echo $TotalQuantidade; ?> </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <table style="float: right;">
                                    <tr>
                                        <td><b>total Pago</b></td>
                                        <td><?php echo number_format((double) $totalpago, 2, '.', ''); ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Subtotal</b></td>
                                        <td><?php echo number_format((double) $subTotalGasto, 2, '.', ''); ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Valor Total Devedor </b></td>
                                        <td><?php echo number_format((double) $TotalGasto, 2, '.', ''); ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="roda-pe">
                    14-16 Dowgate Hill, London, EC4R 2SU <br/>
                    Telefone :020 7372 2497 / 0794 198 4478<br/>
                    Visite nosso site: www.messinaclinic.co.uk <br/>
                    Ou entre em contato pelo email:
                    info@messinaclinic.co.uk
                </div>
                <?php
                exit();
            }
            ?>

            <form name="form" method="post">
                <table>
                    <tr>
                        <thead>
                            <th></th>
                            <th>Servico Serviço / ou Produto</th>
                            <th>Valor</th>
                            <th>Metodo de Pagamento</th>
                            <th>Total Pago</th>
                            <th>quantidade</th>
                            <th>Data</th>
                        </thead>
                    </tr>

    <?php
    $i = 0;
    foreach ($dados as $dado) {
        ?>
                        <input name="print_[servico][]" value="<?php echo $dado['servico']; ?>" type="hidden"/>
                        <input name="print_[value][]" value="<?php echo $dado['value']; ?>" type="hidden"/>
                        <input name="print_[metodo][]" value="<?php echo $dado['metodo']; ?>" type="hidden"/>
                        <input name="print_[totalpago][]" value="<?php echo $dado['totalpago']; ?>" type="hidden"/>
                        <input name="print_[quantidade][]" value="<?php echo $dado['quantidade']; ?>" type="hidden"/>
                        <input name="print_[data][]" value="<?php echo $dado['data']; ?>" type="hidden"/>
                        <tr>    
                            <tbody>
                                <td><input name="print_[id_print][]" type="checkbox" value="<?php echo $i; ?>"/> </td>
                                <td><?php echo $dado['servico']; ?> </td>
                                <td><?php echo $dado['value']; ?> </td>
                                <td><?php echo $dado['metodo']; ?> </td>
                                <td><?php echo $dado['totalpago']; ?> </td>
                                <td><?php echo $dado['quantidade']; ?> </td>
                                <td><?php echo $dado['data']; ?> </td>
                            </tbody>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                <tr>
                    <td colspan="7"> <input name="" type="submit"></td>
                </tr>
            </table>
        </form>
    </body></html>