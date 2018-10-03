<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class definitions_helper {

    const PRIVILEGEF_NOT_SETUP = 0;
    const PRIVILEGEF_OPEN = 1000;
    const PRIVILEGEF_USER_ONLY = 100;
    const PRIVILEGEF_RELATIVE_ONLY = 10;
    const PRIVILEGEF_RELATIVE_PRIVATE = 1;

    public static $privilege_explain = array(
        definitions_helper::PRIVILEGEF_NOT_SETUP => '尚未定义权限,仅本人可见',
        definitions_helper::PRIVILEGEF_OPEN => '可以被任何人访问(例如发到微信里面)',
        definitions_helper::PRIVILEGEF_USER_ONLY => '本系统用户',
        definitions_helper::PRIVILEGEF_RELATIVE_ONLY => '只有照片相关用户可见',
        definitions_helper::PRIVILEGEF_RELATIVE_PRIVATE => '只有本人可见'
    );

    const USER_KEY_PHONE = 1;
    const USER_KEY_IS_OPEN_PHONE = 2;
    const USER_KEY_IS_OPEN_EMAIL = 5;
    const USER_KEY_WEICHAT = 7;
    const USER_KEY_IS_WEICHAT_OPTN = 9;
    const USER_KEY_QQ = 10;
    const USER_KEY_IS_QQ_OPEN = 11;
    const USER_KEY_CITY = 12;
    const USER_KEY_STATE = 13;
    const USER_KEY_COUNTRY = 14;
    const USER_KEY_HIGH_SCHOOL_PHOTO = 16;
    const USER_KEY_NOW_PHOTO = 17;
    const USER_KEY_PROFILE_PHOTO = 18;
    const USER_KEY_COMPANY = 19;
    const USER_KEY_IS_COMPANY_OPEN = 20;
    const USER_KEY_GENDER = 21;
    const USER_KEY_REGISTER_CODE = 22;
    const USER_KEY_CLASSMATE_NAMES_FROM_FRIEND = 23;
    const USER_KEY_VERIFY_TIMES = 25;
    const USER_KEY_EMAIL_VALID = 26;
    const USER_KEY_EMAIL_VALID_CODE = 27;
    const USER_KEY_LAST_SEND_VERIFY_EMAIL_TIME=28;
    const USER_KEY_PASSWORD_RESET_REQUIRED_CODE=29;
    //////////////////
    const BEHAVIOR_TYPE_UNREQUIRED = 1;
    const BEHAVIOR_TYPE_REQUIRED = 2;
    const BEHAVIOR_TYPE_READONLY = 3;
    const BEHAVIOR_TYPE_PROGRAM_USING = 4;
    ////////////////
    const USER_TYPE_INVITED_CLASSMATE = 1;
    const USER_TYPE_INVITED_FRIEND = 2;
    const USER_TYPE_APPLYING_CLASSMATE = 3;
    const USER_TYPE_APPLYING_FRIEND = 4;
    const USER_TYPE_DENIED_CLASSMATE = 5;
    const USER_TYPE_DENIED_FRIEND = 6;
    const USER_TYPE_PASS_FAIL_CLASSMATE = 7;
    const USER_TYPE_PASS_FAIL_FRIEND = 8;
    const USER_TYPE_MANUAL_REQUIRED_CLASSMATE = 9;
    const USER_TYPE_VERIFYING_CLASSMATE = 10;
    const USER_TYPE_REGISTERED_FRIEND = 70;
    const USER_TYPE_REGISTERED_CLASSMATE = 80;
    const USER_TYPE_ADMIN = 100;
    const USER_TYPE_SUPPER_ADMIN = 1000;
    const KEY_TYPE_INT = 1;
    const KEY_TYPE_TEXT = 2;
    const KEY_TYPE_INT_STRING = 3;

}
