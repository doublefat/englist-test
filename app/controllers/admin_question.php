<?php

$currentDir = dirname(__FILE__);
include_once realpath($currentDir . '/../system') . '/dbfunction.php';
include_once realpath($currentDir . '/../db') . '/Questions.php';

class Admin_questionController extends BasicController
{

    var $optionIndexLetters = array("A", "B", "C", "D", "E", "F", "G", "H", "I");
    var $levelWords = array(1 => "Easy", 2 => "Medium", 3 => "Difficult");

    public function pre_filter(&$methodName = null)
    {
        parent::pre_filter($methodName);

        $this->view->addInternalJs("jquery-1.7.1.min.js");
        $this->view->addInternalJs("jquery-ui-1.8.17.custom.min.js");
        $this->view->addInternalCss("ui-lightness/jquery-ui-1.8.17.custom.css");


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

        $qids = array();
        $data = array();
        $i = 0;
        foreach ($questionInfo["data"] as $one) {
            $id = $one['id'];
            $qids[] = $id;
            $one['options'] = array();
            $one['letterIndex'] = 0;

            if ($i % 2 == 0) {
                $one["css_line"] = "odd_line";
            } else {
                $one["css_line"] = "even_line";
            }
            $i++;
            $one["level_word"] = $this->levelWords[$one['level']];
            $data[$id] = $one;
        }

        $options = $qo->loadOptionsByQuestionIds($dbh, $qids);

        foreach ($options as $one) {
            $one['index'] = $this->optionIndexLetters[$data[$one['question_id']]['letterIndex']];
            $data[$one['question_id']]['letterIndex'] = $data[$one['question_id']]['letterIndex'] + 1;
            if(!empty($one['is_right'])){
                $one['is_right_class']="is_right";
            }
            else{
                $one['is_right_class']="is_not_right";
            }
            $data[$one['question_id']]['options'][] = $one;
        }

        $pageInfo = $questionInfo["page_info"];
        $pageInfo['show_pages'] = calculatePageInfomation($pageInfo['total_pages'], $pageInfo['page_size'], $pageInfo['page_no'], 10);
        $this->set("pageInfo", $pageInfo);

        $this->set("data", $data);
        // dumpHtmlReadable($data);
        //dumpHtmlReadable($pageInfo);


    }

    private function prepareQuestion(&$questionDetail){
        $questionDetail["question"]["level_word"] = $this->levelWords[$questionDetail["question"]['level']];

        $i=0;
        if(!empty($questionDetail["options"])){
            foreach ($questionDetail["options"] as &$oneOption){
                $oneOption['index'] = $this->optionIndexLetters[$i];
                $i++;
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
            $this->set("levelWords", $this->levelWords);
        }
    }

    public function save(){
        dumpHtmlReadable($_POST);
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

        $questionDetail=$qo->loadOneQuestionWithOptions($dbh,$qid);
        //dumpHtmlReadable($questionDetail);
        if(!empty($questionDetail)){
            $this->prepareQuestion($questionDetail);
        }

        $this->set("info", $questionDetail);
    }
    public function ajax()
    {
        $this->setLayout("ajax.phtml");
        $this->set("exa3", "Hello World, ajax");
    }

    public function phpinfo()
    {

    }
}

?>