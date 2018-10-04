<?php

include_once __PROJECT_ROOT__ . '/system/dbfunction.php';

class HtmlController extends BasicController {

    var $dbh;
    public function pre_filter(&$methodName = null) {


        if (parent::pre_filter($methodName) === false) {
            return false;
        }

        header('Content-Type:text/html; charset=utf-8');
        $this->view->addInternalJs("jquery-1.7.1.min.js");
        $this->view->addInternalJs("jquery-ui-1.8.17.custom.min.js");
        $this->view->addInternalCss("ui-lightness/jquery-ui-1.8.17.custom.css");
        $this->dbh = connectPDO();
        return true;
    }

}

?>