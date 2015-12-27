<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27-Dec-15
 * Time: 13:13
 */

class Property {

    private $id;
    private $cssName;
    private $values;

    function __construct($id, $cssName = null, array $values = null)
    {
        $this->cssName = $cssName;
        $this->id = $id;

        if(!is_null($values)){

            $this->values = $values;
        }
        else{

            $this->values = array();
        }

    }

    public function getValue($id){
        return $this->values[$id];
    }

    public function addValue($id, $value){
        $this->values[$id] = $value;
    }

    public function getRandomValue(){

        $rnd = rand(0, count($this->values) - 1);
        return $rnd;
    }


    /**
     * @return mixed
     */
    public function getCssName()
    {
        return $this->cssName;
    }

    /**
     * @param mixed $cssName
     */
    public function setCssName($cssName)
    {
        $this->cssName = $cssName;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $name
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param mixed $values
     */
    public function setValues($values)
    {
        $this->values = $values;
    }





} 