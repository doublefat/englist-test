<?php
$currentDir = dirname(__FILE__);
include_once realpath($currentDir . '/../system') . '/dbfunction.php';
include_once realpath($currentDir . '/../db') . '/Questions.php';
class TestController extends BasicController
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




    }



    public function randomPickupQuestionByType()

    {
        $dbh = connectPDO();

        if (!empty($_REQUEST["type"])) {
            $type = intval($_REQUEST["type"]);
        } else {
            $type = 1;
        }

        if (!empty($_REQUEST["size"])) {
            $size = intval($_REQUEST["size"]);
        } else {
            $size = 5;
        }

        $qo = new Questions();

        $total=$qo->countByLevel($dbh,$type);

        dumpHtmlReadable($total);

        echo "<hr/>";
        $qs=$qo->getByLevelWithoutUsedIds($dbh,$size,$type,array(0));



        dumpHtmlReadable($qs);
        echo "<hr/>";
        $qsWithOptions=$qo->loadFullQuestionsWithOptions($dbh,$qs);

        dumpHtmlReadable($qsWithOptions);
        echo "<hr/>";
        $this->view->setTemplate("test/blank.phtml");

    }
}

?>