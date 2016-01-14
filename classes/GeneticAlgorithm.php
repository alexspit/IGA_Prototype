<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27-Dec-15
 * Time: 02:16
 */
//require_once "Population.php";
//require_once "Individual.php";

class GeneticAlgorithm {

    private $populationSize;
    private $mutationOperator;
    private $selectionOperator;
    private $crossoverOperator;
    private $mutationRate;
    private $crossoverRate;
    private $elitismCount;
    private $maxGenerations;
    private $tournamentSize;
    private $generationNumber;
    private $susScore;
    private $sessionStart;
    private $sessionEnd;



    const ROULETTE = 1;
    const TOURNAMENT = 2;

    function __construct($populationSize, $crossoverRate, $mutationRate, $elitismCount)
    {
        $this->crossoverRate = $crossoverRate;
        $this->elitismCount = $elitismCount;
        $this->mutationRate = $mutationRate;
        $this->populationSize = $populationSize;
    }


    public function initPopulation(Element $element){

        return new Population($this->populationSize, $element);
    }

    function decode($id, Individual $individual, Element $element){

        $cssCode = "{$element->getCssTag()}#individual{$id} {".PHP_EOL;
        $chromosome = $individual->getChromosome()->toArray();
        $geneIndex = 0;

        foreach ($element->getProperties() as $property) {

            if($property->getCssName() == "font-family"){
                $cssCode .= "{$property->getCssName()} : '{$property->getValue($chromosome[$geneIndex])}', serif; ";
            }else{
                $cssCode .= "{$property->getCssName()} : {$property->getValue($chromosome[$geneIndex])}; ";
            }

            $geneIndex++;
        }
        $cssCode .= "}";

        return $cssCode;

    }

    public function evalPopulation(Population $population){

        $populationFitness = 0;


        foreach ($population->getIndividuals() as $individual) {


            $populationFitness += $individual->getFitness();
        }

        $population->setPopulationFitness($populationFitness);

    }

    public function isTerminationConditionMet(Population $population){

        foreach ($population->getIndividuals() as $individual) {

            if($individual->getFitness() == 1){

                return true;
            }
        }

        return false;
    }


    public function selectParentRoulette(Population $population){

        $individuals = $population->getIndividuals();

        $populationFitness = $population->getPopulationFitness();
        $rouletteWheelPosition = (double) Random::generate() * $populationFitness;

        $spinWheel = 0;
        foreach ($individuals as $individual) {
            $spinWheel += $individual->getFitness();

            if($spinWheel >= $rouletteWheelPosition){
                return $individual;
            }
        }

        return $individuals[$population->size() - 1];

    }

    public function selectParentTournament(Population $population, $tournamentSize){

        $tournament = new Population($tournamentSize);

        $population->shuffle();

        for($i = 0; $i<$tournamentSize;$i++){

            $tournamentIndividual = $population->getIndividual($i);
            $tournament->setIndividual($i, $tournamentIndividual);
        }

        return $tournament->getFittestIndividual(0);


    }

    public function crossoverUniform(Population $population, Element $element, $selectionMethod = 2, $tournamentSize = 10){

        $newPopulation = new Population($population->size());

        for($populationIndex = 0; $populationIndex < $population->size(); $populationIndex++){

            $parent1 = $population->getFittestIndividual($populationIndex);

            if($this->crossoverRate > Random::generate() && $populationIndex > $this->elitismCount){
                $offspring = new Individual($element);

                if($selectionMethod == 1){
                    $parent2 = $this->selectParentRoulette($population);
                }
                else if($selectionMethod == 2){

                    if($tournamentSize <= $population->size()){

                        $parent2 = $this->selectParentTournament($population, $tournamentSize);
                    }
                    else{
                        throw new Exception("Tournament size larger than populations");
                    }

                }


                for($geneIndex = 0; $geneIndex < $parent1->getChromosomeLength(); $geneIndex++){

                    if(0.5 > Random::generate()){
                        $offspring->setGene($geneIndex, $parent1->getGene($geneIndex));
                    }
                    else{
                        $offspring->setGene($geneIndex, $parent2->getGene($geneIndex));
                    }
                }

                $newPopulation->setIndividual($populationIndex, $offspring);
            }
            else{
                $newPopulation->setIndividual($populationIndex, $parent1);
            }
        }

        return $newPopulation;
    }

