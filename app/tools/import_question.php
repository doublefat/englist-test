<?php
/**
 * Created by IntelliJ IDEA.
 * User: mtao60
 * Date: 9/25/18
 * Time: 8:39 PM
 */
$currentDir = dirname(__FILE__);
include_once $currentDir . '/../db/Questions.php';


function connectPDO()
{
    $engine = 'mysql';
    $host = '127.0.0.1';
    $port = '3306';
    $user = 'kg';
    $dbname = 'testing';
    $password = 'Kgame123!';


    $dsn = "{$engine}:host={$host};port={$port};dbname={$dbname}";


    $initPDO = array();
//$dsn.=';charset=UTF8';

//$initPDO[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES utf8";

    $dbh = new PDO($dsn, $user, $password, $initPDO);
    return $dbh;
}

function test($dbh)
{
    if ($dbh === null) {
        try {
            $dbh = connectPDO();
        } catch (Exception $exc) {
            error_log($exc->getMessage() . ".\n Trace:\n" . $exc->getTraceAsString());
            return false;
        }


    }

}

echo "hello";

test(null);