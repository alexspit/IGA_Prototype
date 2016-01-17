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

    private $session_id;
    private $populationSize;
    private $elitismCount;
    private $maxGenerations;

    private $selectionOperator;
    private $tournamentSize;

    private $crossoverOperator;
    private $crossoverRate;

    private $mutationOperator;
    private $mutationRate;


    private $generationNumber;
    private $susScore;
    private $sessionStart;
    private $sessionEnd;

    private $user;
    private $db;
/*
    public function __construct($populationSize, $elitismCount, $maxGenerations, $selectionOperator, $tournamentSize, $crossoverOperator, $crossoverRate, $mutationOperator, $mutationRate, User $user)
    {
        $this->db = DB::getInstance();

        $this->sessionStart = date("Y-m-d H:i:s", time());

        $sql = "INSERT INTO session (user_id, selection_operator, crossover_operator, mutation_operator, elitism_count, max_generations, population_size, tournament_size, session_start) VALUES (?,?,?,?,?,?,?,?,?)";
        $params = [$user->getUserId(), $selectionOperator, $crossoverOperator, $mutationOperator, $elitismCount, $maxGenerations, $populationSize, $tournamentSize, $this->sessionStart];

        $result = $this->db->query($sql, $params);

        if($result->error()){

            throw new Exception("Error adding new GA Session");

        }else{

            $this->session_id = $result->last_inserted_id;
            $this->generationNumber = 1;
            $this->user = $user;

            $this->populationSize = $populationSize;
            $this->elitismCount = $elitismCount;
            $this->maxGenerations = $maxGenerations;
            $this->selectionOperator = $selectionOperator;
            $this->tournamentSize = $tournamentSize;
            $this->crossoverOperator = $crossoverOperator;
            $this->crossoverRate = $crossoverRate;
            $this->mutationOperator = $mutationOperator;
            $this->mutationRate = $mutationRate;

            $sql = "INSERT INTO generation (session_id, generation_number, crossover_rate, mutation_rate) VALUES (?,?,?,?)";
            $params = [$this->session_id, $this->generationNumber, $this->crossoverRate, $this->mutationRate];

            $result = $this->db->query($sql, $params);

            if($result->error()){
                throw new Exception("Error adding new Generation");
            }
        }

    }
*/

    public function __construct($user_id = null)
    {
        $this->db = DB::getInstance();

        if (!is_null($user_id)){

            $sql = "SELECT s.population_size, s.elitism_count, s.max_generations, s.selection_operator, s.tournament_size,
                s.crossover_operator, g.crossover_rate, s.mutation_operator, g.mutation_rate, g.generation_number, s.user_id
                FROM session s INNER JOIN generation g ON (s.session_id = g.session_id)
                WHERE s.user_id = ?";
            $param = [$user_id];

            $pdo = $this->db->query($sql, $param);

            $this->session_id =$pdo->last_inserted_id;

            $this->populationSize = $pdo->result()[0]->population_size;
            $this->elitismCount = $pdo->result()[0]->elitism_count;
            $this->maxGenerations = $pdo->result()[0]->max_generations;
            $this->selectionOperator = $pdo->result()[0]->selection_operator;
            $this->tournamentSize = $pdo->result()[0]->tournament_size;
            $this->crossoverOperator = $pdo->result()[0]->crossover_operator;
            $this->crossoverRate = $pdo->result()[0]->crossover_rate;
            $this->mutationOperator = $pdo->result()[0]->mutation_operator;
            $this->mutationRate = $pdo->result()[0]->mutation_rate;
            $this->generationNumber = $pdo->result()[0]->generation_number;

            $user = new User();
            $this->user =  $user->get($pdo->result()[0]->user_id);

        }

    }

    public function init($populationSize, $elitismCount, $maxGenerations, $selectionOperator, $tournamentSize, $crossoverOperator, $crossoverRate, $mutationOperator, $mutationRate, User $user){


        $this->sessionStart = date("Y-m-d H:i:s", time());

        $sql = "INSERT INTO session (user_id, selection_operator, crossover_operator, mutation_operator, elitism_count, max_generations,
                population_size, tournament_size, session_start) VALUES (?,?,?,?,?,?,?,?,?)";
        $params = [$user->getUserId(), $selectionOperator, $crossoverOperator, $mutationOperator, $elitismCount, $maxGenerations, $populationSize, $tournamentSize, $this->sessionStart];

        $result = $this->db->query($sql, $params);

        if($result->error()){

            throw new Exception("Error adding new GA Session");

        }else{

            $this->session_id = $result->last_inserted_id;
            $this->generationNumber = 1;
            $this->user = $user;

            $this->populationSize = $populationSize;
            $this->elitismCount = $elitismCount;
            $this->maxGenerations = $maxGenerations;
            $this->selectionOperator = $selectionOperator;
            $this->tournamentSize = $tournamentSize;
            $this->crossoverOperator = $crossoverOperator;
            $this->crossoverRate = $crossoverRate/100;
            $this->mutationOperator = $mutationOperator;
            $this->mutationRate = $mutationRate/100;

            $sql = "INSERT INTO generation (session_id, generation_number, crossover_rate, mutation_rate) VALUES (?,?,?,?)";
            $params = [$this->session_id, $this->generationNumber, $this->crossoverRate, $this->mutationRate];

            $result = $this->db->query($sql, $params);

            if($result->error()){
                throw new Exception("Error adding new Generation");
            }
        }

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

    public function crossoverUniform(Population $population, Element $element, $selectionMethod = Selection::TOURNAMENT, $tournamentSize = 10){

        $newPopulation = new Population($population->size());

        for($populationIndex = 0; $populationIndex < $population->size(); $populationIndex++){

            $parent1 = $population->getFittestIndividual($populationIndex);

            if($this->crossoverRate > Random::generate() && $populationIndex > $this->elitismCount){
                $offspring = new Individual($element);

                if($selectionMethod == Selection::ROULETTE){
                    $parent2 = $this->selectParentRoulette($population);
                }
                else if($selectionMethod == Selection::TOURNAMENT){

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

    public function crossoverSinglePoint(Population $population, $selectionMethod = Selection::TOURNAMENT, $tournamentSize = 10){

        $newPopulation = new Population($population->size());

        for($populationIndex = 0; $populationIndex < $population->size(); $populationIndex++){

            $parent1 = $population->getFittestIndividual($populationIndex);

            if($this->crossoverRate > Random::generate() && $populationIndex >= $this->elitismCount){
                $offspring = new Individual($parent1->getChromosomeLength());

                if($selectionMethod == Selection::ROULETTE){
                    $parent2 = $this->selectParentRoulette($population);
                }
                else if($selectionMethod == Selection::TOURNAMENT){

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

    public function crossoverTwoPoint(Population $population, $selectionMethod = Selection::TOURNAMENT, $tournamentSize = 10){

        $newPopulation = new Population($population->size());

        for($populationIndex = 0; $populationIndex < $population->size(); $populationIndex++){

            $parent1 = $population->getFittestIndividual($populationIndex);

            if($this->crossoverRate > Random::generate() && $populationIndex >= $this->elitismCount){
                $offspring = new Individual($parent1->getChromosomeLength());

                if($selectionMethod == Selection::ROULETTE){
                    $parent2 = $this->selectParentRoulette($population);
                }
                else if($selectionMethod == Selection::TOURNAMENT){

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

    public function getGenerationNumber(){
        return $this->generationNumber;
    }

    public function getSessionID(){
        return $this->session_id;
    }

} 