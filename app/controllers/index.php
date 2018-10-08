<?php

class IndexController extends BasicController
{


    public function index()
    {


        $this->set("errorMessage", "");
        if (empty($_SESSION['teacher_info']['id'])) {
            $this->set("show_login", true);
        } else {
            $this->set("show_login", false);
        }


    }
}

?>