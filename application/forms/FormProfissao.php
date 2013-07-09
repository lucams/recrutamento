<?php

class Application_Form_FormProfissao extends Zend_Form
{

    public function init()
    {
        $this->setAction('inserir')
                ->setMethod('post')
                ->setAttrib('class', 'form');


        $id = new Zend_Form_Element_Hidden('id_profissao');

        $desc = new Zend_Form_Element_Text('descricao');
        $desc->setLabel('Descrição:')
                ->setRequired()
                ->setAllowEmpty(false)
                ->setAttrib('class', 'field size1');
        
        $ativo = new Zend_Form_Element_Checkbox('ativo');
        $ativo->setLabel('Ativo:')
                ->setValue('1');

        $salvar = new Zend_Form_Element_Submit('Salvar');
        $salvar->setAttrib('class', 'button');
        
 
        $this->addElements(array($id, $desc, $ativo, $salvar));
    }


}

