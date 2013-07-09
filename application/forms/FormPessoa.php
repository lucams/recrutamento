<?php

class Application_Form_FormPessoa extends Zend_Form {

    public function init() {

        $this->setAction('inserir')
                ->setMethod('post')
                ->setAttrib('class', 'form');

        //Validadores
        $val1 = new Zend_Validate_Date(array('format' => 'dd/MM/yyyy'));
        $val1->setMessage('Data inválida!');


        $val2 = new Zend_Validate_Digits();
        $val2->setMessage('Digite somente números!');

        $val3 = new Zend_Validate_Regex('(^\d{3}\.?\d{3}\.?\d{3}\-?\d{2}$)');
        $val3->setMessage('Cpf inválido!');


        //Filtros

        $filtro1 = new Zend_Filter_StringTrim();


        $id = new Zend_Form_Element_Hidden('id_pessoa');

        $nome = new Zend_Form_Element_Text('nome');
        $nome->setLabel('Nome:')
                ->setRequired()
                ->addFilter($filtro1)
                ->setAllowEmpty(false)
                ->setAttrib('class', 'field size1');

        $cpf = new Zend_Form_Element_Text('cpf');
        $cpf->setLabel('Cpf:')
                ->addValidators(array($val3))
                ->setAttrib('class', 'field size3');


//        $datanasc = new Zend_Form_Element_Text('datanasc');
//        $datanasc->setLabel('DataNasc:')
//                ->addValidator($val1)
//                ->setAttrib('class', 'field size3');

        $datanasc = new ZendX_JQuery_Form_Element_DatePicker('datanasc');
        $datanasc->setLabel('Data Nasc.:')
                ->setJQueryParam('dateFormat', 'dd/mm/yy')
                ->setJQueryParam('changeYear', 'true')
                ->setJqueryParam('changeMonth', 'true')
                ->setJqueryParam('regional', 'pt')
                ->setJqueryParam('yearRange', "1930:2011")
                ->setDescription('dd/mm/yyyy')
                ->addValidator(new Zend_Validate_Date(
                                array(
                                    'format' => 'dd/mm/yyyy',
                        )))
                ->setRequired(true);


        $ativo = new Zend_Form_Element_Checkbox('ativo');
        $ativo->setLabel('Ativo:')
                ->setValue('1');

        $salvar = new Zend_Form_Element_Submit('Salvar');
        $salvar->setAttrib('class', 'button');


        $this->addElements(array($id, $nome, $cpf, $datanasc, $ativo, $salvar));
    }

}

