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
    private $generation_id;

    private $sessionStart;
    private $sessionEnd;

    private $user;
    private $db;

    private $element;
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

        //OBVIOUSLT TEMP - For testing only
        $this->element = new Element("h1", 1);

        $this->element->addProperty(new Property(1, "color", ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"]));
        $this->element->addProperty(new Property(2, "text-align", ["center", "left", "right", "justified"]));
        $this->element->addProperty(new Property(3, "text-decoration", ["overline", "underline", "line-through", "none"]));
        $this->element->addProperty(new Property(4, "font-family", ["Tangerine", "Inconsolata", "Droid Sans", "Times New Roman", "Arial", "Calibri", "Helvetica"]));
        $this->element->addProperty(new Property(5, "font-style", ["normal", "italic", "oblique"]));
        $this->element->addProperty(new Property(6, "font-weight", ["normal", "lighter", "bold"]));
        $this->element->addProperty(new Property(7, "letter-spacing", ["-3px", "-2px", "-1px", "0px", "1px", "2px", "3px"]));
        //$this->element->addProperty(new Property(7, "background-color", ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"]));


        if (!is_null($user_id)){

            $sql = "SELECT s.population_size, s.elitism_count, s.max_generations, s.selection_operator, s.tournament_size,
                s.crossover_operator, g.crossover_rate, s.mutation_operator, g.mutation_rate, g.generation_number, s.user_id, s.session_id, g.generation_id
                FROM session s INNER JOIN generation g ON (s.session_id = g.session_id)
                WHERE s.user_id = ?";
            $param = [$user_id];

            $pdo = $this->db->query($sql, $param);

            $this->session_id =$pdo->result()[0]->session_id;

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
            $this->generation_id = $pdo->result()[0]->generation_id;

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
            else{
                $this->generation_id = $result->last_inserted_id;
            }
        }

    }

    public function initPopulation(){

        return new Population($this->populationSize, $this->generation_id, $this->element);
    }

    function decode(Individual $individual){

        $cssCode = "{$this->element->getCssTag()} {".PHP_EOL;
        $chromosome = $individual->getChromosome();
        $geneIndex = 0;

        foreach ($this->element->getProperties() as $property) {

            if($property->getCssName() == "font-family"){
                $cssCode .= "{$property->getCssName()} : '{$property->getValue($chromosome[$geneIndex])}', serif; ";
            }else{
                $cssCode .= "{$property->getCssName()} : {$property->getValue($chromosome[$geneIndex])} !important; ";
            }

            $geneIndex++;
        }
        $cssCode .= "}";

        return $cssCode;

    }

    public function currentPopulation(){

        $sql = "SELECT i.individual_id FROM individual i
                INNER JOIN generation g ON (i.generation_id = g.generation_id)
                INNER JOIN session s ON (g.session_id = s.session_id)
                INNER JOIN user u ON (s.user_id = u.user_id)
                WHERE u.user_id = ?";
        $param = [$this->user->getUserId()];

        $pdo = $this->db->query($sql, $param);

        $currentPopulation = new Population($this->populationSize);

        foreach ($pdo->result() as $i) {
            $currentPopulation->addIndividual(new Individual($i->individual_id));
        }

        return $currentPopulation;

    }
/*
    public function evalPopulation(Population $population){

        $populationFitness = 0;


        foreach ($population->getIndividuals() as $individual) {


            $populationFitness += $individual->getFitness();
        }

        $population->setPopulationFitness($populationFitness);

    }*/

    public function evalPopulation(Population $population, array $ratings){

        $populationFitness = 0;

        if(count($ratings) != $population->size()){
            throw new Exception("Not all individuals have been rated");
        }
        else{

            foreach ($population->getIndividuals() as $individual) {

                $individualName = "individual_".$individual->getIndividualId();
                $individual->setFitness($ratings[$individualName]/10);

                $populationFitness += $individual->getFitness();

            }

            $population->setPopulationFitness($populationFitness);

            $sql = "UPDATE generation SET total_fitness='$populationFitness' WHERE generation_id=?";
            $params = [$this->generation_id];
            $result = $this->db->query($sql, $params);

            if($result->error()){
                throw new Exception("Error updating total fitness field in Generation Table");
            }

            return $population;
        }

    }

    public function isTerminationConditionMet(Population $population){

        foreach ($population->getIndividuals() as $individual) {

            if($individual->getFitness() == 1){

                return true;
            }
        }

        return false;
    }

    public function crossover(Population $population){

        switch($this->crossoverOperator){

            case Crossover::SINGLE_POINT:
                $crossedPopulation = $this->crossoverSinglePoint($population,$this->selectionOperator, $this->tournamentSize);
                break;
            case Crossover::TWO_POINT:
                $crossedPopulation = $this->crossoverTwoPoint($population,$this->selectionOperator, $this->tournamentSize);
                break;
            case Crossover::UNIFORM:
                $crossedPopulation = $this->crossoverUniform($population,$this->selectionOperator, $this->tournamentSize);
                break;
            default:
                $crossedPopulation = null;
                break;
        }

        return $crossedPopulation;
    }

    public function mutate(Population $population){

        switch($this->mutationOperator){

            case Mutation::UNIFORM:
                $mutatedPopulation = $this->mutateUniform($population);
                break;
            case Mutation::NON_UNIFORM:
                //$mutatedPopulation = $this->mutateNonUniform($population);
                break;
            default:
                $mutatedPopulation = null;
                break;
        }

        return $mutatedPopulation;


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

        echo "Tournament Selection...<br>";
        $tournament = new Population($tournamentSize);

        $population->shuffle();

        echo $tournamentSize."<br>";

        for($i = 0; $i<$tournamentSize;$i++){

            $tournamentIndividual = $population->getIndividual($i);
            $tournament->setIndividual($i, $tournamentIndividual);
        }

        echo "$tournament-----------------------------<br>";

        $population->orderedByFittest();

        return $tournament->getFittestIndividual(0);


    }

    public function crossoverUniform(Population $population, $selectionMethod = Selection::TOURNAMENT, $tournamentSize = 5){

        echo "Starting Uniform Crossover...<br>";
        $newPopulation = new Population($population->size());

        echo "$population--------------------<br>";
        $population->orderedByFittest();
        echo "$population-------------------------<br>";

        for($populationIndex = 0; $populationIndex < $population->size(); $populationIndex++){

            $parent1 = $population->getIndividual($populationIndex);
            echo "Population Index: $populationIndex Fittest: $parent1<br>";

            if($this->crossoverRate > Random::generate() && $populationIndex >= $this->elitismCount){
                $offspring = new Individual();

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

                echo "Parent 1: $parent1<br>";
                echo "Parent 2: $parent2<br>";

                for($geneIndex = 0; $geneIndex < $parent1->getChromosomeLength(); $geneIndex++){
                    $randNum = Random::generate();

                    if(0.5 > $randNum ){
                        echo "1";
                        $offspring->setGene($geneIndex, $parent1->getGene($geneIndex));
                    }
                    else{
                        echo "2";
                        $offspring->setGene($geneIndex, $parent2->getGene($geneIndex));
                    }
                }
                echo "<br>";

                echo "Offspring: $offspring<br>";
                $newPopulation->setIndividual($populationIndex, $offspring);
            }
            else{
                echo "Offspring Unchanged: $parent1<br>";
                $newPopulation->setIndividual($populationIndex, $parent1);
            }
            echo "--------------------------------------------------------<br>";
        }


        return $newPopulation;
    }

    public function crossoverSinglePoint(Population $population, $selectionMethod = Selection::TOURNAMENT, $tournamentSize = 10){

        $newPopulation = new Population($population->size());

        for($populationIndex = 0; $populationIndex < $population->size(); $populationIndex++){

            //TODO: FIX getFittestIndividual()
            $parent1 = $population->getFittestIndividual($populationIndex);

            if($this->crossoverRate > Random::generate() && $populationIndex >= $this->elitismCount){


                $offspring = new Individual();

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

                echo "Parent 1: $parent1<br>";
                echo "Parent 2: $parent2<br>";

                //FIX THIS!!
                $swapPoint = (int) rand(0,$parent1->getChromosomeLength());

                for($geneIndex = 0; $geneIndex < 7; $geneIndex++){

                    if($geneIndex < $swapPoint){
                        $offspring->setGene($geneIndex, $parent1->getGene($geneIndex));
                    }
                    else{
                        $offspring->setGene($geneIndex, $parent2->getGene($geneIndex));
                    }
                }
                echo "Offspring: $offspring<br>";


                $newPopulation->setIndividual($populationIndex, $offspring);
            }
            else{
                $newPopulation->setIndividual($populationIndex, $parent1);
                echo "Offspring Unchanged: $parent1<br>";
            }
            echo "-------------------------------------<br>";
        }

        return $newPopulation;
    }

    public function crossoverTwoPoint(Population $population, $selectionMethod = Selection::TOURNAMENT, $tournamentSize = 10){

        $newPopulation = new Population($population->size());

        for($populationIndex = 0; $populationIndex < $population->size(); $populationIndex++){

            //TODO: FIX getFittestIndividual()
            $parent1 = $population->getFittestIndividual($populationIndex);

            if($this->crossoverRate > Random::generate() && $populationIndex >= $this->elitismCount){

                $offspring = new Individual();

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

                echo "Parent 1: $parent1<br>";
                echo "Parent 2: $parent2<br>";

                //$swapPoint1 = Random::generate() * ($parent1->getChromosomeLength() + 1);

                $swapPoint1 = rand(0,$parent1->getChromosomeLength()-2);

                $swapPoint2 = rand($swapPoint1+1, $parent1->getChromosomeLength()-1);

                echo "Swap Points: $swapPoint1, $swapPoint2<br>";

                for($geneIndex = 0; $geneIndex < $parent1->getChromosomeLength(); $geneIndex++){

                    if($geneIndex < $swapPoint1 || $geneIndex > $swapPoint2 ){
                        $offspring->setGene($geneIndex, $parent1->getGene($geneIndex));
                    }
                    else{
                        $offspring->setGene($geneIndex, $parent2->getGene($geneIndex));
                    }
                }

                echo "Offspring: $offspring<br>";
                $newPopulation->setIndividual($populationIndex, $offspring);
            }
            else{
                echo "Offspring Unchanged: $parent1<br>";
                $newPopulation->setIndividual($populationIndex, $parent1);
            }

            echo "----------------------------------------<br>";
        }

        return $newPopulation;
    }

    public function mutateUniform(Population $population){

        $newPopulation = new Population($population->size());

        for($populationIndex = 0; $populationIndex < $population->size(); $populationIndex++){

            $individual = $population->getFittestIndividual($populationIndex);


            $randomIndividual = new Individual(null, $this->element);
            $randomIndividual->generateRandom();


            for($geneIndex = 0; $geneIndex < $individual->getChromosomeLength(); $geneIndex++){

                if($populationIndex >= $this->elitismCount){
                    if($this->mutationRate > Random::generate()){

                        echo "Mutating individual: $individual  Gene at locus: $geneIndex from {$individual->getGene($geneIndex)} to {$randomIndividual->getGene($geneIndex)}<br>";
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

    public function getGenerationID(){
        return $this->generation_id;
    }

    public function incrementGeneration(){
        $this->generationNumber++;
    }
}
