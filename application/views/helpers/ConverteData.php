<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConverteData
 *
 * @author lucams
 */
class Application_View_Helper_ConverteData extends Zend_View_Helper_Abstract {

    static public function converte($data) {
        if (strstr($data, '/')) {
            list($d, $m, $a) = explode('/', $data);
            return "$a-$m-$d";
        } else {
            list($a, $m, $d) = explode('-', $data);
            return "$d/$m/$a";
        }
    }

}

?>
