<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27-Dec-15
 * Time: 12:18
 */

class Section {

    private $name;
    private $selectors;

    public function __construct($name, array $selectors = null){

        $this->name = $name;

        if(!is_null($selectors)){
            $this->selectors = $selectors;
        }else
        {
            $this->selectors = array();
        }
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getSelectors()
    {
        return $this->selectors;
    }

    /**
     * @param array $selectors
     */
    public function setSelectors(array $selectors)
    {
        $this->selectors = $selectors;
    }


    public function addSelector(Selector $selector){

        $this->selectors[] = $selector;
    }

}