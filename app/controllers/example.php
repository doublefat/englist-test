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

    public function combine_array(){
        $a1=array("a","b","c");
        $a2=array("e","f","g");

        $newArray=array();

        foreach ($a1 as $one){
            $newArray[]=$one;
        }
        foreach ($a2 as $one){
            $newArray[]=$one;
        }


        dumpHtmlReadable($newArray);


        $newArray=array();

        //using index to visit the element in array
        for($i=0;$i <count($a1);$i++){
            $newArray[$a1[$i]]=$a2[$i];
        }
        dumpHtmlReadable($newArray);


        //demo php copy in using .
        foreach ($newArray as $key=> $item) {
            $item="abbcd";
        }
        dumpHtmlReadable($newArray);

        //demo reference
        foreach ($newArray as $key=> &$item) {
            $item="abbcd";
        }
        dumpHtmlReadable($newArray);



        $this->view->setTemplate("test/blank.phtml");
    }
}

?>