<?php

/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 1/14/2016
 * Time: 2:49 PM
 */


class User
{

    private $user_id;
    private $name;
    private $surname;
    private $age;
    private $sex;

    private $db;

    /**
     * User constructor.
     * @param $user_id
     * @param $name
     * @param $surname
     * @param $age
     * @param $sex
     */

    public function __construct($name = null, $surname = null, $age = null, $sex = null)
    {
        $this->db = DB::getInstance();

        if(!is_null($name)){

            $result = $this->db->query("INSERT INTO user (name, surname, age, sex) VALUES (?, ?, ?, ?)", [$name, $surname, $age, $sex] );

            if(!$result->error()){

                $this->user_id = $this->db->last_inserted_id;
                $this->name = $name;
                $this->surname = $surname;
                $this->age = $age;
                $this->sex = $sex;
            }

        }

    }

    public function save(){

        $result = $this->db->query("INSERT INTO user (name, surname, age, sex) VALUES (?, ?, ?, ?)", [$this->name, $this->surname, $this->age, $this->sex] );

        $this->setUserId($result->last_inserted_id);

    }

    public function get($id){

        $sql = "SELECT * FROM user WHERE user_id = ?";
        $params = [$id];
        $user = $this->db->query($sql, $params, 'User');

        $this->user_id = $id;
        $this->name = $user->result()[0]->name;
        $this->surname = $user->result()[0]->surname;
        $this->age = $user->result()[0]->age;
        $this->sex = $user->result()[0]->sex;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return null
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param null $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return null
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param null $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return null
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param null $sex
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    }



}