<?php

class Application_Form_FormVaga extends Zend_Form
{

    public function init()
    {
         $this->setAction('inserir')
                ->setMethod('post')
                ->setAttrib('class', 'form');


        $id = new Zend_Form_Element_Hidden('id_vaga');

        $desc = new Zend_Form_Element_Text('descricao');
        $desc->setLabel('Descrição:')
                ->setRequired()
                ->setAllowEmpty(false)
                ->setAttrib('class', 'field size1');
        
        $dataini = new Zend_Form_Element_Text('datainicio');
        $dataini->setLabel('Data Inicial:')
                ->setAttrib('class', 'field size3');
        
        $datafim = new Zend_Form_Element_Text('datafim');
        $datafim->setLabel('Data Final:')
                ->setAttrib('class', 'field size3');
        $salario = new Zend_Form_Element_Text('salario');
        $salario->setLabel('Salario:')
                ->setAttrib('class', 'field size3');
        

        
        $situacao = new Zend_Form_Element_Select('situacao');
        $situacao->setLabel('Situação:')
                ->setAttrib('class', 'field ')
                ->addMultiOptions(
                        array(''=>'Selecione a situação...',
                            'A'=>'Aberto',
                            'E'=>'Em Seleção',
                            'C'=>'Cancelado',
                            'F'=>'Fechado'));
        
        
        $setor = Application_View_Helper_MontaSelect::getElemento('Application_Model_SetorMapper', 'setor', 'descricao');
        $profissao = Application_View_Helper_MontaSelect::getElemento('Application_Model_ProfissaoMapper', 'profissao', 'descricao');
        
        
        
        
        $ativo = new Zend_Form_Element_Checkbox('ativo');
        $ativo->setLabel('Ativo:')
                ->setValue('1');

        $salvar = new Zend_Form_Element_Submit('Salvar');
        $salvar->setAttrib('class', 'button');
        
 
        $this->addElements(array($id, $desc, $dataini,$datafim,$salario,$setor,$profissao,$situacao, $ativo, $salvar));
    }


}

