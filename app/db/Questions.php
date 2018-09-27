<?php
$currentDir = dirname(__FILE__);
include_once $currentDir . '/../system/log.php';

class Questions
{

    protected $TESTING_QUESTION = "`testing`.`question`";
    protected $TESTING_QUESTION_OPTION = "`testing`.`question_option`";


    public function loadOneQuestion($dbh, $qid){


        $runQuery="no query yet";
        try {
            $selectColumns =" SELECT ";
            $selectColumns .="`id` `id`";
            $selectColumns .=", `type` `type`";
            $selectColumns .=", `associate_id` `associate_id`";
            $selectColumns .=", `level` `level`";
            $selectColumns .=", `disable` `disable`";
            $selectColumns .=", `detail` `detail`";
            $selectColumns .=", `extra` `extra`";
            $selectColumns .=", `create_time` `create_time`";
            $selectColumns .=", `update_time` `update_time`";
            $queryBase=" FROM ";
            $queryBase.="{$this->TESTING_QUESTION}";
            $queryBase.=" WHERE " .'`id` = :qid';



            $order_clause="";


            $limit_clause="";






            $runQuery=$selectColumns . $queryBase . $order_clause . $limit_clause;

            //echo $runQuery."\n";

            $stmt = $dbh->prepare($runQuery);

            $stmt->bindParam(':qid',$qid,PDO::PARAM_INT);
            $stmt_rv = $stmt->execute();

            if ($stmt_rv) {
                $re=$stmt->fetchAll();
                if(isset($re[0])){
                    return $re[0];
                }
                else {
                    return null;
                }
            }
            else {
                //$errorMessage='db error info:' . var_export($stmt->errorInfo(), true)." query:".$runQuery;

                return false;
            }
        }
        catch ( PDOException $x ) {
            //$errorMessage='db error info:' . $x->getMessage()." query:".$runQuery;

            throw $x;
        }
    }


    public function loadOneQuestionWithOptions($dbh, $questionId)
    {

        $question=$this->loadOneQuestion($dbh,$questionId);
        if(!empty($question)){
            $options=$this->loadOptionsByQuestionIds($dbh,array($question["id"]));
            return array("question"=>$question,"options"=>$options);
        }
        else{
            return array();
        }
    }


    private function _addQuestion($dbh, $type, $disable, $associate_id, $level, $detail, $extra){


        $runQuery="INSERT INTO  ";



        $runQuery.="{$this->TESTING_QUESTION}";



        $columns = "(";
        $values = " values( ";


        $columns .=' `type`';
        $values .=':type';

        $columns .=',`disable`';
        $values .=',';$values .=':disable';

        $columns .=',`associate_id`';
        $values .=',';$values .=':associate_id';

        $columns .=',`level`';
        $values .=',';$values .=':level';

        $columns .=',`detail`';
        $values .=',';$values .=':detail';

        $columns .=',`extra`';
        $values .=',';$values .=':extra';

        $columns .=',`create_time`';
        $values .=',';$values .='now()';

        $columns .=',`update_time`';
        $values .=',';$values .='now()';

        $columns .= ")";
        $values .= ") ";
        $runQuery.=$columns.$values;






        try {
            $stmt = $dbh->prepare($runQuery);


            $stmt->bindParam(':type',$type,PDO::PARAM_INT);
            $stmt->bindParam(':disable',$disable,PDO::PARAM_INT);
            $stmt->bindParam(':associate_id',$associate_id,PDO::PARAM_INT);
            $stmt->bindParam(':level',$level,PDO::PARAM_INT);
            $stmt->bindParam(':detail',$detail,PDO::PARAM_STR);
            $stmt->bindParam(':extra',$extra,PDO::PARAM_STR);


            $stmt_r = $stmt->execute();
            if($stmt_r){
                return $dbh->lastInsertId ();

            }
            else {

                MLog::e('db error info:' . var_export($stmt->errorInfo(), true)." query:".$runQuery);
                return false;
            }

        }
        catch ( PDOException $x ) {
            MLog::e('db error info:' . $x->getMessage()." query:".$runQuery);
            throw $x;
        }

    }


