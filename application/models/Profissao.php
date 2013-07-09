<?php

class Application_Model_Profissao
{
    private $id_profissao;
    private $descricao;
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
        $name = strtolower($name);
        if (property_exists($this, $name)) {
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

