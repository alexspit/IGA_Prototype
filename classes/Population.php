<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27-Dec-15
 * Time: 01:10
 */

class Population {

    private $population;
    private $populationFitness = -1;

    public function __construct($populationSize, Element $element = null ){

        $this->population = [];

        if(!is_null($element)){
            for($individualCount = 0; $individualCount < $populationSize; $individualCount++){

                $individual = new Individual($element);
                $this->population[] = $individual;
            }
        }


    }

    public function getIndividuals(){

        return $this->population;
    }

    public function getFittestIndividual($offset){

       //CHECK HERE IF THERE ARE PROBLEMS

        $tmpPopulation = $this->population;

        usort($tmpPopulation, function(Individual $individual1, Individual $individual2) { //Returning positive or negative numbers to sort the elements. By putting the 2nd parameter first, we sort in descending order.
            //return $individual2->getFitness() - $individual1->getFitness();
            if($individual1->getFitness() > $individual2->getFitness()){
                return -1;
            }
            else if($individual1->getFitness() < $individual2->getFitness()){
                return 1;
            }
            else{
                return 0;
            }
        });

        $this->population = $tmpPopulation;
        return $this->population[$offset];
    }

    public function setPopulationFitness($fitness){

        //$this->populationFitness = (float)$fitness;
        $this->populationFitness = $fitness;
    }

    public function getPopulationFitness(){

        return $this->populationFitness;
    }

    public function size(){

        return $this->population->count();
    }

    public function setIndividual($key, Individual $individual){

        return $this->population[$key] = $individual;
    }


    public function addIndividual(Individual $individual){

        $this->population[] = $individual;
    }

    public function getIndividual($key){

        return $this->population[$key];
    }

    public function shuffle(){

        shuffle($this->population);

    }
} 