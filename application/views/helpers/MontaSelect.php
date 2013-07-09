<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Application_View_Helper_MontaSelect
 *
 * @author lucams
 */
class Application_View_Helper_MontaSelect extends Zend_View_Helper_Abstract  {
   
    static public function getElemento($classe,$campo,$descricao){
        $mapper = new $classe;
        $dados = $mapper->listar();
        $elemento = new Zend_Form_Element_Select('cod_'.$campo);
        $nomecampo = 'id_'. $campo;
        $elemento->setLabel(ucfirst($campo).':')
                ->setAttrib('class', 'field ');
        $elemento->addMultiOption('','Selecione um a opção...');
        
        foreach ($dados as $obj) {
            $elemento->addMultiOption($obj->$nomecampo,$obj->$descricao);
        }
        return $elemento;
    }
}

?>
