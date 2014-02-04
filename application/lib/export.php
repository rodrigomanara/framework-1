<?php

final class export {

    function cleanData(&$str) {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        return (strstr($str, '"')) ? $str = '"' . str_replace('"', '""', $str) . '"' : "";
    }

    function excel($data = array()) {
        $file = date('dmy');
        $filename = md5($file) . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");


        $i = 0;


        $tb = "<table>";
        $tb .= "<thead >";
        foreach ($data as $datas) {
            $headecount = count(array_keys($datas));
            foreach ($datas as $key => $value) {
                if ($i < $headecount) {
                    $i++;
                    $tb .= "<td style='background:blue;color:white'>" . $key . "</td>";
                }
            }
        }
        $tb .= "</thead>";
        
        foreach ($data as $datas) {
            $tb .= "<tr>";
            foreach ($datas as $key => $value) {
                $tb .= "<td style='border:1px solid black;'>" . $value . "</td>";
            }
            $tb .= "</tr>";
        }
        $tb.= "</table>";

        echo $tb;
    }

}
?>
