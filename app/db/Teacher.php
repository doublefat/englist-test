<?php
$currentDir = dirname(__FILE__);
include_once $currentDir . '/../system/log.php';

class Teacher
{

    protected $TESTING_TEACHERS = "`testing`.`teachers`";


    public function listAll ($dbh)
    {


        $runQuery = "no query yet";
        try {
            $selectColumns = " SELECT ";
            $selectColumns .= "`id` `id`";
            $selectColumns .= ", `amdin_type` `amdin_type`";
            $selectColumns .= ", `first_name` `first_name`";
            $selectColumns .= ", `last_name` `last_name`";
            $selectColumns .= ", `teacher_id` `teacher_id`";
            $selectColumns .= ", `create_time` `create_time`";
            $selectColumns .= ", `update_time` `update_time`";
            $selectColumns .= ", `email` `email`";
            $selectColumns .= ", `extra` `extra`";
            $queryBase = " FROM ";
            $queryBase .= "{$this->TESTING_TEACHERS}";


            $order_clause = "";


            $limit_clause = "";


            $runQuery = $selectColumns . $queryBase . $order_clause . $limit_clause;

            //echo $runQuery."\n";

            $stmt = $dbh->prepare($runQuery);

            $stmt_rv = $stmt->execute();

            if ($stmt_rv) {
                return $stmt->fetchAll();
            } else {
                MLog::e('db error info:' . var_export($stmt->errorInfo(), true) . " query:" . $runQuery);

                return false;
            }
        } catch (PDOException $x) {
            MLog::e('db error info:' . $x->getMessage() . " query:" . $runQuery);

            throw $x;
        }
    }


