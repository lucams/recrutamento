<?php

class Application_Model_PessoaMapper {

    private $model;
    private $dbTable;

    function __construct(array $dados = null) {
        $this->model = new Application_Model_Pessoa($dados);
    }

    function getDbTable() {
        if (null === $this->dbTable) {
            $this->dbTable = new Application_Model_DbTable_Pessoa();
        }
        return $this->dbTable;
    }

    function inserir() {
        $this->getDbTable()->insert($this->model->toArray());
    }

    function listar() {
        $resultado = $this->getDbTable()->fetchAll('ATIVO=1');
        $registros = array();

        foreach ($resultado as $linha) {
            $obj = new Application_Model_Pessoa($linha->toArray());
            $registros[] = $obj;
        }
        return $registros;
    }

    public function excluir($id) {
        settype($id, 'Integer');
        $tabela = $this->getDbTable();
        $where = $tabela->getAdapter()->quoteInto('ID_PESSOA = ?', $id);
        //Física
        // $tabela->delete($where);
        //Lógica

        $tabela->update(array('ATIVO' => '0'), $where);
    }

    public function buscar($id, $model) {
        settype($id, 'Integer');
        $tabela = $this->getDbTable();
        //metodo 1
        // $where = $tabela->getAdapter()->quoteInto('ID_PESSOA = ?', $id);
        // $dados = $tabela->fetch($where);
        //
        //método 2
        $dados = $tabela->find($id);
        $dados = $dados->current();
        //
        $model->setOptions($dados->toArray());
        return $model;
    }

    public function atualizar($dados) {
        $id = $dados['id_pessoa'];
        settype($id, 'Integer');
        $tabela = $this->getDbTable();
        $where = $tabela->getAdapter()->quoteInto('ID_PESSOA = ?', $id);
        $tabela->update($dados, $where);
    }

}

