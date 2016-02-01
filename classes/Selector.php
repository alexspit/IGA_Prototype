<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27-Dec-15
 * Time: 12:18
 */

class Selector {

    private $cssTag;
    private $properties;

    public function __construct($cssTag, array $properties = null){

        $this->cssTag = $cssTag;

        if(!is_null($properties)){
            $this->properties = $properties;
        }else
        {
            $this->properties = array();
        }
    }

    /**
     * @return mixed
     */
    public function getCssTag()
    {
        return $this->cssTag;
    }

    /**
     * @param mixed $css_tag
     */
    public function setCssTag($cssTag)
    {
        $this->cssTag = $cssTag;
    }

    /**
     * @return mixed
     */
    public function getProperties()
    {
        return $this->properties;
    }

    public function setProperties(array $properties){

        $this->properties = $properties;
    }

    public function addProperty(Property $property){

        $this->properties[] = $property;
    }

    public function getProperty($id){

        if (is_numeric($id)){
            return $this->properties[$id];
        }
        else{
            foreach ($this->properties as $property) {
                if($property->getCssName() == $id){
                    return $property;
                }

            }

        }

    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

}