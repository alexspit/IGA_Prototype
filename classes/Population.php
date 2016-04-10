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

    public function __construct($populationSize, $generation_id = null, $user_id = null){

        $this->population = [];

        if(!is_null($generation_id)){
            for($individualCount = 0; $individualCount < $populationSize; $individualCount++){

                $individual = new Individual($generation_id, true, $user_id);
                $this->population[] = $individual;
            }
        }


    }

    public function getIndividuals(){

        return $this->population;
    }

    /**
     * Order the population by fitness and return the nth fittest individual
     *
     * @param $offset The nth fittest individual offset
     * @return Individual The nth fittest individual
     */
    public function getFittestIndividual($offset){

        $tmpPopulation = $this->population;

        //Using a callback to sort by fitness
        usort($tmpPopulation, function(Individual $individual1, Individual $individual2) { //Returning positive or negative numbers to sort the elements. By putting the 2nd parameter first, we sort in descending order.

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

    public function getClone(){
        $tmpPop = new Population($this->size());
        foreach ($this->getIndividuals() as $individual) {
            $tmpPop->addIndividual(clone $individual);
        }
        return $tmpPop;
    }

    public function clear(){
        $this->population = [];
    }

    public function orderedByFittest(){

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

    }

    public function setPopulationFitness($fitness){

        //$this->populationFitness = (float)$fitness;
        $this->populationFitness = $fitness;
    }

    public function getPopulationFitness(){

        return $this->populationFitness;
    }

    public function size(){

        return count($this->population);
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

    public function __toString(){
        $output = "";

        foreach ($this->getIndividuals() as $key => $i) {
           $output .= $key.": ".$i."<br>";
        }

        return $output;
    }
} 