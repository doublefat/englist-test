<?php

$currentDir = dirname(__FILE__);
include_once realpath($currentDir . '/../system') . '/dbfunction.php';
include_once realpath($currentDir . '/../system') . '/log.php';
include_once realpath($currentDir . '/../db') . '/Questions.php';

class exame_one_by_oneController extends BasicController
{

    var $maxQuestion = 5;
    var $remainQuestion = 30;
    var $current_level = 1;
    var $current_Qcnt = 0;
    
    public function pre_filter(&$methodName = null)
    {
        parent::pre_filter($methodName);

        $this->view->addInternalJs("jquery-1.7.1.min.js");
        $this->view->addInternalJs("jquery-ui-1.8.17.custom.min.js");
        $this->view->addInternalCss("ui-lightness/jquery-ui-1.8.17.custom.css");

    }

    var $levelWords = array(1 => "Easy", 2 => "Medium", 3 => "Difficult");

    private function one_random_question () {
        // please refer app/controllers/test.php
        $dbh = connectPDO();
        //load easy question
        $qo = new Questions();
        $total = $qo->countByLevel($dbh, 1);

        // Request for an easy question and the coresponding options
        $qs_1 = $qo->getByLevelWithoutUsedIds($dbh, 1, 1, array(0));    // 1 questions, level 1 (easy)
        $data = $qo->loadFullQuestionsWithOptions($dbh, $qs_1);
        $sel_question =array_values ($data) [0];

        $this->prepareQuestion( $sel_question );
        
        dumpHtmlReadable($sel_question);            // Testing....
        $this->set('question', $sel_question);            // Send data to html
        echo '<hr/>';
    }


    var $optionIndexLetters = array("A", "B", "C", "D", "E", "F", "G", "H", "I");
    var $question_cnter = 1;

    private function prepareQuestion(&$questionDetail)
    {
        $questionDetail["question"]["level_word"] = $this->levelWords[$questionDetail["question"]['level']];
        $questionDetail["question"]["status_word"] = $this->statusWords[$questionDetail["question"]['disable']];
        $questionDetail["question"]["q_cnt"] = $_SESSION["student"]["question_counter"];

        $i = 0;
        if (!empty ($questionDetail ["options"])) {
            foreach ($questionDetail["options"] as &$oneOption) {
                $oneOption['index'] = $this->optionIndexLetters [$i];
                $i++;
                if (!empty ($oneOption ['is_right'])) {
                    $oneOption ['is_right_class'] = "is_right";
                } else {
                    $oneOption ['is_right_class'] = "is_not_right";
                }
            }
        }
    }

    var $exame_time_second=1*60; // 30 minutes;

    public function index()
    {
        if (empty($_SESSION["student"])) {
            $_SESSION["student"] = array("id" => 5, "question_counter" => 0,"start_time"=>time());

        }

        $now=time();
        $remaining= ($_SESSION["student"]['start_time'] + $this->exame_time_second)-$now;


        $this->set("remaining_time",$remaining);
    }

    public function one_question()
    {
        if (empty($_SESSION["student"]["current_question"])) {
            //load one question from DB
            $_SESSION["student"]["question_counter"]++;
            $_SESSION["student"]["current_question"] = array("test" => "test" . $_SESSION["student"]["question_counter"], "question_id" => rand());

        }
        echo "From one_question :";
        dumpHtmlReadable($_SESSION["student"]["question_counter"]);
        dumpHtmlReadable($_SESSION["student"]["current_question"]);
        $this->one_random_question ();
//        $this->set("question", $_SESSION["student"]["current_question"]);
        $this->setLayout("ajax.phtml");

    }


    public function reset()
    {

        //unset student
        unset($_SESSION["student"]);
        $this->redirect("/exame_one_by_one/");
    }

    public function finish()
    {
        dumpHtmlReadable($_SESSION["student"]["answers"]);


    }

    public function submit()
    {

        MLog::iExport($_POST);
        MLog::i("Question id:" . $_POST['question_id']);

        if(empty($_SESSION["student"]["answers"])){
            $_SESSION["student"]["answers"]=array();
        }

        $_SESSION["student"]["answers"][$_POST['question_id']]=array("demo"=>$_POST);



        if (intval($_SESSION["student"]["question_counter"]) < $this->maxQuestion && $_POST[time_out_flag]!=1) {
            echo "next";
        } else {
            echo "finish";
        }

        //unset current question
        unset($_SESSION["student"]["current_question"]);
        $this->setLayout("ajax.phtml");
        $this->view->setTemplate("exame_one_by_one/blank.phtml");
    }


}

?>
