<?php

class StudentExame
{

    protected $TESTING_STUDENT_SESSION_ANSWER = "`testing`.`student_session_answer`";

    protected $TESTING_TEST_REPORT = "`testing`.`test_report`";

    public function saveOneQuestionRecord($dbh, $section_id, $student_id, $question_id, $is_correct, $student_answer, $extra)
    {

        $runQuery = "INSERT INTO  ";


        $runQuery .= "{$this->TESTING_STUDENT_SESSION_ANSWER}";


        $columns = "(";
        $values = " values( ";


        $columns .= ' `section_id`';
        $values .= ':section_id';

        $columns .= ',`student_id`';
        $values .= ',';
        $values .= ':student_id';

        $columns .= ',`question_id`';
        $values .= ',';
        $values .= ':question_id';

        $columns .= ',`is_correct`';
        $values .= ',';
        $values .= ':is_correct';

        $columns .= ',`student_answer`';
        $values .= ',';
        $values .= ':student_answer';

        $columns .= ',`create_time`';
        $values .= ',';
        $values .= 'now()';

        $columns .= ',`extra`';
        $values .= ',';
        $values .= ':extra';

        $columns .= ")";
        $values .= ") ";
        $runQuery .= $columns . $values;


        try {
            $stmt = $dbh->prepare($runQuery);


            $stmt->bindParam(':section_id', $section_id, PDO::PARAM_INT);
            $stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
            $stmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
            $stmt->bindParam(':is_correct', $is_correct, PDO::PARAM_INT);
            $stmt->bindParam(':student_answer', $student_answer, PDO::PARAM_STR);
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

    public function addStudentScore($dbh, $session_id, $student_id, $score, $extra)
    {

        $runQuery = "INSERT INTO  ";


        $runQuery .= "{$this->TESTING_TEST_REPORT}";


        $columns = "(";
        $values = " values( ";


        $columns .= ' `session_id`';
        $values .= ':session_id';

        $columns .= ',`student_id`';
        $values .= ',';
        $values .= ':student_id';

        $columns .= ',`score`';
        $values .= ',';
        $values .= ':score';

        $columns .= ',`extra`';
        $values .= ',';
        $values .= ':extra';

        $columns .= ',`create_time`';
        $values .= ',';
        $values .= 'now()';

        $columns .= ")";
        $values .= ") ";
        $runQuery .= $columns . $values;


        try {
            $stmt = $dbh->prepare($runQuery);


            $stmt->bindParam(':session_id', $session_id, PDO::PARAM_INT);
            $stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
            $stmt->bindParam(':score', $score, PDO::PARAM_STR);
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

    public function listStudentScoreByTimeRange($dbh, $sessionId, $startTime, $endTime, $pageNo, $pageSize)
    {


        $runQuery = "no query yet";
        try {
            $selectColumns = " SELECT ";
            $selectColumns .= "`id` `id`";
            $selectColumns .= ", `session_id` `session_id`";
            $selectColumns .= ", `student_id` `student_id`";
            $selectColumns .= ", `score` `score`";
            $selectColumns .= ", `extra` `extra`";
            $selectColumns .= ", `create_time` `create_time`";
            $queryBase = " FROM ";
            $queryBase .= "{$this->TESTING_TEST_REPORT}";
            $queryBase .= " WHERE " . '(`session_id` = :sessionId) AND ((`create_time` >= :startTime) AND (`create_time` < :endTime))';


            $order_clause = "";


            $limit_clause = "";


            $runQuery = "SELECT count(*) total " . $queryBase;
            $stmt = $dbh->prepare($runQuery);


            $stmt->bindParam(':sessionId', $sessionId, PDO::PARAM_INT);
            $stmt->bindParam(':startTime', $startTime, PDO::PARAM_STR);
            $stmt->bindParam(':endTime', $endTime, PDO::PARAM_STR);

            $stmt_rv = $stmt->execute();

            if ($stmt_rv) {

                $total = intval($stmt->fetchColumn());

                $stmt->closeCursor();

                if ($pageSize <= 0) {
                    $pageSize = 10;
                }

                if ($total === 0) {
                    $totalPage = 0;
                } else {
                    $totalPage = intval($total / $pageSize);

                    if ($total % $pageSize !== 0) {
                        $totalPage++;
                    }
                }

                $re = array();
                $pageInfo = array('total' => $total, 'total_pages' => $totalPage, 'page_size' => $pageSize);
                if ($pageNo < 1) {
                    $pageNo = 1;
                }
                $pageInfo['page_no'] = $pageNo;

                $pageNo--;
                if ($pageNo * $pageSize > $total) {
                    $re['data'] = array();
                } else {
                    $from = $pageNo * $pageSize;
                    $runQuery = $selectColumns . $queryBase . $order_clause . " limit {$from},{$pageSize}";
                    $stmt2 = $dbh->prepare($runQuery);


                    $stmt2->bindParam(':sessionId', $sessionId, PDO::PARAM_INT);
                    $stmt2->bindParam(':startTime', $startTime, PDO::PARAM_STR);
                    $stmt2->bindParam(':endTime', $endTime, PDO::PARAM_STR);
                    $stmt_rv2 = $stmt2->execute();
                    if ($stmt_rv2) {
                        $re['data'] = $stmt2->fetchAll();
                        $pageInfo['fetch_count'] = $stmt2->rowCount();
                        $re['page_info'] = $pageInfo;
                    } else {
                        MLog::e('db error info:' . var_export($stmt->errorInfo(), true) . " query:" . $runQuery);
                        $re['data'] = false;
                    }
                }
                return $re;
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
