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

function truncateQuetion($dbh,$table)
{

    $sql = "TRUNCATE TABLE ${table}";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

}


function insertOneQuestion($dbh, $level, $num, $content, $a, $b, $c, $d)
{

    // echo "insert :".$question;
    if (empty($content) || empty($a) || empty($b) || empty($c) || empty($d)) {
        echo "wrong for num:[${num}] content:[${content}] a[${a}] b[${b}] c[${c}] d[${d}]\n";
    } else {
        //echo "will insert  for num:[${num}] content:[${content}] a[${a}] b[${b}] c[${c}] d[${d}]\n";
        $q = new Questions();
        $optons = array(array("content" => $a, "is_right" => 0),
            array("content" => $b, "is_right" => 0),
            array("content" => $c, "is_right" => 0),
            array("content" => $d, "is_right" => 0));
        $q->addQuestion($dbh, 1, 0, $level, $content, "", $optons);
    }
}

function import($dbh,$filePath, $level)
{
    $qustionReg = "/(.*)______(\d+)\\.\s*(.*)/";
    $handle = fopen($filePath, "r");
    $start = 0;
    $num = 0;
    $content = "";

    $a = "";
    $b = "";
    $c = "";
    $d = "";


    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            // process the line read.
            preg_match($qustionReg, $line, $matches);
            if (!empty($matches)) {
                //print_r($matches);
                //find question
                if ($start != 0) {
                    //save previous question


                    insertOneQuestion($dbh, $level, $num, $content, $a, $b, $c, $d);

                }

                $start = 1;
                $num = $matches[2];
                $content = $matches[3];
                $a = "";
                $b = "";
                $c = "";
                $d = "";

            } else {
                preg_match("/A\\.\s+(.*)/", $line, $matches);
                if (!empty($matches)) {
                    //find A
                    if(!empty($a)){
                        echo "Wrong, double a for line ${num}\n";
                    }
                    $a = $matches[1];
                } else {
                    preg_match("/B\\.\s+(.*)/", $line, $matches);
                    if (!empty($matches)) {
                        //find B
                        if(!empty($b)){
                            echo "Wrong, double b for line ${num}\n";
                        }
                        $b = $matches[1];
                    } else {
                        preg_match("/C\\.\s+(.*)/", $line, $matches);
                        if (!empty($matches)) {
                            //find C
                            if(!empty($c)){
                                echo "Wrong, double c for line ${num}\n";
                            }
                            $c = $matches[1];
                        } else {
                            preg_match("/D\\.\s+(.*)/", $line, $matches);
                            if (!empty($matches)) {
                                //find D
                                if(!empty($d)){
                                    echo "Wrong, double d for line ${num}\n";
                                }
                                $d = $matches[1];
                            } else {
                                if (!empty(trim($line))) {
                                    $content = $content ."<br/>". $line;
                                }

                            }

                        }
                    }
                }
            }

            // echo $line;
        }
        insertOneQuestion($dbh, $level, $num, $content, $a, $b, $c, $d);
        fclose($handle);
    } else {
        // error opening the file.
    }

}
$dbh = connectPDO();

truncateQuetion($dbh,"`testing`.`question_option`");
truncateQuetion($dbh,"`testing`.`question`");

import($dbh,$currentDir . "/../../db/e_question.txt", 1);
import($dbh,$currentDir . "/../../db/m_question.txt", 2);
import($dbh,$currentDir . "/../../db/d_question.txt", 3);

//test(null);