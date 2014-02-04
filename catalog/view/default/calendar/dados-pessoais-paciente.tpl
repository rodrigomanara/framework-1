<?php
$dividir = false;
foreach ($dados as $key => $dado) {
    ?> 
    <div>
        <h3>
            <?php
            if (preg_match("/^ppc_/", $key)) {
                if ($dividir === false) {
                    ?>
                    Primeira Pessoa para Contato </h3></div> 
            <hr/>
            <div> <h4>
                    <?php
                    $dividir = true;
                }


                $name = explode("_", $key);

                $str = '';

                foreach ($name as $key => $value) {
                    if ($key === 0)
                        continue;
                    $str .= ucfirst($value) . " ";
                }

                echo $str;
            }elseif(preg_match("/^Listfile/", $key) or preg_match("/^dmc_/", $key)){ 
            
            }else {
                    
               echo ucfirst(str_replace("_", " ", $key));
            }
            ?></h4>
        <span><?php echo!empty($dado) ? $dado : "-----"; ?></span>
    </div>
<?php } ?>