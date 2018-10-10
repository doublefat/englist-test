<?php

$currentDir = dirname(__FILE__);
include_once realpath($currentDir . '/../system') . '/dbfunction.php';
include_once realpath($currentDir . '/../system') . '/log.php';
include_once realpath($currentDir . '/../db') . '/Questions.php';

class exame_one_by_oneController extends BasicController
{

    var $maxQuestion = 30;
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
    var $levelScore = array( 'easy' => 2, 'medium' => 3, 'diff' => 5 );

    private function one_random_question()
    {
        // please refer app/controllers/test.php
        $dbh = connectPDO();
        //load easy question
        $qo = new Questions();
        $total = $qo->countByLevel($dbh, 1);

        // Request for a question and the coresponding options

        $level=-1;
        if($_SESSION["student"]["current_level"]=="easy"){
            $level=1;
        }
        else if ($_SESSION["student"]["current_level"]=="medium"){
            $level=2;
        } else if ($_SESSION["student"]["current_level"] == "diff") {
            $level=3;
        }

        $qs_1 = $qo->getByLevelWithoutUsedIds($dbh, 1, $level, $_SESSION["student"]["past_questions"] );    // 1 questions, level
//        $qs_1 = $qo->getByLevelWithoutUsedIds($dbh, 1, $level, array (0) ); 
        $data = $qo->loadFullQuestionsWithOptions($dbh, $qs_1);
        $sel_question = array_values($data) [0];
        $_SESSION["student"]["past_questions"][] = $sel_question ['id'];
//MLog::iExport( $sel_question );
        
        $this->prepareQuestion($sel_question);

        return $sel_question;

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

    var $exame_time_second = 30 * 60; // 30 minutes;

    public function index()
    {
        if (empty($_SESSION["student"])) {
            $_SESSION["student"] = array( "start_time" => time());
            $_SESSION["student"]["score"] = 0;
            $_SESSION["student"]["current_level_total"] = 0;
            $_SESSION["student"]["current_level_correct"] = 0;
            $_SESSION["student"]["current_level"] = "easy";
            $_SESSION["student"]["score"] = 0;
            $_SESSION["student"]["question_counter"] = 0;
            $_SESSION["student"]["past_questions"] = array (0);
        }

        $now = time();
        $remaining = ($_SESSION["student"]['start_time'] + $this->exame_time_second) - $now;


        $this->set("remaining_time", $remaining);
    }

    public function one_question()
    {
        if (empty($_SESSION["student"]["current_question"])) {
            $_SESSION["student"]["current_question"] = $this->one_random_question();

        }

        dumpHtmlReadable($_SESSION["student"]["current_question"]);
        $this->set("question", $_SESSION["student"]["current_question"]);
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
        echo "Score = ";
        dumpHtmlReadable($_SESSION["student"]["score"]);
        if ( $_SESSION["student"]["score"] < 40 ) {
            echo "ESL Level";
        } else if ( $_SESSION["student"]["score"] < 60 ) {
            echo "Basic Level";
        } else {
            echo "Advanced Level";
        }
    }


    public function submit()
    {
        MLog::iExport($_POST);
        $qid = $_POST['question_id'];
        MLog::i("Question id:" . $qid);

        $answerKey = "question_${qid}";
        $userAnswers = empty($_POST[$answerKey]) ? array() : $_POST[$answerKey];

        if (empty($_SESSION["student"]["answers"])) {
            $_SESSION["student"]["answers"] = array();
        }
        // Get the POST values from sub_bt(Submit my answer) button
        $_SESSION["student"]["answers"][$qid] = $userAnswers;
        $_SESSION["student"]["current_level_total"]++;
        $_SESSION['student']['question_counter']++;
        if($this->checkAnswer($qid, $userAnswers)){
            /// student is correct
            $_SESSION["student"]["current_level_correct"]++;
            $_SESSION["student"]["score"] += $this->levelScore [$_SESSION["student"]["current_level"]];
//-----
//            MLog::i( "[submit]current_level ${_SESSION["student"]["current_level"]}" );
//            MLog::i( "[submit]level_correct ${_SESSION["student"]["current_level"]}" );
            MLog::i( "[submit] level, score :" );
            MLog::iExport ( $_SESSION["student"]["score"] );
            MLog::iExport ( $_SESSION["student"]["current_level"] );
//--------------------
            
            
            if( $_SESSION["student"]["current_level_total"] >=10 ){
                $corretRate=floatval($_SESSION["student"]["current_level_correct"])/floatval($_SESSION["student"]["current_level_total"])*100;
                if($corretRate > 70){
                    //upgrade to next level
                    MLog::i("Student Lvel Up!!!!");
                    if($_SESSION["student"]["current_level"]=="easy"){
                        $_SESSION["student"]["current_level"]="medium";
                        $_SESSION["student"]["current_level_total"] = 0;
                        $_SESSION["student"]["current_level_correct"] = 0;
                    }
                    else if ($_SESSION["student"]["current_level"]=="medium"){
                        $_SESSION["student"]["current_level"]="diff";
                        $_SESSION["student"]["current_level_total"] = 0;
                        $_SESSION["student"]["current_level_correct"] = 0;
                    }
                }
            }
        }
        else{
            /// student is wrong, may do nothing
        }
        
        if (intval($_SESSION["student"]["question_counter"]) < $this->maxQuestion && $_POST['time_out_flag'] != 1) {
            echo "next";
        } else {
            echo "finish";
        }

        //unset current question
        unset($_SESSION["student"]["current_question"]);
        $this->setLayout("ajax.phtml");
        $this->view->setTemplate("exame_one_by_one/blank.phtml");
    }

    private function checkAnswer($qid, $userAnswers)
    {

        $sel_question = $_SESSION["student"]["current_question"];
        MLog::i("---------------quetion:${qid}");
        MLog::iExport($userAnswers);

        $correctOptions = array();

        MLog::i('sel_question :');
        MLog::iExport($sel_question);

        foreach ($sel_question ['options'] as $q_option) {
            MLog::i('sel_question q_option :');
            MLog::iExport($q_option);         
            if ($q_option ['is_right'] == 1) {
                $correctOptions[intval($q_option['id'])] = 1;
            }
        }//end foreach

        if (count($correctOptions) == count($userAnswers)) {
            $allRight = true;
            foreach ($userAnswers as $one) {
                if (empty ($correctOptions [intval($one)])) {
                    //error
                    $allRight = false;
                    MLog::i("Answer Wrong");
                    break;
                }
            }
            return $allRight;
        } else {
            //error
           return false;
        }


    }

}

?>
