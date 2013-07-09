<?php

class Application_Model_VagaMapper
{
private $model;
    private $dbTable;

    function __construct(array $dados=null) {
        $this->setDados($dados);
    }

    function setDados(array $dados=null){
        $this->model = new Application_Model_Vaga($dados);
    }
    
    function getDbTable() {
        if (null === $this->dbTable) {
            $this->dbTable = new Application_Model_DbTable_Vaga();
        }
        return $this->dbTable;
    }

    function inserir() {
        $this->getDbTable()->insert($this->model->toArray());
    }

    function listar() {
        $resultado = $this->getDbTable()->fetchAll('ativo=1');
        $registros = array();

        foreach ($resultado as $linha) {
            $obj = new Application_Model_Vaga($linha->toArray());
            $registros[] = $obj;
        }
        return $registros;
    }
     public function excluir($id) {
        settype($id, 'Integer');
        $tabela = $this->getDbTable();
        $where = $tabela->getAdapter()->quoteInto('id_vaga = ?', $id);
        //Física
       // $tabela->delete($where);
        //Lógica
        
        $tabela->update(array('ativo'=>'0'),$where);
        
    }
    
    public function buscar($id, $model) {
        settype($id, 'Integer');
        $tabela = $this->getDbTable();
        $dados = $tabela->find($id);
        $dados = $dados->current();
        //
        $model->setOptions($dados->toArray());
        return $model;
    }
    
    public function atualizar($dados) {
        $id = $dados['id_vaga'];
        settype($id, 'Integer');
        $tabela = $this->getDbTable();
        $where = $tabela->getAdapter()->quoteInto('id_vaga = ?', $id);
        $tabela->update($dados, $where);
    }

}

