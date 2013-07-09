<?php

class AutenticacaoController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $this->view->form = new Application_Form_FormLogin(
                        array('action' => '/autenticacao/process',
                            'method' => 'post'));
    }

    public function processAction() {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_redirect('/autenticacao/');
        }

        $form = new Application_Form_FormLogin(
                        array('action' => '/autenticacao/process',
                            'method' => 'post'));

        if (!$form->isValid($request->getPost())) {
            $this->view->form = $form;
            return $this->render('index');
        }

        $adapter = $this->getAuthAdapter($form->getValues());
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);

        if (!$result->isValid()) {
            $form->setDescription('Usuário ou senha inválida!');
            $this->view->form = $form;
            return $this->render('index');
        }

        $this->_redirect('/pessoa/');
    }

    public function getAuthAdapter(array $params) {
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);

        $authAdapter->setTableName('USUARIO')
                ->setIdentityColumn('USUARIO')
                ->setCredentialColumn('SENHA');


        $authAdapter->setIdentity($params['login'])
                ->setCredential($params['senha']);
        return $authAdapter;
    }

    public function logoutAction() {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect('/autenticacao/');
    }

}

