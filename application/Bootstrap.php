<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initView() {
        $view = new Zend_View();
        $view->CssPath = '/css';
        $view->JsPath = '/js';
        $view->headLink()->appendStylesheet($view->CssPath . '/style.css', 'screen');
        $view->addHelperPath('ZendX/JQuery/View/Helper', 'ZendX_JQuery_View_Helper');
        $view->jQuery()
                ->setLocalPath($view->JsPath . '/jquery-1.6.2.min.js')
                ->setUiLocalPath($view->JsPath . '/jquery-ui-1.8.16.custom.min.js')
                ->addStylesheet($view->CssPath . '/jquery-ui-1.8.16.custom.css')
                ->addJavascriptFile($view->JsPath . '/jquery.ui.datepicker-pt-BR.js');
        
        $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
        $viewRenderer->setView($view);
        
        
        
        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
        return;
    }

}

