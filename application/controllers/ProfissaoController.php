<?php

class ProfissaoController extends Zend_Controller_Action
{

    public function init() {
        $this->_auth = Zend_Auth::getInstance();
        
    }

    public function preDispatch() {
        if (is_null($this->_auth) || !$this->_auth->hasIdentity()) {
             $this->_redirect('/autenticacao/');
        }
        $this->view->pagina = 'profissao';
    }

    public function indexAction()
    {
        // action body
    }

    public function listarAction()
    {
        $this->view->titulo = 'Listagem de Profissões';
        $mapper = new Application_Model_ProfissaoMapper();
        //Paginação 
        $request = $this->getRequest();
        //Busca o numero da página corrente
        $pagina = $request->getParam('p');
        if (is_null($pagina))
            $pagina = 1;
        //Popula o paginator com os dados do select 
        $paginator = Zend_Paginator::factory($mapper->listar());
        //Seta a página corrente
        $paginator->setCurrentPageNumber($pagina);
        // Seta a quantidade de registros por página
        $paginator->setItemCountPerPage(3);
        // numero de paginas que serão exibidas
        $paginator->setPageRange(5);
        //devolve o paginator
        $this->view->lista = $paginator;
    }

    public function inserirAction()
    {
        $form = new Application_Form_FormProfissao();
        $request = $this->getRequest();
        if ($request->isPost()) {

            if ($form->isValid($request->getPost())) {
                $mapper = new Application_Model_ProfissaoMapper($request->getPost());
                $mapper->inserir();
                unset($this->view->form);
                $this->_redirect('/profissao/listar');
            }
        }
        $this->view->form = $form;
    }

    public function excluirAction()
    {
        $mapper = new Application_Model_ProfissaoMapper();
        $request = $this->getRequest();
        $id = $request->getParam('id');
        $mapper->excluir($id);
        $this->_redirect('/profissao/listar');
    }

    public function atualizarAction()
    {
        $form = new Application_Form_FormProfissao();
        $form->setAction('atualizar');
        $model = new Application_Model_Profissao();
        $mapper = new Application_Model_ProfissaoMapper();
        $request = $this->getRequest();
        //Primeira etapa buscar
        if ($request->isGet()) {
            $id = $request->getParam('id');
            $model = $mapper->buscar($id, $model);
            $form->populate($model->toArray());
            $this->view->form = $form;
        } else if ($request->isPost()) {
            //Segunda etapa atualização 
            if (!$form->isValid($request->getPost())) {
                $this->view->form = $form;
            } else {
                $modelNovo = new Application_Model_Profissao($form->getValues());
                $mapper->atualizar($modelNovo->toArray());
                $this->_redirect('/profissao/listar');
            }
        }
    }


}









