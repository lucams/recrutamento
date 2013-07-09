<?php

class Application_Model_ProfissaoMapper
{
    private $model;
    private $dbTable;

    function __construct(array $dados=null) {
        $this->model = new Application_Model_Profissao($dados);
    }

    function getDbTable() {
        if (null === $this->dbTable) {
            $this->dbTable = new Application_Model_DbTable_Profissao();
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
            $obj = new Application_Model_Profissao($linha->toArray());
            $registros[] = $obj;
        }
        return $registros;
    }
     public function excluir($id) {
        settype($id, 'Integer');
        $tabela = $this->getDbTable();
        $where = $tabela->getAdapter()->quoteInto('id_profissao = ?', $id);
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
        $id = $dados['id_profissao'];
        settype($id, 'Integer');
        $tabela = $this->getDbTable();
        $where = $tabela->getAdapter()->quoteInto('id_profissao = ?', $id);
        $tabela->update($dados, $where);
    }

}

