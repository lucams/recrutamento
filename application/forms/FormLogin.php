<?php

class Application_Form_FormLogin extends Zend_Form
{

    public function init()
    {
       $username = $this->addElement('text', 'login', array(
            'filter' => array('StringTrim', 'StringToLower'),
            'validators' => array(
                'Alpha',
                array('StringLength', false, array(3, 15)),),
                'required' => true,
                'label' => 'Usuário:',
           'attribs'=>array('class'=>'field')));
        
        $password = $this->addElement('password', 'senha', array(
            'filter' => array('StringTrim'),
            'validators' => array(
                'Alnum',
                array('StringLength', false, array(3, 15)),),
                'required' => true,
                'label' => 'Senha:',
            'attribs'=>array('class'=>'field')));
        
        $botao = $this->addElement('submit','entrar',
                array('label'=>'Entrar'),array(
                    'attribs'=>array('class'=>'button')
                ));
        
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag',array('tag'=>'dl','class'=>'login')),
            array('Description',array('placement'=>'prepend')),
            'Form'
        ));
    }


}

