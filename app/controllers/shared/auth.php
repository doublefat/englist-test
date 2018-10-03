<?php

include_once realpath(dirname(__FILE__)) . '/html.php';

class AuthRequiredController extends HtmlController
{

    public function pre_filter(&$methodName = null)
    {
        if (parent::pre_filter($methodName) === false) {
            return false;
        }


        if (empty($_SESSION['user_info'])) {
            $this->redirect_url = "/";
            return false;
        }


        $this->user_object = new db_user();

        $this->user = $this->user_object->loadById($this->dbh, $_SESSION['user_info']['id']);
        $_SESSION['user_info'] = $this->user;
        $type = intval($this->user['user_type_id']);


        if ($type < 60) {
            $this->redirect_url = "/";
            return false;
        }

        $this->set('user', $this->user);


        return true;
    }

}

?>