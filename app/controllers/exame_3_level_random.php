<?php

$currentDir = dirname(__FILE__);
include_once realpath($currentDir . '/../system') . '/dbfunction.php';
include_once realpath($currentDir . '/../db') . '/Questions.php';

class exame_3_level_randomController extends BasicController
{


    public function pre_filter(&$methodName = null)
    {
        parent::pre_filter($methodName);

        $this->view->addInternalJs("jquery-1.7.1.min.js");
        $this->view->addInternalJs("jquery-ui-1.8.17.custom.min.js");
        $this->view->addInternalCss("ui-lightness/jquery-ui-1.8.17.custom.css");


    }

    var $levelWords = array(1 => "Easy", 2 => "Medium", 3 => "Difficult");
    public function index() {

        // please refer app/controllers/test.php
	$dbh = connectPDO();
        //load easy question
	$easy = Array(); //TODO
	$qo = new Questions();
	$total = $qo->countByLevel($dbh,1);
	echo "<hr/>";
	echo "easy total = ";
	dumpHtmlReadable($total);
	echo "<hr/>";
	// Request for questions and the coresponding options
	$qs_1 = $qo->getByLevelWithoutUsedIds ( $dbh, 3, 1, array(0) );	// 3 questions, level 1 (easy)
        $qs_2 = $qo->getByLevelWithoutUsedIds ( $dbh, 3, 2, array(0) );	// 3 questions, level 2 (medium)
        $qs_3 = $qo->getByLevelWithoutUsedIds ( $dbh, 3, 3, array(0) );	// 3 questions, level 1 (hard)
	$data_1 = $qo->loadFullQuestionsWithOptions ( $dbh, $qs_1 );
        $data_2 = $qo->loadFullQuestionsWithOptions ( $dbh, $qs_2 );
        $data_3 = $qo->loadFullQuestionsWithOptions ( $dbh, $qs_3 );
        // Put three array into one array
        $data = array_merge($data_1, $data_2);
        $data = array_merge($data, $data_3);
	foreach ( $data as $id=>&$qua ) {		// Pack all the question and options
	    $this->prepareQuestion ( $qua );
	}
	dumpHtmlReadable ( $data );			// Testing....
	$this->set ( 'data', $data );			// Send data to html
	echo '<hr/>';

	// load medium
	$medium = Array(); //TODO
	$qo = new Questions();
	$total = $qo->countByLevel($dbh,2);
	echo "<hr/>";
	echo "medium total = ";
	dumpHtmlReadable($total);
	echo "<hr/>";
	
 	// load Hard
	$hard = Array(); // TODO
	$qo = new Questions();
	$total=$qo->countByLevel($dbh,3);
	echo "<hr/>";
	echo "difficult total = ";
	dumpHtmlReadable($total);
	echo "<hr/>";

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//	$this->view->setTemplate("test/blank.phtml");	// for testing

        // Put three array into one array

//        $finalArray=Array(
//            Array('id'=>'abc','title'=>'t1'),

//            Array('id'=>'eeed','title'=>'t2')
//        );//TODO , this fake code to demo the records in array

        // Set final array to view Variable

//        $this->set("all_questions",$finalArray);


    }

    var $optionIndexLetters = array("A", "B", "C", "D", "E", "F", "G", "H", "I");
    var $question_cnter = 1;
    private function prepareQuestion ( &$questionDetail ) {
	$questionDetail["question"]["level_word"] = $this->levelWords[$questionDetail["question"]['level']];
	$questionDetail["question"]["status_word"] = $this->statusWords[$questionDetail["question"]['disable']];
	$questionDetail["question"]["q_cnt"] = $this->question_cnter; 
	$this->question_cnter++;

	$i=0;
	if ( !empty ( $questionDetail ["options"] ) ) {
	    foreach ( $questionDetail["options"] as &$oneOption ) {
		$oneOption['index'] = $this->optionIndexLetters [$i];
		$i++;
		if ( !empty ( $oneOption ['is_right'] ) ) {
		    $oneOption ['is_right_class'] = "is_right";
		}
		else {
		    $oneOption ['is_right_class'] = "is_not_right";
		}
	    }
	}
    }    

    public function submit (){
        echo "POST";
        dumpHtmlReadable($_POST);

       
        $question=array();
        foreach ($_POST as $key=>$value){
             if(strpos($key,"question_")===0 && is_array($value) && !empty($value)){
                 // this is one question answer!!!
                 echo "=====find a question:${key} <br/>";
                 $question[]=array("id"=>substr($key,9),'user_answer'=>$value);
             }
        }
 
        $exam_result = array (0, 0, 0);
        
        $dbh = connectPDO();
        $qo = new Questions();
        $data = $qo->loadFullQuestionsWithOptions ( $dbh, $question );
       
        dumpHtmlReadable("data");
        dumpHtmlReadable($data);
        //$this->redirect("/exame_3_level_random/finish_exame");
        
        foreach ( $data as &$user_answer ) {
            echo 'check an answered question';
            $q_opt_check = 0;  // 0 : unchecked/right, 1 : wrong
            foreach ( $user_answer ["options"] as &$db_opt ) {
                echo 'db_opt';
                dumpHtmlReadable($db_opt);
                echo 'db_opt_id = ';
                dumpHtmlReadable($db_opt ["id"] );
                $in_usr_opt = 0;
                foreach ( $user_answer ["question"]["user_answer"] as &$usr_opt ) {
                    echo 'usr_opts';
                    dumpHtmlReadable($usr_opt);
                    if ( $usr_opt == $db_opt ["id"] && $db_opt ["is_right"] == 0 ) {
                        $q_opt_check = 1;
                        dumpHtmlReadable ("Answer wrong 0");
                        dumpHtmlReadable ( $usr_opt );
                        dumpHtmlReadable ( $$db_opt ["is_right"] );
                        break;
                    }
                    if ( $usr_opt == $db_opt ["id"] ) {
                       dumpHtmlReadable ( "q_opt_check set!!" ); 
                       $in_usr_opt = 1;
                    }
                }
                if ( $in_usr_opt == 0 && $db_opt ["is_right"] == 1 ) {
                    $q_opt_check = 1;
                    dumpHtmlReadable ( "db_opt [id] : " );
                    dumpHtmlReadable ( $db_opt [id] );
                    dumpHtmlReadable ( "in_usr_opt : " );
                    dumpHtmlReadable ( $in_usr_opt );
                    dumpHtmlReadable ("Answer Wrong 1");
                }
                if ( $q_opt_check == 1 ) {
                    dumpHtmlReadable ("Answer wrong break!!'");
                    break;
                }
            }
            if ( $q_opt_check == 0 )
                echo 'user answer right';
            else
                echo 'user answer wrong\n';
            
        }
        
    }
    
    public function finish_exame(){
        $this->set("message","Exam submitted....");
    }
}

?>
    
