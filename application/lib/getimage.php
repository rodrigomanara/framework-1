<?php

final class getimage {

    //put your code here
    public function icon($data , $width , $height) {

        $array = array('.gif', '.jpg', '.jpge', '.png', '.gif');

        foreach ($array as $ext) {
            $file =  './images/' . $data . $ext;
            
            if (is_file($file)) {
                ob_start();
                echo '<img src="'.$file.'" width="'.$width.'" height="'.$height.'"/>';
                $return  = ob_get_contents();
                ob_clean();
            }
        }
        return isset($return) ? $return : null;
    }

}

?>
