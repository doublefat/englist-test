<?php

class ExampleController extends BasicController
{


    public function pre_filter(&$methodName = null)
    {
        parent::pre_filter($methodName);

        $this->view->addInternalJs("jquery-1.7.1.min.js");
        $this->view->addInternalJs("jquery-ui-1.8.17.custom.min.js");
        $this->view->addInternalCss("ui-lightness/jquery-ui-1.8.17.custom.css");


    }

    public function index()
    {


        $this->set('exa1', 'hello');
        $this->set('final_score', 500);
        $this->view->exa2 = array('world', ' .');
        error_log("my error log:"."string concat by .");

    }

    public function ajax()
    {
        $this->setLayout("ajax.phtml");
        $this->set("exa3", "Hello World, ajax");
    }

    public function phpinfo()
    {

    }
}

?>