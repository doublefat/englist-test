<?php

include_once realpath(dirname(__FILE__)) . '/shared/auth.php';
include_once realpath($currentDir . '/../db') . '/Teacher.php';
//class Teacher_mngController extends AuthRequiredController {
class Teacher_mngController extends HtmlController {

    public function pre_filter(&$methodName = null) {
        parent::pre_filter($methodName);

        $this->view->addInternalJs("jquery-1.7.1.min.js");
        $this->view->addInternalJs("jquery-ui-1.8.17.custom.min.js");
        $this->view->addInternalCss("ui-lightness/jquery-ui-1.8.17.custom.css");



        return true;
    }

    public function index() {

        $teacherDb=new Teacher();
        $allTeachers=$teacherDb->listAll($this->dbh);
        echo md5("123456");
        dumpHtmlReadable($allTeachers);
    }

    public function new_one(){

    }



}

?>