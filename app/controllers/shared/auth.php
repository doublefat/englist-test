<?php
$currentDir = dirname(__FILE__);
include_once realpath(dirname(__FILE__)) . '/html.php';
include_once realpath($currentDir . '/../../db') . '/Teacher.php';
class AuthRequiredController extends HtmlController
{

    public function pre_filter(&$methodName = null)
    {
        if (parent::pre_filter($methodName) === false) {
            return false;
        }


        if (empty($_SESSION['teacher_info']['id'])) {
            $this->redirect_url = "/";
            return false;
        }


        $this->tObj = new Teacher();

        $teacher = $this->tObj->loadById($this->dbh, $_SESSION['teacher_info']['id']);


        if(intval($teacher['amdin_type'])===0){
            //disable user
            unset($_SESSION['teacher_info']);
            $this->redirect_url = "/";
            return false;
        }
        else{
            $_SESSION['teacher_info']=$teacher;

        }

        $this->set('teacher',$teacher);


        return true;
    }

}

?>