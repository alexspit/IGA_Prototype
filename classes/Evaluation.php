<?php

/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 2/8/2016
 * Time: 3:55 PM
 */


class Evaluation
{

    const ORIGINAL = 'original';
    const EVOLVED = 'evolved';

    private $db, $evaluation_id, $type, $user, $sessionStart, $sessionEnd, $susScore, $chromosome, $tasks;

    /**
     * Evaluation constructor.
     * @param $user_id
     * @param $type
     */
    public function __construct($user_id = null, $type = null)
    {
        $this->db = DB::getInstance();
        $this->tasks = [];

        if(!is_null($user_id)){

            $sql = "SELECT e.evaluation_id, e.eval_type, e.session_start, e.session_end, e.sus_score, e.chromosome FROM evaluation e
                    INNER JOIN user u ON (u.user_id = e.user_id) WHERE e.user_id=? AND e.eval_type =?";
            $param = [$user_id, $type];

            $pdo = $this->db->query($sql, $param);

            if($pdo->count() > 0){

                $this->evaluation_id = $pdo->result()[0]->evaluation_id;
                $this->type = $pdo->result()[0]->eval_type;
                $this->sessionStart = $pdo->result()[0]->session_start;
                $this->sessionEnd = $pdo->result()[0]->session_end;
                $this->susScore = $pdo->result()[0]->sus_score;
                $this->chromosome = $pdo->result()[0]->chromosome;

                $this->user = new User();
                $this->user->get($user_id);


                $sql = "SELECT t.task_id FROM evaluation e INNER JOIN user u ON (u.user_id = e.user_id) INNER JOIN evaluation_task et ON (e.evaluation_id = et.evaluation_id) INNER JOIN task t ON (t.task_id = et.task_id) WHERE e.user_id=? AND e.eval_type=? ";
                $param = [$user_id, $type];

                $pdo = $this->db->query($sql, $param);

                if($pdo->count() > 0){

                    foreach ($pdo->result() as $task) {
                        $this->addTask($task->task_id);
                    }

                }

            }

        }


    }

    public function init(User $user, $type = self::ORIGINAL)
    {

        //TODO: Check if session is finished and that original is set (for evolved)

        if($type == self::EVOLVED){

            $sql = 'SELECT sc.chromosome FROM section sc INNER JOIN session s ON (s.session_id = sc.session_id) INNER JOIN user u ON (u.user_id = s.user_id) WHERE u.user_id=? ORDER BY sc.section ASC';
            $params = [$user->getUserId()];
            $pdo = $this->db->query($sql, $params);

            if($pdo->count() == 3){
                $chromosomeSection = [];
                foreach ($pdo->result() as $c) {
                    $chromosomeSection[] = $c->chromosome;
                }
                $this->chromosome = implode(",", $chromosomeSection);
            }
            else{
                $this->chromosome = null;
            }
        }

        $this->sessionStart = date("Y-m-d H:i:s", time());

        $sql = "INSERT INTO evaluation (user_id, eval_type, session_start, chromosome) VALUES (?,?,?,?)";
        $params = [$user->getUserId(), $type, $this->sessionStart, $this->chromosome];

        $result = $this->db->query($sql, $params);

        if ($result->error()) {

            throw new Exception("Error adding new Eval Session");

        } else {

            $this->evaluation_id = $result->last_inserted_id;
            $this->type = $type;
            $this->user = $user;

            for($i = 1; $i <= $this->getTaskCount(); $i++){
                $this->saveTask($i);
            }

            return true;
        }

    }

    public function saveTask($number){

        if($number >= 1 && $number <= $this->getTaskCount()){

            $sql = 'SELECT et.task_id FROM evaluation_task et INNER JOIN evaluation e ON (e.evaluation_id = et.evaluation_id) INNER JOIN user u ON (u.user_id = e.user_id) INNER JOIN task t ON (t.task_id = et.task_id) WHERE u.user_id = ? AND t.task_number = ? AND e.eval_type = ? ';
            $params = [$this->user->getUserId(), $number, $this->type];
            $pdo = $this->db->query($sql, $params);

            if($pdo->count() == 0){
                $this->tasks[$number] = new Task($number, $this->evaluation_id);
            }else{
                throw new Exception("Task Already Exists");
            }
        }
        else{
            throw new Exception("Invalid Task Number");
        }
    }

    public function getTaskCount(){

        $sql = 'SELECT COUNT(task_id) as task_count FROM task';
        $params = [];
        $pdo = $this->db->query($sql, $params);

        if($pdo->count() > 0){
            return $pdo->result()[0]->task_count;
        }
    }

    public function addTask($number){

        $this->tasks[$number] = new Task($number);

    }

    public function getTask($number){

        return $this->tasks[$number];
    }

    public function getEvaluationID(){
        return $this->evaluation_id;
    }

    public function getType(){
        return $this->type;
    }

    private function getChromosome(){
        $sql = 'SELECT chromosome FROM evaluation WHERE evaluation_id=?';
        $params = [$this->evaluation_id];
        $pdo = $this->db->query($sql, $params);

        if($pdo->count() > 0){
            return explode(",", $pdo->result()[0]->chromosome);
        }
    }

    public function setSessionEnd(){

        $this->sessionEnd = date("Y-m-d H:i:s", time());

        $sql = "UPDATE evaluation SET session_end='$this->sessionEnd' WHERE user_id=? AND evaluation_id=?";

        $params = [$this->user->getUserId(), $this->evaluation_id];
        $result = $this->db->query($sql, $params);

        if($result->error()){
            throw new Exception("Error updating session end time in evaluation");
        }
        else{
            return true;
        }

    }


    public function setSusScore($score){

        $this->sessionEnd = date("Y-m-d H:i:s", time());
        $this->susScore = $score;

        $sql = "UPDATE evaluation SET session_end='$this->sessionEnd', sus_score='$this->susScore' WHERE user_id=? AND evaluation_id=?";

        $params = [$this->user->getUserId(), $this->evaluation_id];
        $result = $this->db->query($sql, $params);

        if($result->error()){
            throw new Exception("Error updating session end time and sus in evaluation");
        }
        else{
            return true;
        }

    }


    function decode(&$headerOrder = null, &$categoryPosition = null, &$footerOrder = null){

        $css = "";
        $geneIndex = 0;

        $i = new Individual();
        $i->setChromosome($this->getChromosome());

        $interface = $GLOBALS["interface"];


        foreach ($interface as $section => $sections) {


            foreach ($sections as $selector => $selectors) {

                $css .= "$selector {".PHP_EOL;

                foreach ($selectors as $property => $properties) {


                    foreach ($properties as $key => $value) {

                        if($key == $i->getGene($geneIndex)){

                            if($property == "order" || $property == "position"){

                                if($section == Section::HEADER){
                                    $headerOrder = explode(",", $value);
                                }
                                if($section == Section::BODY){
                                    $categoryPosition = $value;
                                }
                                if($section == Section::FOOTER){
                                    $footerOrder = explode(",", $value);
                                }
                                break;
                            }
                            //echo "Match!<br>";
                            $css .= "$property : $value !important;".PHP_EOL;
                            break;
                        }
                    }
                    $geneIndex++;
                }
                $css .= "}".PHP_EOL;
            }
        }

        return $css;

    }


}