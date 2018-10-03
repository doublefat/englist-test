<?php

include_once realpath(dirname(__FILE__)) . '/shared/html.php';

class LoginController extends HtmlController {

    public function index() {

        if (!empty($_SESSION['user_info'])) {

            //TODO
        }
        else{
            $this->setLayout('login.phtml');
        }
    }


    public function login() {
        //no need view 
        $this->view = null;
        try {

            if (empty($_POST['login_name'])) {
                throw new Exception("用户名,或者email 是空的", IndexController::EXCEPTION_CODE_USER_ERROR);
            }
            if (empty($_POST['login_password'])) {
                throw new Exception("密码是空的", IndexController::EXCEPTION_CODE_USER_ERROR);
            }

           

            $userObj = new db_user();

          
            $user = $userObj->loadByEmailNamePassword($this->dbh, md5($_POST['login_password']), $_POST['login_name'], $_POST['login_name']);



            if ($user === false) {
                $errorMessage= 'Eamil/Password Error';
            } else {

                $_SESSION['user_info'] = $user;
                //TODO
            }
        } catch (Exception $exc) {
            MLog::eExport($exc->getTraceAsString(), $exc->getMessage());
            $errorMessage=  '系统错误';
            //TODO
        }
    }


    public function logout() {
        unset($_SESSION['user_info']);
        $this->redirect_url = "/";
    }





}

?>