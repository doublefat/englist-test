<?php

$currentDir = dirname(__FILE__);
include_once realpath(dirname(__FILE__)) . '/shared/auth.php';
include_once realpath($currentDir . '/../db') . '/Teacher.php';

//md5 123456 = e10adc3949ba59abbe56e057f20f883e

//class Teacher_mngController extends AuthRequiredController {
class Teacher_mngController extends AuthRequiredController
{

    static  $admin_types = array(2 => "general", 1 => "admin", 0 => "disable");

    public function pre_filter(&$methodName = null)
    {
        parent::pre_filter($methodName);

        $this->view->addInternalJs("jquery-1.7.1.min.js");
        $this->view->addInternalJs("jquery-ui-1.8.17.custom.min.js");
        $this->view->addInternalCss("ui-lightness/jquery-ui-1.8.17.custom.css");


        $this->set("admin_types", $this->admin_types);

        $this->setLayout("teacher_layout.phtml");
        return true;
    }

    public function index()
    {

        $teacherDb = new Teacher();
        $allTeachers = $teacherDb->listAll($this->dbh);

        addOddEvenClass($allTeachers);

        $this->set("list", $allTeachers);
    }

    public function edit()
    {
        $teacherDb = new Teacher();
        if (!empty($_REQUEST['tid'])) {
            $t = $teacherDb->load($this->dbh, $_REQUEST['tid']);

            if (!empty($t)) {

                $this->set("errorMessage", array());

                $this->set("id", $t['id']);
                $this->set("email", $t['email']);
                $this->set("first", $t['first_name']);
                $this->set("last", $t['last_name']);
                $this->set("type", $t['amdin_type']);

            } else {
                $this->set("errorMessage", "can not load teacher info by id:${_REQUEST['tid']}");
                $this->view->setTemplate("error/general_error.phtml");

            }
        } else {
            $this->set("errorMessage", "no tid found!");
            $this->view->setTemplate("error/general_error.phtml");

        }

    }

    public function reset_password()
    {
        $teacherDb = new Teacher();
        if (!empty($_REQUEST['tid'])) {
            $t = $teacherDb->load($this->dbh, $_REQUEST['tid']);

            if (!empty($t)) {

                $this->set("errorMessage", array());
                $this->set("email", $t['email']);
                $this->set("id", $t['id']);

            } else {
                $this->set("errorMessage", "can not load teacher info by id:${_REQUEST['tid']}");
                $this->view->setTemplate("error/general_error.phtml");

            }
        } else {
            $this->set("errorMessage", "no tid found!");
            $this->view->setTemplate("error/general_error.phtml");

        }

    }

    public function new_one()
    {

        $this->set("errorMessage", array());
        $this->set("email", "");
        $this->set("first", "");
        $this->set("last", "");
        $this->set("type", 2);


    }

    public function create()
    {

        $errMessage = array();

        $email = empty($_REQUEST["email"]) ? "" : $_REQUEST["email"];
        $first = empty($_REQUEST["first_name"]) ? "" : $_REQUEST["first_name"];
        $last = empty($_REQUEST["last_name"]) ? "" : $_REQUEST["last_name"];
        $password1 = empty($_REQUEST["password1"]) ? "" : $_REQUEST["password1"];
        $password2 = empty($_REQUEST["password2"]) ? "" : $_REQUEST["password2"];
        $type = $_REQUEST["type"];


        if (empty($email)) {
            $errMessage[] = "Email can not be empty.";

        } else {
            $emails = explode("@", $email);
            if (count($emails) !== 2 || empty($emails[0]) || empty($emails[1])) {
                $errMessage[] = "${email} is not a valid email format.";
            }
        }

        if (empty($password1) || empty($password2)) {
            $errMessage[] = "Password can not be empty.";
        } else if ($password1 !== $password2) {
            $errMessage[] = "Two password is not the same.";
        }


        if (!empty($errMessage)) {
            $this->set("errorMessage", $errMessage);
            $this->set("email", $email);
            $this->set("first", $first);
            $this->set("last", $last);
            $this->set("type", $type);
            $this->set("admin_types", $this->admin_types);
            $this->view->setTemplate("teacher_mng/new_one.phtml");
        } else {
            //dumpHtmlReadable($_POST);
            $t = new Teacher();
            $t->create($this->dbh, $type, $first, $last, 0, $email, md5($password1), "");
            $this->redirect("/teacher_mng/index");
            //$this->view->setTemplate("test/blank.phtml");
        }

    }

    public function save()
    {


        $id = empty($_REQUEST["id"]) ? "" : $_REQUEST["id"];
        $first = empty($_REQUEST["first_name"]) ? "" : $_REQUEST["first_name"];
        $last = empty($_REQUEST["last_name"]) ? "" : $_REQUEST["last_name"];
        $type = $_REQUEST["type"];


        if (empty($id)) {

            $this->set("errorMessage", "Id can not be empty");
            $this->view->setTemplate("error/general_error.phtml");
        } else {
            $t = new Teacher();
            $t->update($this->dbh, $id, $type, $first, $last, 0, "");
            $this->redirect("/teacher_mng/index");
        }


    }

    public function save_password()
    {


        $id = empty($_REQUEST["id"]) ? "" : $_REQUEST["id"];
        $password1 = empty($_REQUEST["password1"]) ? "" : $_REQUEST["password1"];
        $password2 = empty($_REQUEST["password2"]) ? "" : $_REQUEST["password2"];


        if (empty($id)) {

            $this->set("errorMessage", "Id can not be empty");
            $this->view->setTemplate("error/general_error.phtml");
        } else if (empty($password1) || empty($password2)) {
            $this->set("errorMessage", "Password can not be empty.");
            $this->view->setTemplate("error/general_error.phtml");
        } else if ($password1 !== $password2) {
            $this->set("errorMessage", "Two password is not the same.");
            $this->view->setTemplate("error/general_error.phtml");
        } else {
            $t = new Teacher();
            $t->updatePassword($this->dbh, $id, md5($password1));
            $this->redirect("/teacher_mng/index");
        }


    }


}

?>