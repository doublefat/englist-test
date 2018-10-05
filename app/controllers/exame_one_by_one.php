<?php

$currentDir = dirname(__FILE__);
include_once realpath($currentDir . '/../system') . '/dbfunction.php';
include_once realpath($currentDir . '/../db') . '/Questions.php';

class exame_one_by_oneController extends BasicController
{

    public function pre_filter(&$methodName = null) {
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

	// Request for an easy question and the coresponding options
	$qs_1 = $qo->getByLevelWithoutUsedIds ( $dbh, 1, 1, array(0) );	// 1 questions, level 1 (easy)
	$data = $qo->loadFullQuestionsWithOptions ( $dbh, $qs_1 );
 	foreach ( $data as $id=>&$qua ) {		// Pack all the question and options
	    $this->prepareQuestion ( $qua );
	}
	dumpHtmlReadable ( $data );			// Testing....
        $this->set ( 'data', $data );			// Send data to html
	echo '<hr/>';       
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
        
        foreach ( $data as &$user_answer ) {
            echo 'check an answered question';
            $q_opt_check = 0;  // 0 : unchecked/right, 1 : wrong
            foreach ( $user_answer ["options"] as &$db_opt ) {
                $in_usr_opt = 0;
                foreach ( $user_answer ["question"]["user_answer"] as &$usr_opt ) {
                    echo 'usr_opts';
                    dumpHtmlReadable($usr_opt);
                    if ( $usr_opt == $db_opt ["id"] && $db_opt ["is_right"] == 0 ) {
                        $q_opt_check = 1;
                        break;
                    }
                    if ( $usr_opt == $db_opt ["id"] ) {
                       $in_usr_opt = 1;
                    }
                }
                if ( $in_usr_opt == 0 && $db_opt ["is_right"] == 1 ) {
                    $q_opt_check = 1;
                }
                if ( $q_opt_check == 1 ) {
                    break;
                }
            }
            if ( $q_opt_check == 0 )
                echo 'user answer right';
            else
                echo 'user answer wrong\n';   
        }   
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
    public function session_demo(){
        if(empty($_SESSION["abcd_counter"])){
            $_SESSION["abcd_counter"]=0;
        }
        $_SESSION["abcd_counter"]++;
        $this->set("session_value",$_SESSION["abcd_counter"]);
    }
}

?>