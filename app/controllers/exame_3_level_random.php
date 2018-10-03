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
	$qs = $qo->getByLevelWithoutUsedIds ( $dbh, 3, 1, array(0) );	// 3 questions, level 1 (easy)
	$data = $qo->loadFullQuestionsWithOptions ( $dbh, $qs );
	foreach ( $data as $id=>&$qua ) {
	    $this->prepareQuestion ( $qua );
	}
	dumpHtmlReadable ( $data );
	$this->set ( 'data', $data );	// send data to html
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
//	$this->view->setTemplate("test/blank.phtml");

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
        dumpHtmlReadable($_POST);
        
       
        
        foreach ($_POST as $key=>$value){
             if(strpos($key,"question_")===0 && is_array($value) && !empty($value)){
                 // this is one question answer!!!
                 echo "find a question:${key} <br/>";
             }
        }
        
        //$this->redirect("/exame_3_level_random/finish_exame");
    }
    
    public function finish_exame(){
        $this->set("message","Exam submitted....");
    }
}

?>
    