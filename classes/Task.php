<?php

/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 2/8/2016
 * Time: 2:38 PM
 */
class Task
{
    //Main Task
    private $db, $task_id, $number, $question, $description, $maxTimeout, $targetID, $evaluation_id;

    //Eval Task
    private $startTime, $endTime, $totalTime, $shortestDistance, $travelledDistance, $seqScore, $completed, $errorCount, $wrongClicks;

    /**
     * Task constructor.
     * @param $number
     * @param $evaluation_id
     * @throws Exception
     */
    public function __construct($number, $evaluation_id = null)
    {

        $this->db = DB::getInstance();
        $this->number = $number;

        $sql = "SELECT task_id, question, description, max_timeout, target_id FROM task WHERE task_number=?";
        $params = [$number];
        $pdo = $this->db->query($sql, $params);

        if($pdo->count() == 1 && !$pdo->error()){

            $this->task_id = $pdo->result()[0]->task_id;
            $this->question = $pdo->result()[0]->question;
            $this->description = $pdo->result()[0]->description;
            $this->maxTimeout = $pdo->result()[0]->max_timeout;
            $this->targetID = $pdo->result()[0]->target_id;

            if(!is_null($evaluation_id)){

               // $this->startTime = microtime(true);

               // echo $this->startTime."<br>";
                $this->evaluation_id = $evaluation_id;
                $sql = "INSERT INTO evaluation_task (task_id, evaluation_id) VALUES (?,?)";
                $params = [$this->task_id, $this->evaluation_id];
                $result = $this->db->query($sql, $params);

                if($result->error()){

                    throw new Exception("Error adding new Evaluation Task");

                }
            }

        }
    }

    /**
     * @return mixed
     */
    public function getTaskId()
    {
        return $this->task_id;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getMaxTimeout()
    {
        return $this->maxTimeout;
    }

    /**
     * @return mixed
     */
    public function getTargetID()
    {
        return $this->targetID;
    }

    /**
     * @return null
     */
    public function getEvaluationId()
    {
        return $this->evaluation_id;
    }

    /**
     * @param null $evaluation_id
     */
    public function setEvaluationId($evaluation_id)
    {
        $this->evaluation_id = $evaluation_id;
    }

    /**
     * @return bool|string
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param bool|string $startTime
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param mixed $endTime
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        $sql = "UPDATE evaluation_task SET end_time='{$this->endTime}' WHERE task_id=? AND evaluation_id=?";
        $params = [$this->task_id, $this->evaluation_id];
        $result = $this->db->query($sql, $params);

        if($result->error()){
            throw new Exception("Error updating end time in Eval_Task");
        }
        else{
            $this->setTotalTime();
        }
    }

    /**
     * @return mixed
     */
    public function getShortestDistance()
    {
        return $this->shortestDistance;
    }

    /**
     * @param mixed $shortestDistance
     */
    public function setShortestDistance($shortestDistance)
    {
        $this->shortestDistance = $shortestDistance;

        $sql = "UPDATE evaluation_task SET shortest_distance='$shortestDistance' WHERE task_id=? AND evaluation_id=?";
        $params = [$this->task_id, $this->evaluation_id];
        $result = $this->db->query($sql, $params);

        if($result->error()){
            throw new Exception("Error updating shortest distance in Eval_Task");
        }
    }

    /**
     * @return mixed
     */
    public function getTravelledDistance()
    {
        return $this->travelledDistance;
    }

    /**
     * @param mixed $travelledDistance
     */
    public function setTravelledDistance($travelledDistance)
    {
        $this->travelledDistance = $travelledDistance;

        $sql = "UPDATE evaluation_task SET shortest_distance='$travelledDistance' WHERE task_id=? AND evaluation_id=?";
        $params = [$this->task_id, $this->evaluation_id];
        $result = $this->db->query($sql, $params);

        if($result->error()){
            throw new Exception("Error updating travelled distance in Eval_Task");
        } else{
            $this->setErrorCount();
        }
    }

    /**
     * @return mixed
     */
    public function getSeqScore()
    {
        return $this->seqScore;
    }

    /**
     * @param mixed $seqScore
     */
    public function setSeqScore($seqScore)
    {
        $this->seqScore = $seqScore;
        $sql = "UPDATE evaluation_task SET seq_score'$seqScore' WHERE task_id=? AND evaluation_id=?";
        $params = [$this->task_id, $this->evaluation_id];
        $result = $this->db->query($sql, $params);

        if($result->error()){
            throw new Exception("Error updating SEQ in Eval_Task");
        }
    }

    /**
     * @return mixed
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * @param mixed $completed
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;

        $sql = "UPDATE evaluation_task SET completed='$completed' WHERE task_id=? AND evaluation_id=?";
        $params = [$this->task_id, $this->evaluation_id];
        $result = $this->db->query($sql, $params);

        if($result->error()){
            throw new Exception("Error updating completed in Eval_Task");
        }
    }

    public function setWrongClicks($count)
    {
        $this->wrongClicks = $count;

        $sql = "UPDATE evaluation_task SET wrong_clicks='$count' WHERE task_id=? AND evaluation_id=?";
        $params = [$this->task_id, $this->evaluation_id];
        $result = $this->db->query($sql, $params);

        if($result->error()){
            throw new Exception("Error updating clicks in Eval_Task");
        }
        else{
            $this->setErrorCount();
        }
    }

    public function getWrongClicks(){

        return $this->wrongClicks;
    }

    public function getTotalTime(){

       return $this->totalTime;
    }

    private function setTotalTime(){

        if(isset($this->endTime) && isset($this->startTime)){

            $this->totalTime =  ($this->endTime - $this->startTime) * 1000;

            $sql = "UPDATE evaluation_task SET total_time='{$this->totalTime}' WHERE task_id=? AND evaluation_id=?";
            $params = [$this->task_id, $this->evaluation_id];
            $result = $this->db->query($sql, $params);

            if($result->error()){
                throw new Exception("Error updating total time in Eval_Task");
            }else{
                return true;
            }

        }


    }

    public function getErrorCount(){
        return $this->errorCount;
    }

    private function setErrorCount(){
        if(isset($this->travelledDistance) && isset($this->shortestDistance) && isset($this->wrongClicks)){

            $this->errorCount = ((int) (($this->travelledDistance - $this->shortestDistance) - 1) + $this->wrongClicks);
        }
    }

}