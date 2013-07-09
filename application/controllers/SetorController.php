<?php

class SetorController extends Zend_Controller_Action
{

    protected $form;
    protected $mapper;
    protected $model;
    
    
    public function init() {
        $this->_auth = Zend_Auth::getInstance();
        
    }

    public function preDispatch() {
        if (is_null($this->_auth) || !$this->_auth->hasIdentity()) {
            $this->_redirect('/autenticacao/');
        }
        $this->form = new Application_Form_FormSetor();
        $this->mapper = new Application_Model_SetorMapper();
        $this->model = new Application_Model_Setor();
        $this->view->pagina = 'pessoa';
    }
    
    public function indexAction()
    {
        $this->_helper->redirector('listar');
    }

    public function inserirAction()
    {
       
        $request = $this->getRequest();
        if ($request->isPost()) {

            if ($this->form->isValid($request->getPost())) {
                $this->mapper->setDados($request->getPost());
                $this->mapper->inserir();
                unset($this->view->form);
                 $this->_helper->redirector('listar');
            }
        }
        $this->view->form = $this->form;
    }

    public function listarAction()
    {
        $this->view->titulo = 'Listagem de Setores';
        //Paginação 
        $request = $this->getRequest();
        //Busca o numero da página corrente
        $pagina = $request->getParam('p');
        if (is_null($pagina))
            $pagina = 1;
        //Popula o paginator com os dados do select 
        $paginator = Zend_Paginator::factory($this->mapper->listar());
        //Seta a página corrente
        $paginator->setCurrentPageNumber($pagina);
        // Seta a quantidade de registros por página
        $paginator->setItemCountPerPage(3);
        // numero de paginas que serão exibidas
        $paginator->setPageRange(5);
        //devolve o paginator
        $this->view->lista = $paginator;
    }

    public function excluirAction()
    {
        $request = $this->getRequest();
        $id = $request->getParam('id');
        $this->mapper->excluir($id);
        $this->_helper->redirector('listar');
    }

    public function atualizarAction()
    {
       
        $this->form->setAction('atualizar');
        $request = $this->getRequest();
        //Primeira etapa buscar
        if ($request->isGet()) {
            $id = $request->getParam('id');
            $this->model = $this->mapper->buscar($id, $this->model);
            $this->form->populate($this->model->toArray());
            $this->view->form = $this->form;
        } else if ($request->isPost()) {
            //Segunda etapa atualização 
            if (!$this->form->isValid($request->getPost())) {
                $this->view->form = $this->form;
            } else {
                $modelNovo = new Application_Model_Setor($this->form->getValues());
                $this->mapper->atualizar($modelNovo->toArray());
                 $this->_helper->redirector('listar');
            }
        }
    }


}