    private function _addQuestionOption($dbh, $testing_question_option_question_id, $testing_question_option_content, $testing_question_option_is_right)
    {

        $runQuery = "INSERT INTO  ";


        $runQuery .= "{$this->TESTING_QUESTION_OPTION} ";


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


            throw $x;
        }

    }


    public function addQuestion($dbh, $testing_question_type,
                                $testing_question_disable,
                                $testing_question_associate_id,
                                $testing_question_level,
                                $testing_question_detail,
                                $testing_question_extra,
                                $options)
    {


        try {

            $dbh->beginTransaction();

            $qId = $this->_addQuestion($dbh, $testing_question_type,
                $testing_question_disable,
                $testing_question_associate_id,
                $testing_question_level,
                $testing_question_detail,
                $testing_question_extra);
            if (!empty($qId)) {
                foreach ($options as $oneOption) {
                    $content = $oneOption['content'];
                    $isRight = $oneOption['is_right'];
                    $re = $this->_addQuestionOption($dbh, $qId, $content, $isRight);
                    if (empty($re)) {
                        $dbh->rollBack();
                        return false;
                    }

                }
                $dbh->commit();
                return true;
            } else {
                $dbh->rollBack();
                return false;
            }


        } catch (Exception $x) {

            $dbh->rollBack();

            throw $x;
        }
    }



    public function listQuestions($dbh,$pageNo,$pageSize, $disable=null){


        $runQuery="no query yet";
        try {
            $selectColumns =" SELECT ";
            $selectColumns .="`id` `id`";
            $selectColumns .=", `type` `type`";
            $selectColumns .=", `disable` `disable`";
            $selectColumns .=", `associate_id` `associate_id`";
            $selectColumns .=", `level` `level`";
            $selectColumns .=", `detail` `detail`";
            $selectColumns .=", `extra` `extra`";
            $selectColumns .=", `create_time` `create_time`";
            $selectColumns .=", `update_time` `update_time`";
            $queryBase=" FROM ";
            $queryBase.="{$this->TESTING_QUESTION}";
            if(isset($disable)){
                $queryBase.=" WHERE " .'`disable` = :disable';
            }




            $order_clause="";

            $order_clause .=" ORDER BY ";
            $order_clause.="`id`";

            $limit_clause="";





            $runQuery="SELECT count(*) total ".$queryBase;
            $stmt = $dbh->prepare($runQuery);

            if(isset($disable)) {
                $stmt->bindParam(':disable', $disable, PDO::PARAM_INT);
            }
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
                $pageInfo=array('total' => $total, 'total_pages' => $totalPage,'page_size' => $pageSize);
                if($pageNo<1){
                    $pageNo=1;
                }
                $pageInfo['page_no']=$pageNo;

                $pageNo--;
                if($pageNo*$pageSize>$total){
                    $re['data']=array();
                }
                else{
                    $from=$pageNo*$pageSize;
                    $runQuery=$selectColumns. $queryBase.$order_clause." limit {$from},{$pageSize}";
                    $stmt2= $dbh->prepare($runQuery);


                    if(isset($disable)) {
                        $stmt2->bindParam(':disable', $disable, PDO::PARAM_INT);
                    }
                    $stmt_rv2 = $stmt2->execute();
                    if($stmt_rv2){
                        $re['data']=$stmt2->fetchAll();
                        $pageInfo['fetch_count']=$stmt2->rowCount();
                        $re['page_info']=$pageInfo;
                    }
                    else{
                        MLog::e('db error info:' . var_export($stmt->errorInfo(), true)." query:".$runQuery);
                        $re['data']=false;
                    }
                }
                return $re;
            }
            else {
                MLog::e('db error info:' . var_export($stmt->errorInfo(), true)." query:".$runQuery);
                return false;
            }
        }
        catch ( PDOException $x ) {
            MLog::e('db error info:' . $x->getMessage()." query:".$runQuery);

            throw $x;
        }
    }


    public function loadOptionsByQuestionIds($dbh, $questionIds)
    {


        $runQuery = "no query yet";
        try {
            $selectColumns = " SELECT ";
            $selectColumns .= "`id` `id`";
            $selectColumns .= ", `question_id` `question_id`";
            $selectColumns .= ", `content` `content`";
            $selectColumns .= ", `is_right` `is_right`";
            $queryBase = " FROM ";
            $queryBase .= "{$this->TESTING_QUESTION_OPTION}";
            $queryBase .= " WHERE " . '`question_id` IN ( ' . implode(',', $questionIds) . ')';


            $order_clause = "";

            $order_clause .= " ORDER BY ";
            $order_clause .= "`id`";

            $limit_clause = "";


            $runQuery = $selectColumns . $queryBase . $order_clause . $limit_clause;

            //echo $runQuery."\n";

            $stmt = $dbh->prepare($runQuery);

            $stmt_rv = $stmt->execute();

            if ($stmt_rv) {
                return $stmt->fetchAll();
            } else {
                //$errorMessage='db error info:' . var_export($stmt->errorInfo(), true)." query:".$runQuery;

                return false;
            }
        } catch (PDOException $x) {
            //$errorMessage='db error info:' . $x->getMessage()." query:".$runQuery;

            throw $x;
        }
    }



    public function updateQuestion($dbh, $qid, $type, $associate_id, $level, $detail, $extra){

        $runQuery="UPDATE  ";



        $runQuery.="{$this->TESTING_QUESTION}";


        $setClumns = " SET ";
        $setClumns .=' `type`=';$setClumns .=':type';

        $setClumns .=',`associate_id`=';$setClumns .=':associate_id';

        $setClumns .=',`level`=';$setClumns .=':level';

        $setClumns .=',`detail`=';$setClumns .=':detail';

        $setClumns .=',`extra`=';$setClumns .=':extra';

        $setClumns .=',`update_time`=';$setClumns .='now';

        $runQuery.=$setClumns;$runQuery.=" WHERE " .'`id` = :qid';

        try {
            $stmt = $dbh->prepare($runQuery);

            $stmt->bindParam(':qid',$qid,PDO::PARAM_INT);
            $stmt->bindParam(':type',$type,PDO::PARAM_INT);
            $stmt->bindParam(':associate_id',$associate_id,PDO::PARAM_INT);
            $stmt->bindParam(':level',$level,PDO::PARAM_INT);
            $stmt->bindParam(':detail',$detail,PDO::PARAM_STR);
            $stmt->bindParam(':extra',$extra,PDO::PARAM_STR);
            $stmt_r = $stmt->execute();
            if($stmt_r){
                return $stmt->rowCount();
            }
            else {

                MLog::e('db error info:' . var_export($stmt->errorInfo(), true)." query:".$runQuery);
                return false;
            }




        }
        catch ( PDOException $x ) {
            MLog::e('db error info:' . $x->getMessage()." query:".$runQuery);

            throw $x;
        }

    }

    public function deleteOptionsByQuestionId($dbh, $qid){

        $runQuery="DELETE FROM  ";


        $runQuery.="{$this->TESTING_QUESTION_OPTION}";


        $runQuery.=" WHERE " .'`question_id` = :qid';







        try {

            $stmt = $dbh->prepare($runQuery);


            $stmt->bindParam(':qid',$qid,PDO::PARAM_INT);

            $stmt_r = $stmt->execute();
            if($stmt_r){
                return $stmt->rowCount();
            }
            else {

                MLog::e('db error info:' . var_export($stmt->errorInfo(), true)." query:".$runQuery);
                return false;
            }

        }
        catch ( PDOException $x ) {
            MLog::e('db error info:' . $x->getMessage()." query:".$runQuery);
            throw $x;
        }

    }

    public function insertOptions($dbh, $id, $question_id, $content, $is_right){

        $runQuery="INSERT INTO  ";



        $runQuery.="{$this->TESTING_QUESTION_OPTION}";



        $columns = "(";
        $values = " values( ";


        $columns .=' `id`';
        $values .=':id';

        $columns .=',`question_id`';
        $values .=',';$values .=':question_id';

        $columns .=',`content`';
        $values .=',';$values .=':content';

        $columns .=',`is_right`';
        $values .=',';$values .=':is_right';

        $columns .= ")";
        $values .= ") ";
        $runQuery.=$columns.$values;






        try {
            $stmt = $dbh->prepare($runQuery);


            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->bindParam(':question_id',$question_id,PDO::PARAM_INT);
            $stmt->bindParam(':content',$content,PDO::PARAM_STR);
            $stmt->bindParam(':is_right',$is_right,PDO::PARAM_INT);


            $stmt_r = $stmt->execute();
            if($stmt_r){
                return $stmt->rowCount();

            }
            else {

                MLog::e('db error info:' . var_export($stmt->errorInfo(), true)." query:".$runQuery);
                return false;
            }

        }
        catch ( PDOException $x ) {
            MLog::e('db error info:' . $x->getMessage()." query:".$runQuery);
            throw $x;
        }

    }


    public function updateQuestionStatus($dbh, $pid, $disable){

        $runQuery="UPDATE  ";

        $runQuery.="{$this->TESTING_QUESTION}";


        $setClumns = " SET ";
        $setClumns .=' `disable`=';$setClumns .=':disable';

        $setClumns .=',`update_time`=';$setClumns .='now()';

        $runQuery.=$setClumns;$runQuery.=" WHERE " .'`id` = :pid';

        try {
            $stmt = $dbh->prepare($runQuery);

            $stmt->bindParam(':pid',$pid,PDO::PARAM_INT);
            $stmt->bindParam(':disable',$disable,PDO::PARAM_INT);
            $stmt_r = $stmt->execute();
            if($stmt_r){
                return $stmt->rowCount();
            }
            else {

                MLog::e('db error info:' . var_export($stmt->errorInfo(), true)." query:".$runQuery);
                return false;
            }




        }
        catch ( PDOException $x ) {
            MLog::e('db error info:' . $x->getMessage()." query:".$runQuery);

            throw $x;
        }

    }

    public function  updateWholeQuestion($dbh,$qid,$type,$associateId,$level,$questionDetail,$options){




        try{
            $dbh->beginTransaction();
            if($this->updateQuestion($dbh,$qid,$type,$associateId,$level,$questionDetail,"")===false){
                throw new Exception("Fail to update question" );
            }

            $this->deleteOptionsByQuestionId($dbh,$qid);

            foreach ($options as $option){
               $this->insertOptions($dbh,$option['id'],$qid,$option['content'],$option['is_right']);
            }


            $dbh->commit();
        }
        catch (Exception $e){

            $dbh->rollBack();
        }
    }


    public function statusChange(){

    }
}

?>