    public function verifyUser($dbh, $email, $encrypedPassword)
    {


        $runQuery = "no query yet";
        try {
            $selectColumns = " SELECT ";
            $selectColumns .= "`id` `id`";
            $selectColumns .= ", `amdin_type` `amdin_type`";
            $selectColumns .= ", `first_name` `first_name`";
            $selectColumns .= ", `last_name` `last_name`";
            $selectColumns .= ", `teacher_id` `teacher_id`";
            $selectColumns .= ", `create_time` `create_time`";
            $selectColumns .= ", `update_time` `update_time`";
            $selectColumns .= ", `email` `email`";
            $selectColumns .= ", `extra` `extra`";
            $queryBase = " FROM ";
            $queryBase .= "{$this->TESTING_TEACHERS}";
            $queryBase .= " WHERE " . '(`email` = :email) AND (`password` = :encrypedPassword)';


            $order_clause = "";


            $limit_clause = "";


            $runQuery = $selectColumns . $queryBase . $order_clause . $limit_clause;

            //echo $runQuery."\n";

            $stmt = $dbh->prepare($runQuery);

            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':encrypedPassword', $encrypedPassword, PDO::PARAM_STR);
            $stmt_rv = $stmt->execute();

            if ($stmt_rv) {
                return $stmt->fetchAll();
            } else {
                MLog::e('db error info:' . var_export($stmt->errorInfo(), true) . " query:" . $runQuery);

                return false;
            }
        } catch (PDOException $x) {
            MLog::e('db error info:' . $x->getMessage() . " query:" . $runQuery);

            throw $x;
        }
    }

    public function resetPassword($dbh, $id, $update_time, $password)
    {

        $runQuery = "UPDATE  ";


        $runQuery .= "{$this->TESTING_TEACHERS}";


        $setClumns = " SET ";
        $setClumns .= ' `update_time`=';
        $setClumns .= ':update_time';

        $setClumns .= ',`password`=';
        $setClumns .= ':password';

        $runQuery .= $setClumns;
        $runQuery .= " WHERE " . '`id` = :id';

        try {
            $stmt = $dbh->prepare($runQuery);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':update_time', $update_time, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt_r = $stmt->execute();
            if ($stmt_r) {
                return $stmt->rowCount();
            } else {

                MLog::e('db error info:' . var_export($stmt->errorInfo(), true) . " query:" . $runQuery);
                return false;
            }


        } catch (PDOException $x) {
            MLog::e('db error info:' . $x->getMessage() . " query:" . $runQuery);

            throw $x;
        }

    }

    public function resetType($dbh, $id, $amdin_type, $update_time)
    {

        $runQuery = "UPDATE  ";


        $runQuery .= "{$this->TESTING_TEACHERS}";


        $setClumns = " SET ";
        $setClumns .= ' `amdin_type`=';
        $setClumns .= ':amdin_type';

        $setClumns .= ',`update_time`=';
        $setClumns .= ':update_time';

        $runQuery .= $setClumns;
        $runQuery .= " WHERE " . '`id` = :id';

        try {
            $stmt = $dbh->prepare($runQuery);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':amdin_type', $amdin_type, PDO::PARAM_INT);
            $stmt->bindParam(':update_time', $update_time, PDO::PARAM_STR);
            $stmt_r = $stmt->execute();
            if ($stmt_r) {
                return $stmt->rowCount();
            } else {

                MLog::e('db error info:' . var_export($stmt->errorInfo(), true) . " query:" . $runQuery);
                return false;
            }


        } catch (PDOException $x) {
            MLog::e('db error info:' . $x->getMessage() . " query:" . $runQuery);

            throw $x;
        }

    }

    public function updateInfo($dbh, $id, $amdin_type, $first_name, $last_name, $teacher_id, $update_time, $email, $extra)
    {

        $runQuery = "UPDATE  ";


        $runQuery .= "{$this->TESTING_TEACHERS}";


        $setClumns = " SET ";
        $setClumns .= ' `amdin_type`=';
        $setClumns .= ':amdin_type';

        $setClumns .= ',`first_name`=';
        $setClumns .= ':first_name';

        $setClumns .= ',`last_name`=';
        $setClumns .= ':last_name';

        $setClumns .= ',`teacher_id`=';
        $setClumns .= ':teacher_id';

        $setClumns .= ',`update_time`=';
        $setClumns .= ':update_time';

        $setClumns .= ',`email`=';
        $setClumns .= ':email';

        $setClumns .= ',`extra`=';
        $setClumns .= ':extra';

        $runQuery .= $setClumns;
        $runQuery .= " WHERE " . '`id` = :id';

        try {
            $stmt = $dbh->prepare($runQuery);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':amdin_type', $amdin_type, PDO::PARAM_INT);
            $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
            $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
            $stmt->bindParam(':teacher_id', $teacher_id, PDO::PARAM_STR);
            $stmt->bindParam(':update_time', $update_time, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':extra', $extra, PDO::PARAM_STR);
            $stmt_r = $stmt->execute();
            if ($stmt_r) {
                return $stmt->rowCount();
            } else {

                MLog::e('db error info:' . var_export($stmt->errorInfo(), true) . " query:" . $runQuery);
                return false;
            }


        } catch (PDOException $x) {
            MLog::e('db error info:' . $x->getMessage() . " query:" . $runQuery);

            throw $x;
        }

    }

    public function create($dbh, $amdin_type, $first_name, $last_name, $teacher_id, $email, $password, $extra)
    {

        $runQuery = "INSERT INTO  ";


        $runQuery .= "{$this->TESTING_TEACHERS}";


        $columns = "(";
        $values = " values( ";


        $columns .= ' `amdin_type`';
        $values .= ':amdin_type';

        $columns .= ',`first_name`';
        $values .= ',';
        $values .= ':first_name';

        $columns .= ',`last_name`';
        $values .= ',';
        $values .= ':last_name';

        $columns .= ',`teacher_id`';
        $values .= ',';
        $values .= ':teacher_id';

        $columns .= ',`create_time`';
        $values .= ',';
        $values .= 'now()';

        $columns .= ',`update_time`';
        $values .= ',';
        $values .= 'now()';

        $columns .= ',`email`';
        $values .= ',';
        $values .= ':email';

        $columns .= ',`password`';
        $values .= ',';
        $values .= ':password';

        $columns .= ',`extra`';
        $values .= ',';
        $values .= ':extra';

        $columns .= ")";
        $values .= ") ";
        $runQuery .= $columns . $values;


        try {
            $stmt = $dbh->prepare($runQuery);


            $stmt->bindParam(':amdin_type', $amdin_type, PDO::PARAM_INT);
            $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
            $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
            $stmt->bindParam(':teacher_id', $teacher_id, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':extra', $extra, PDO::PARAM_STR);


            $stmt_r = $stmt->execute();
            if ($stmt_r) {
                return $dbh->lastInsertId();

            } else {

                MLog::e('db error info:' . var_export($stmt->errorInfo(), true) . " query:" . $runQuery);
                return false;
            }

        } catch (PDOException $x) {
            MLog::e('db error info:' . $x->getMessage() . " query:" . $runQuery);
            throw $x;
        }

    }

}