    public function crossoverSinglePoint(Population $population, $selectionMethod = 2, $tournamentSize = 10){

        $newPopulation = new Population($population->size());

        for($populationIndex = 0; $populationIndex < $population->size(); $populationIndex++){

            $parent1 = $population->getFittestIndividual($populationIndex);

            if($this->crossoverRate > Random::generate() && $populationIndex >= $this->elitismCount){
                $offspring = new Individual($parent1->getChromosomeLength());

                if($selectionMethod == 1){
                    $parent2 = $this->selectParentRoulette($population);
                }
                else if($selectionMethod == 2){

                    if($tournamentSize <= $population->size()){

                        $parent2 = $this->selectParentTournament($population, $tournamentSize);
                    }
                    else{
                        throw new Exception("Tournament size larger than populations");
                    }

                }

                $swapPoint = (int) Random::generate() * ($parent1->getChromosomeLength() + 1);

                for($geneIndex = 0; $geneIndex < $parent1->getChromosomeLength(); $geneIndex++){

                    if($geneIndex < $swapPoint){
                        $offspring->setGene($geneIndex, $parent1->getGene($geneIndex));
                    }
                    else{
                        $offspring->setGene($geneIndex, $parent2->getGene($geneIndex));
                    }
                }

                $newPopulation->setIndividual($populationIndex, $offspring);
            }
            else{
                $newPopulation->setIndividual($populationIndex, $parent1);
            }
        }

        return $newPopulation;
    }

    public function crossoverTwoPoint(Population $population, $selectionMethod = 2, $tournamentSize = 10){

        $newPopulation = new Population($population->size());

        for($populationIndex = 0; $populationIndex < $population->size(); $populationIndex++){

            $parent1 = $population->getFittestIndividual($populationIndex);

            if($this->crossoverRate > Random::generate() && $populationIndex >= $this->elitismCount){
                $offspring = new Individual($parent1->getChromosomeLength());

                if($selectionMethod == 1){
                    $parent2 = $this->selectParentRoulette($population);
                }
                else if($selectionMethod == 2){

                    if($tournamentSize <= $population->size()){

                        $parent2 = $this->selectParentTournament($population, $tournamentSize);
                    }
                    else{
                        throw new Exception("Tournament size larger than populations");
                    }

                }

                //$swapPoint1 = Random::generate() * ($parent1->getChromosomeLength() + 1);

                $swapPoint1 = rand(0,$parent1->getChromosomeLength()-2);

                $swapPoint2 = rand($swapPoint1+1, $parent1->getChromosomeLength()-1);

                for($geneIndex = 0; $geneIndex < $parent1->getChromosomeLength(); $geneIndex++){

                    if($geneIndex < $swapPoint1 || $geneIndex > $swapPoint2 ){
                        $offspring->setGene($geneIndex, $parent1->getGene($geneIndex));
                    }
                    else{
                        $offspring->setGene($geneIndex, $parent2->getGene($geneIndex));
                    }
                }

                $newPopulation->setIndividual($populationIndex, $offspring);
            }
            else{
                $newPopulation->setIndividual($populationIndex, $parent1);
            }
        }

        return $newPopulation;
    }


    public function mutateUniform(Population $population, Element $element){

        $newPopulation = new Population($population->size());

        for($populationIndex = 0; $populationIndex < $population->size(); $populationIndex++){

            $individual = $population->getFittestIndividual($populationIndex);

            $randomIndividual = new Individual($element);

            for($geneIndex = 0; $geneIndex < $individual->getChromosomeLength(); $geneIndex++){

                if($populationIndex >= $this->elitismCount){
                    if($this->mutationRate > Random::generate()){

                        $individual->setGene($geneIndex, $randomIndividual->getGene($geneIndex));
                    }

                }
            }

            $newPopulation->setIndividual($populationIndex,$individual);

        }

        return $newPopulation;
    }

} 