<?php

include_once realpath(dirname(__FILE__)) . '/shared/auth.php';

class Teacher_mngController extends AuthRequiredController {

    public function pre_filter(&$methodName = null) {
        parent::pre_filter($methodName);

        $this->view->addInternalJs("jquery-1.7.1.min.js");
        $this->view->addInternalJs("jquery-ui-1.8.17.custom.min.js");
        $this->view->addInternalCss("ui-lightness/jquery-ui-1.8.17.custom.css");

        if (intval($this->user['user_type_id']) < 100) {

            $this->redirect_url = "/";
            return false;
        }

        return true;
    }

    public function teacher_list() {
        //TODO
    }

    public function edit() {
        $id = $_GET['id'];

        if (empty($id)) {
            $this->redirect_url = '/teacher_mng/teacher_list';
            return;
        }
        $uObj = new db_user();

        $user = $uObj->loadById($this->dbh, $id);

        if ($user !== false) {
            $extra = $uObj->loadAllUserExtraInfo($this->dbh, $id);
            $ops = $uObj->getAllUserOptions($this->dbh);

            $explain = array();
            foreach ($ops as $one) {
                $explain[intval($one['id'])] = $one;
            }

            $this->set('type_id', intval($user['user_type_id']));
        }

        $this->set('edit_user', $user);
        $this->set('extra', $extra);
        $this->set('explain', $explain);



        $this->set('classmate_types', $this->classmates);
        $this->set('friend_types', $this->friends);
        $this->set('admin_types', $this->admins);




        $tys = $uObj->loadUserType($this->dbh);

        $types = array();
        foreach ($tys as $one) {
            $types[intval($one['user_type_id'])] = $one['label'];
        }

        $this->set('types', $types);
    }

    public function save() {
        $this->view = null;
        $re = array();
        if (empty($_POST['id'])) {
            $re['error_message'] = 'empty id';
            echo json_encode($re);
            return;
        }
        if (empty($_POST['action'])) {
            $re['error_message'] = 'empty action';
            echo json_encode($re);
            return;
        }
        $id = $_POST['id'];
        $uObj = new db_user();
        switch ($_POST['action']) {
            case 'save_email':
                if (empty($_POST['email'])) {
                    $re['error_message'] = 'email 是空的';
                    echo json_encode($re);
                    return;
                }
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $re['error_message'] = "{$_POST['email']} 不是一个正确的Email 的格式";
                    echo json_encode($re);
                    return;
                }

                if ($uObj->updateEmail($this->dbh, $id, $_POST['email']) === false) {
                    $re['error_message'] = 'Email 更新错误, 有可能此email 已经被其他同学使用';
                } else {
                    $re['status'] = 'ok';
                }
                break;
            case 'save_password':
                if (empty($_POST['new_password'])) {
                    $re['error_message'] = '新密码是空的';
                    echo json_encode($re);
                    return;
                }
                if ($uObj->updatePassword($this->dbh, $id, md5($_POST['new_password'])) === false) {
                    $re['error_message'] = '新密码 更新错误, 联系系统管理员';
                } else {
                    $re['status'] = 'ok';
                }
                break;
            case 'save_status':
                if (empty($_POST['new_status'])) {
                    $re['error_message'] = '新状态的值是空的';
                    echo json_encode($re);
                    return;
                }
                $vs = null;
                $newStatus = intval($_POST['new_status']);
                if (in_array($newStatus, $this->classmates)) {
                    $vs = $this->classmates;
                } else if (in_array($newStatus, $this->friends)) {
                    $vs = $this->friends;
                } else {
                    $re['error_message'] = "非法新状态值:{$newStatus}";
                    echo json_encode($re);
                    return;
                }

                if ($uObj->updateType($this->dbh, $id, $vs, $newStatus) === false) {
                    $re['error_message'] = '状态更新错误, 联系系统管理员';
                } else {
                    $re['status'] = 'ok';
                }
                break;
            default:
                $re['error_message'] = "unknown action:{$_POST['action']}";
        }

        echo json_encode($re);
    }

}

?>