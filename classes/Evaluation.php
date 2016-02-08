<?php

/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 2/8/2016
 * Time: 3:55 PM
 */


class Evaluation
{

    const ORIGINAL = 0;
    const EVOLVED = 1;

    private $db, $evaluation_id, $type, $user, $sessionStart, $sessionEnd, $susScore, $sumScore, $chromosome, $tasks;

    /**
     * Evaluation constructor.
     * @param $user_id
     */
    public function __construct($user_id = null, $type = null)
    {
        $this->db = DB::getInstance();
        $this->tasks = [];

        if(!is_null($user_id)){

            $sql = "SELECT e.evaluation_id, e.eval_type, e.session_start, e.session_end, e.sus_score, e.sum_score, e.chromosome FROM evaluation e
                    INNER JOIN user u ON (u.user_id = e.user_id) WHERE e.user_id=? AND e.eval_type =?";
            $param = [$user_id, $type];

            $pdo = $this->db->query($sql, $param);

            if($pdo->count() > 0){

                $this->evaluation_id = $pdo->result()[0]->evaluation_id;
                $this->type = $pdo->result()[0]->eval_type;
                $this->sessionStart = $pdo->result()[0]->session_start;
                $this->sessionEnd = $pdo->result()[0]->session_end;
                $this->susScore = $pdo->result()[0]->sus_score;
                $this->sumScore = $pdo->result()[0]->sum_score;
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

        }

    }

    public function saveTask($number){

        $this->tasks[$number] = new Task($number, $this->evaluation_id);

    }

    public function addTask($number){

        $this->tasks[$number] = new Task($number);

    }

    public function getTask($number){

        return $this->tasks[$number];
    }
}