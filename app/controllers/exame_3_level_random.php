<?php

class exame_3_level_randomController extends BasicController
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

        // please refer app/controllers/test.php

        //load easy question
        $easy=Array(); //TODO

        // load medium
        $medium=Array(); //TODO

        // load Hard
        $hard=Array();// TODO

        // Put three array into one array

        $finalArray=Array(
            Array('id'=>'abc','title'=>'t1'),

            Array('id'=>'eeed','title'=>'t2')
        );//TODO , this fake code to demo the records in array

        // Set final array to view Variable

        $this->set("all_questions",$finalArray);


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