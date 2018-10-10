<?php

$currentDir = dirname(__FILE__);

include_once realpath($currentDir . '/../db') . '/Teacher.php';
include_once realpath(dirname(__FILE__)) . '/shared/html.php';

class LoginController extends HtmlController
{

    public function index()
    {

        if (!empty($_SESSION['teacher_info'])) {

            //TODO
        } else {
            $this->setLayout('login.phtml');
        }
    }


    public function login()
    {
        //no need view 
        $this->view = null;
        try {

            if (empty($_POST['email'])) {
                throw new Exception("email is empty", IndexController::EXCEPTION_CODE_USER_ERROR);
            }
            if (empty($_POST['password'])) {
                throw new Exception("password is emtpy", IndexController::EXCEPTION_CODE_USER_ERROR);
            }


            $userObj = new Teacher();


            $user = $userObj->verifyUser($this->dbh, $_POST['email'], md5($_POST['password']), $_POST['login_name']);


            if ($user === false) {
                $this->set("errorMessage", 'Eamil/Password Error');
                $this->view->setTemplate("index/index.phtml");
            } else {

                $_SESSION['teacher_info'] = $user;

                $this->redirect_url = "/";
            }
        } catch (Exception $exc) {
            MLog::eExport($exc->getTraceAsString(), $exc->getMessage());
            $this->set("errorMessage", "system error");
            $this->view->setTemplate("index/index.phtml");
        }
    }


    public function logout()
    {
        unset($_SESSION['teacher_info']);
        $this->redirect_url = "/";
    }


    public function student_login()
    {

        if (empty($_POST['sid'])) {
            $this->set("errorMessage", 'student id can not be empty');
            $this->view->setTemplate("index/index.phtml");
        } else if (!is_int(intval($_POST['sid']))) {
            $this->set("errorMessage", 'student id should be integer');
            $this->view->setTemplate("index/index.phtml");
        } else {
            $_SESSION['student_name'] = $_POST['sname'];
            $_SESSION['student_id'] = intval($_POST['sid']);
            unset($_SESSION["student"]);

            $this->redirect("/exame_one_by_one/");
        }


    }


}

?>