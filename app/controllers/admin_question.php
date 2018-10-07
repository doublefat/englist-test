<?php

$currentDir = dirname(__FILE__);
include_once realpath($currentDir . '/../system') . '/dbfunction.php';
include_once realpath($currentDir . '/../db') . '/Questions.php';

class Admin_questionController extends BasicController
{

    var $optionIndexLetters = array("A", "B", "C", "D", "E", "F", "G", "H", "I");
    var $levelWords = array(1 => "Easy", 2 => "Medium", 3 => "Difficult");
    var $statusWords = array(0 => "Enable", 1 => "Disable");

    public function pre_filter(&$methodName = null)
    {
        parent::pre_filter($methodName);

        $this->view->addInternalJs("jquery-1.7.1.min.js");
        $this->view->addInternalJs("jquery-ui-1.8.17.custom.min.js");
        $this->view->addInternalCss("ui-lightness/jquery-ui-1.8.17.custom.css");

        $this->set("levelWords", $this->levelWords);
    }

    public function index()
    {


        $dbh = connectPDO();
        $pageSize = 10;
        if (!empty($_REQUEST["pn"])) {
            $pn = intval($_GET["pn"]);
        } else {
            $pn = 1;
        }

        $qo = new Questions();
        $questionInfo = $qo->listQuestions($dbh, $pn, $pageSize);
//	dumpHtmlReadable($questionInfo);

        $data=$qo->loadFullQuestionsWithOptions($dbh,$questionInfo['data']);
//	dumpHtmlReadable($data);

        foreach ($data as $id=>&$qua) {
            $this->prepareQuestion($qua);
        }
//	dumpHtmlReadable($data);
	echo "<hr/>";

        $pageInfo = $questionInfo["page_info"];
        $pageInfo['show_pages'] = calculatePageInfomation($pageInfo['total_pages'], $pageInfo['page_size'], $pageInfo['page_no'], 10);
//	$this->set("sth", $sth);   // set the sth variable of view with $sth
        $this->set("pageInfo", $pageInfo);

        $this->set("data", $data);
        // dumpHtmlReadable($data);
        //dumpHtmlReadable($pageInfo);

        if(isset($_SESSION['counter'])){
            $_SESSION['counter']+=1;
        }
        else{
            $_SESSION['counter']=1;
        }

        $this->set('counter',$_SESSION['counter']);


    }

    private function prepareQuestion(&$questionDetail){
        $questionDetail["question"]["level_word"] = $this->levelWords[$questionDetail["question"]['level']];
        $questionDetail["question"]["status_word"] = $this->statusWords[$questionDetail["question"]['disable']];

        $i=0;
        if(!empty($questionDetail["options"])){
            foreach ($questionDetail["options"] as &$oneOption){
                $oneOption['index'] = $this->optionIndexLetters[$i];
                $i++;
                if(!empty($oneOption['is_right'])){
                    $oneOption['is_right_class']="is_right";
                }
                else{
                    $oneOption['is_right_class']="is_not_right";
                }
            }
        }
    }
    public function edit()
    {
        $qn = $_REQUEST['qn'];
        if (!empty($qn)) {
            $dbh = connectPDO();
            $qo = new Questions();
            $questionDetail = $qo->loadOneQuestionWithOptions($dbh, $qn);
            if(!empty($questionDetail)){
                $this->prepareQuestion($questionDetail);
            }
            //dumpHtmlReadable($questionDetail);
            $this->set("qd", $questionDetail);

        }
    }

    public function show(){
        $qid=$_REQUEST['qid'];
        $dbh = connectPDO();
        $qo = new Questions();
        $questionDetail=$qo->loadOneQuestionWithOptions($dbh,$qid);
        //dumpHtmlReadable($questionDetail);
        if(!empty($questionDetail)){
            $this->prepareQuestion($questionDetail);
        }

        $this->set("info", $questionDetail);
    }

    public function save(){
        //dumpHtmlReadable($_POST);
        $qid=$_POST['id'];

        $dbh = connectPDO();
        $qo = new Questions();


        $options=array();
        foreach ($_POST as $key=>$val){

            if(strrpos($key,"option_id_")===0 && !empty($val)){
                $id=intval(substr($key,10));
                $option=array("id"=>$id,'content'=>$val);
                if(!empty($_POST["is_right_${id}"])){
                    $option["is_right"]=1;
                }
                else{
                    $option["is_right"]=0;
                }
                $options[]=$option;
            }
            else if(strrpos($key,"option_new_")===0 && !empty($val)){
                $newId=intval(substr($key,11));
                $option=array("id"=>0,'content'=>$val);
                if(!empty($_POST["is_right_${$newId}"])){
                    $option["is_right"]=1;
                }
                else{
                    $option["is_right"]=0;
                }
                $options[]=$option;
            }
        }

        //dumpHtmlReadable($options);

        $qo->updateWholeQuestion($dbh,$qid,$_POST["type"],$_POST["associate_id"],$_POST["level"],$_POST["detail"],$options);


        $this->redirect("/admin_question/show?qid=${qid}");
    }

    public function statusChange(){
        $qid=$_REQUEST['qid'];
        $disable=$_REQUEST['disable'];
        $dbh = connectPDO();
        $qo = new Questions();
        $qo->updateQuestionStatus($dbh,$qid,$disable);
        $this->redirect("/admin_question/show?qid=${qid}");

    }



    public function new_one(){

        $this->set("optionsLetters",$this->optionIndexLetters);
    }

    public function create(){
        //dumpHtmlReadable($_POST);

        $dbh = connectPDO();
        $qo = new Questions();


        $options=array();
        foreach ($this->optionIndexLetters as $l){
            $optionDetailKey="options_${l}";
            $optionIsirightKey="${l}_is_right";

            if(!empty($_POST[$optionDetailKey])){

                $opion=array('content'=>$_POST[$optionDetailKey]);

                if(!empty($_POST[$optionIsirightKey])){
                    $opion['is_right']=1;
                }
                else{
                    $opion['is_right']=0;
                }

                $options[]=$opion;
            }

        }

        $defaultQuestionType=0;

        if(!empty($options) && !empty($_POST['detail'])){
            $qid=$qo->addQuestion($dbh,$defaultQuestionType,0,$_POST['associate_id'],$_POST['level'],$_POST['detail'],"",$options);

            if(empty($qid)){
                $this->set("errorMessage","db error");
                $this->setView("error/general_error");
            }
            else{
                $this->redirect("/admin_question/show?qid=${qid}");
            }

        }
        else{
            $this->set("errorMessage","detail can not be emtpy or at least have one option");
            $this->setView("error/general_error");
        }




        //dumpHtmlReadable($options);





    }
}

?>
