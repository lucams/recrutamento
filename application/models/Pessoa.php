<?php

class Application_Model_Pessoa {

    private $id_pessoa;
    private $nome;
    private $cpf;
    private $datanasc;
    private $ativo;

    public function __construct(array $options = null) {
        if (!is_null($options)) {
            $this->setOptions($options);
        }
    }

    public function __get($name) {
        if (!property_exists($this, $name)) {
            throw new Exception('Propriedade inválida:' . $name);
        }
        return $this->$name;
    }

    public function __set($name, $value) {
        $name= strtolower($name);
        if (property_exists($this, $name)) {
            
            if(strstr($name,'data')){
                $value= Application_View_Helper_ConverteData::converte($value);
            }
            
            $this->$name = $value;
        }
        return $this;
    }

    public function setOptions(array $options) {
        foreach ($options as $key => $value) {
            $this->__set($key, $value);
        }
        return $this;
    }

    public function toArray() {
        return get_object_vars($this);
    }

}

