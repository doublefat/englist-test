<?php
$currentDir = dirname(__FILE__);
include_once $currentDir . '/../system/log.php';
class Questions
{

    protected $TESTING_QUESTION = "`testing`.`question`";
    protected $TESTING_QUESTION_OPTION = "`testing`.`question_option`";


    public function loadOneQuestion($dbh, $questionId)
    {


        $runQuery = "no query yet";
        try {
            $selectColumns = " SELECT ";
            $selectColumns .= "`testing_question`.`id` `testing_question_id`";
            $selectColumns .= ", `testing_question`.`type` `testing_question_type`";
            $selectColumns .= ", `testing_question`.`associate_id` `testing_question_associate_id`";
            $selectColumns .= ", `testing_question`.`level` `testing_question_level`";
            $selectColumns .= ", `testing_question`.`detail` `testing_question_detail`";
            $selectColumns .= ", `testing_question`.`extra` `testing_question_extra`";
            $selectColumns .= ", `testing_question`.`create_time` `testing_question_create_time`";
            $selectColumns .= ", `testing_question`.`update_time` `testing_question_update_time`";
            $selectColumns .= ", `testing_question_option`.`id` `testing_question_option_id`";
            $selectColumns .= ", `testing_question_option`.`content` `testing_question_option_content`";
            $selectColumns .= ", `testing_question_option`.`is_right` `testing_question_option_is_right`";
            $queryBase = " FROM ";
            $queryBase .= "{$this->TESTING_QUESTION} as `testing_question` ";
            $queryBase .= "INNER JOIN {$this->TESTING_QUESTION_OPTION} as `testing_question_option` ";
            $queryBase .= " on " . '`testing_question`.`id` = `testing_question_option`.`question_id`';
            $queryBase .= " WHERE " . '`testing_question`.`id` = :questionId';


            $order_clause = "";


            $limit_clause = "";


            $runQuery = $selectColumns . $queryBase . $order_clause . $limit_clause;

            //echo $runQuery."\n";

            $stmt = $dbh->prepare($runQuery);

            $stmt->bindParam(':questionId', $questionId, PDO::PARAM_INT);
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


    private function _addQuestion($dbh, $testing_question_type, $testing_question_associate_id, $testing_question_level, $testing_question_detail, $testing_question_extra)
    {

        $runQuery = "INSERT INTO  ";

        $runQuery .= "{$this->TESTING_QUESTION} as testing_question";

        $columns = "(";
        $values = " values( ";


        $columns .= ' `type`';
        $values .= ':testing_question_type';

        $columns .= ',`associate_id`';
        $values .= ',';
        $values .= ':testing_question_associate_id';

        $columns .= ',`level`';
        $values .= ',';
        $values .= ':testing_question_level';

        $columns .= ',`detail`';
        $values .= ',';
        $values .= ':testing_question_detail';

        $columns .= ',`extra`';
        $values .= ',';
        $values .= ':testing_question_extra';

        $columns .= ',`create_time`';
        $values .= ',';
        $values .= 'now()';

        $columns .= ',`update_time`';
        $values .= ',';
        $values .= 'now()';

        $columns .= ")";
        $values .= ") ";
        $runQuery .= $columns . $values;


        try {
            $stmt = $dbh->prepare($runQuery);


            $stmt->bindParam(':testing_question_type', $testing_question_type, PDO::PARAM_INT);
            $stmt->bindParam(':testing_question_associate_id', $testing_question_associate_id, PDO::PARAM_INT);
            $stmt->bindParam(':testing_question_level', $testing_question_level, PDO::PARAM_INT);
            $stmt->bindParam(':testing_question_detail', $testing_question_detail, PDO::PARAM_STR);
            $stmt->bindParam(':testing_question_extra', $testing_question_extra, PDO::PARAM_INT);


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


    private function _addQuestionOption($dbh, $testing_question_option_question_id, $testing_question_option_content, $testing_question_option_is_right)
    {

        $runQuery = "INSERT INTO  ";


        $runQuery .= "{$this->TESTING_QUESTION_OPTION} as testing_question_option";


        $columns = "(";
        $values = " values( ";


        $columns .= ' `question_id`';
        $values .= ':testing_question_option_question_id';

        $columns .= ',`content`';
        $values .= ',';
        $values .= ':testing_question_option_content';

        $columns .= ',`is_right`';
        $values .= ',';
        $values .= ':testing_question_option_is_right';

        $columns .= ")";
        $values .= ") ";
        $runQuery .= $columns . $values;


        try {
            $stmt = $dbh->prepare($runQuery);
            $dbh->beginTransaction();
            $errorFlag = false;


            $stmt->bindParam(':testing_question_option_question_id', $testing_question_option_question_id, PDO::PARAM_INT);
            $stmt->bindParam(':testing_question_option_content', $testing_question_option_content, PDO::PARAM_STR);
            $stmt->bindParam(':testing_question_option_is_right', $testing_question_option_is_right, PDO::PARAM_INT);


            $stmt_r = $stmt->execute();
            if ($stmt_r) {
                return $dbh->lastInsertId();

            } else {

                MLog::e('db error info:' . var_export($stmt->errorInfo(), true) . " query:" . $runQuery);
                return false;
            }

        } catch (PDOException $x) {
            MLog::e('db error info:' . $x->getMessage() . " query:" . $runQuery);
            $dbh->rollBack();

            throw $x;
        }

    }


    public function addQuestion($dbh, $testing_question_type,
                                $testing_question_associate_id,
                                $testing_question_level,
                                $testing_question_detail,
                                $testing_question_extra,
                                $options)
    {

        try {

            $dbh->beginTransaction();

            $qId=$this->_addQuestion($dbh,$testing_question_type,
                                $testing_question_associate_id,
                                $testing_question_level,
                                $testing_question_detail,
                                $testing_question_extra);
            foreach ($options as $oneOption){
                $content=$oneOption['content'];
                $isRight=$oneOption['is_right'];
                $this->_addQuestionOption($dbh,$qId,$content,$isRight);
            }


        } catch (Exception $x) {

            $dbh->rollBack();

            throw $x;
        }
    }

}

?>