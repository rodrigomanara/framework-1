<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of randon
 *
 * @author rodrigo
 */
final class randon {

    //put your code here
    public function image($random) {

        //$_path = __root . "images/randon/pic.png";
        $im = imagecreatetruecolor(150, 30);
        $white = imagecolorallocate($im, 255, 255, 255);
        $grey = imagecolorallocate($im, 128, 128, 128);
        $black = imagecolorallocate($im, 0, 0, 0);
        imagefilledrectangle($im, 0, 0, 399, 29, $white);
        $text = $random;
        $font = __root . 'fontes/AeroviasBrasilNF.ttf';

        imagettftext($im, 20, 0, 11, 21, $grey, $font, $text);
        imagettftext($im, 20, 0, 10, 20, $black, $font, $text);
        
        ob_start();
        imagepng($im);
        $contents =  ob_get_contents();
        ob_end_clean();
        $image  = base64_encode($contents);
        imagedestroy($im);
        
        $text = "data:image/png;base64,$image";
        
        
        return $text;
    }
    public function randon() {
        $date = date('dm');
        $number = rand(999999999, $date);
        return $number;
    }

}

?>
