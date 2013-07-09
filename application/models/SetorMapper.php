<?php

class Application_Model_SetorMapper {

    private $model;
    private $dbTable;

    function __construct(array $dados=null) {
        $this->setDados($dados);
    }

    function setDados(array $dados=null){
        $this->model = new Application_Model_Setor($dados);
    }
    
    function getDbTable() {
        if (null === $this->dbTable) {
            $this->dbTable = new Application_Model_DbTable_Setor();
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
            $obj = new Application_Model_Setor($linha->toArray());
            $registros[] = $obj;
        }
        return $registros;
    }
     public function excluir($id) {
        settype($id, 'Integer');
        $tabela = $this->getDbTable();
        $where = $tabela->getAdapter()->quoteInto('id_setor = ?', $id);
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
        $id = $dados['id_setor'];
        settype($id, 'Integer');
        $tabela = $this->getDbTable();
        $where = $tabela->getAdapter()->quoteInto('id_setor = ?', $id);
        $tabela->update($dados, $where);
    }
    
}

