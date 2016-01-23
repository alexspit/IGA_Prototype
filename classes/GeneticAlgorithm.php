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
        $this->element->addProperty(new Property(2, "text-align", ["center", "left", "right"]));
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
                WHERE s.user_id = ? ORDER BY g.generation_number DESC LIMIT 1 ";
            $param = [$user_id];

            $pdo = $this->db->query($sql, $param);

            if($pdo->count() > 0){
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

            $sql = "INSERT INTO generation (session_id, generation_number, crossover_rate, mutation_rate, start_time) VALUES (?,?,?,?,?)";
            $params = [$this->session_id, $this->generationNumber, $this->crossoverRate, $this->mutationRate, $this->sessionStart];

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
                WHERE u.user_id = ? AND g.generation_number = ?";
        $param = [$this->user->getUserId(), $this->generationNumber];

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
                $individual->setFitness($ratings[$individualName]/10, true);

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


    public function nextGeneration(Population $population){

            //Updating end time of current generation
            $endTime = date("Y-m-d H:i:s", time());
            $sql = "UPDATE generation SET end_time='$endTime' WHERE generation_id=?";
            $params = [$this->generation_id];
            $result = $this->db->query($sql, $params);

            if($result->error()){
                throw new Exception("Error updating generation end time field in Generation Table");
            }

            //Incrementing the generation number
            $this->incrementGeneration();

            //Adding new generation in DB
            $sql = "INSERT INTO generation (session_id, generation_number, crossover_rate, mutation_rate, start_time) VALUES (?,?,?,?,?)";
            $params = [$this->session_id, $this->generationNumber, $this->crossoverRate, $this->mutationRate, date("Y-m-d H:i:s", time())];
            $result = $this->db->query($sql, $params);

            if($result->error()){
                throw new Exception("Error adding new Generation");
            }
            else{
                //Storing last inserted id as the new generation_id
                $this->generation_id = $result->last_inserted_id;

                $population->shuffle();
                //Storing each new individual in the database
                foreach ($population->getIndividuals() as $individual) {
                    $individual->save($this->generation_id);
                }

            }


    }

    public function terminationConditionMet(){

        return $this->generationNumber == $this->maxGenerations;
    }

    public function selection(Population $population){

        switch($this->selectionOperator){

            case Selection::ROULETTE:
                $matingPool = $this->rouletteWheelSelection($population);
                break;
            case Selection::TOURNAMENT:
                $matingPool = $this->tournamentSelection($population);
                break;
            case Selection::STOCHASTIC_UNIVERSAL_SAMPLING:
                $matingPool = $this->stochasticUniversalSampling($population);
                break;
            default:
                $matingPool = null;
                break;
        }

        return $matingPool;

    }

    public function crossover(Population $population){

        switch($this->crossoverOperator){

            case Crossover::SINGLE_POINT:
                $crossedPopulation = $this->singlePointCrossover($population);
                break;
            case Crossover::TWO_POINT:
                $crossedPopulation = $this->twoPointCrossover($population);
                break;
            case Crossover::UNIFORM:
                $crossedPopulation = $this->uniformCrossover($population);
                break;
            case Crossover::MULTI_POINT:
                $crossedPopulation = $this->multiPointCrossover($population, 3);
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
                $mutatedPopulation = $this->uniformMutation($population);
                break;
            case Mutation::NON_UNIFORM:
                //$mutatedPopulation = $this->nonUniformMutation($population);
                break;
            default:
                $mutatedPopulation = null;
                break;
        }

        return $mutatedPopulation;

    }


    public function rouletteWheelSelection(Population $population){

        //Getting all individuals in given population
        $individuals = $population->getIndividuals();

        //Storing the total population fitness
        $populationFitness = $population->getPopulationFitness();

        //Creating a new mating pool population to store the selected individuals for breeding
        $matingPool = new Population($population->size());

        //Adding the fittest individuals according to elitism count
        for($i = 0; $i<$this->elitismCount; $i++){

            $matingPool->addIndividual( $population->getFittestIndividual($i));
           // echo $population->getFittestIndividual($i)." added to mating pool (Elitism)<br>";
        }

        //echo $population;
       // echo $populationFitness."<br>";

        //Selecting the rest of the individuals for the mating pool
        for ($i = 0; $i< $population->size() - $this->elitismCount; $i++){

            $tmpFitness= 0;
            $rouletteWheelPosition = rand(0, ($populationFitness*1000))/1000;


            //echo "Position: $rouletteWheelPosition<br>";

            foreach ($individuals as $individual) {
                $tmpFitness += $individual->getFitness();

                //echo $individual."<br>";

                if($tmpFitness >= $rouletteWheelPosition){
                    $matingPool->addIndividual($individual);
                   // echo $individual." added to mating pool <br>";
                    break;
                }
            }

        }

        //echo "Original Population:<br> $population";
        //echo "Mating Pool:<br> $matingPool";

        return $matingPool;

    }

    public function stochasticUniversalSampling(Population $population){

        //TODO: Include Elitism
        //Cloning population
        $tmpPopulation = $population->getClone();
        $pointers = [];
        $matingPool = new Population($population->size());

        //Setting the fitness relative to a total of 1.0
        foreach ($tmpPopulation->getIndividuals() as $individual) {

            $individual->setFitness($individual->getFitness()/$population->getPopulationFitness(), false);
        }

        echo $population;
        echo $tmpPopulation;

        //Creating array of pointers

        //Size of pointer
        $pointerSize = 1/$tmpPopulation->size();
        //Starting pointer position
        $rndStartingPoint = rand(0, $pointerSize*1000)/1000;
        //$rndStartingPoint = 0;

        echo "Pointer Start: $rndStartingPoint<br>";
        echo "Space: $pointerSize<br>";

        //Adding first pointer
        $pointers[] = $rndStartingPoint;

        //Adding the rest of the pointers
        for($i = 0; $i < $tmpPopulation->size()-1; $i++){

            $rndStartingPoint += $pointerSize;
            $pointers[] = $rndStartingPoint;
        }

        echo "<pre>";
        print_r($pointers);
        echo "</pre>";


        $fitnessCount = 0;
        foreach ($tmpPopulation->getIndividuals() as $individual) {

            echo "Individual: ".$individual."<br>----------------------<br>";

            foreach ($pointers as $key => $pointer) {
               // echo "Pointer: ".$pointer."<br>";
               // echo "Lower Bound: $fitnessCount<br>";
               // echo "Upper bound: ".($individual->getFitness() + $fitnessCount)."<br>------------------------<br>";

                if($pointer >= $fitnessCount && $pointer < ($individual->getFitness() + $fitnessCount)){
                    $matingPool->addIndividual($individual);

                    echo "Added $individual to mating pool<br>------------------<br>";
                }


            }

            $fitnessCount += $individual->getFitness();


           // echo "------------------------<br>".$matingPool."---------------------<br>";

        }

       // echo $matingPool;
       // exit;
        return $matingPool;

    }

    public function tournamentSelection(Population $population){
        //TODO: TEST THIS!

        $tmpPopulation = $population->getClone();
        $matingPool = new Population($population->size());
        $tournamentPopulation = new Population($this->tournamentSize);



        for($i = 0; $i < $tmpPopulation->size(); $i++) {

            $tmpPopulation->shuffle();
            $tournamentPopulation->clear();


            for ($z = 0; $z < $this->tournamentSize; $z++) {

                $tournamentIndividual = $tmpPopulation->getIndividual($z);
                $tournamentPopulation->addIndividual($tournamentIndividual);

            }

            echo "Tourny Population: <br>$tournamentPopulation<br> -------------------------------<br>";


            $tournamentPopulation->orderedByFittest();


            $matingPool->addIndividual($tournamentPopulation->getIndividual(0));
            echo "Added: {$tournamentPopulation->getIndividual(0)} ";
        }

        //echo "<br>$matingPool";
        return $matingPool;


    }

    public function uniformCrossover(Population $population){

        $newPopulation = new Population($population->size());

        $individuals = $population->getIndividuals();

        for($i = 0; $i<$this->elitismCount; $i++){

            $newPopulation->addIndividual( $population->getFittestIndividual($i));
            echo "Added individual: ".$population->getFittestIndividual($i)."<br>";

        }

        //for($populationIndex = 0; $populationIndex < ($population->size() - $this->elitismCount)/2 ; $populationIndex++){
        while ($newPopulation->size() < $this->populationSize){

            echo $newPopulation->size()."<br>";

            if ($newPopulation->size() == $this->populationSize-1){

                $oddIndividual = array_pop($individuals);

                echo "Added remainder odd individual: ".$oddIndividual."<br>";
                $newPopulation->addIndividual($oddIndividual);

                echo "Original Population:<br> $population";
                echo "Crossed Population:<br> $newPopulation";

                return $newPopulation;

            }

            if(count($individuals) <= 0){


                echo "Original Population:<br> $population";
                echo "Crossed Population:<br> $newPopulation";

                return $newPopulation;
            }

            shuffle($individuals);

            $parent1 = array_pop($individuals);
            $parent2 = array_pop($individuals);

            echo "Parent 1: ".$parent1."<br>";
            echo "Parent 2: ".$parent2."<br>";

            if($this->crossoverRate > Random::generate()){

                $offspring1 = new Individual();
                $offspring2 = new Individual();

                for($geneIndex = 0; $geneIndex < $parent1->getChromosomeLength(); $geneIndex++){

                    if(0.5 > Random::generate()){
                        $offspring1->setGene($geneIndex, $parent1->getGene($geneIndex));
                        $offspring2->setGene($geneIndex, $parent2->getGene($geneIndex));
                    }
                    else{
                        $offspring1->setGene($geneIndex, $parent2->getGene($geneIndex));
                        $offspring2->setGene($geneIndex, $parent1->getGene($geneIndex));
                    }
                }

                echo "Added offspring ".$offspring1."<br>";
                echo "Added offspring ".$offspring2."<br>";
                $newPopulation->addIndividual($offspring1);
                $newPopulation->addIndividual($offspring2);

            }
            else{
                echo "Added parent: ".$parent1."<br>";
                echo "Added parent: ".$parent2."<br>";
                $newPopulation->addIndividual($parent1);
                $newPopulation->addIndividual($parent2);
            }

        }

        echo "Original Population:<br> $population";
        echo "Mating Pool:<br> $newPopulation";

        return $newPopulation;
    }

    public function singlePointCrossover(Population $population){

        echo "Starting Single Point Crossover...<br>";

        $newPopulation = new Population($population->size());

        $individuals = $population->getIndividuals();

        for($i = 0; $i<$this->elitismCount; $i++){

            $newPopulation->addIndividual( $population->getFittestIndividual($i));
            echo "Added individual: ".$population->getFittestIndividual($i)."<br>";

        }

        //for($populationIndex = 0; $populationIndex < $population->size(); $populationIndex++){
        while ($newPopulation->size() < $this->populationSize){

            if ($newPopulation->size() == $this->populationSize-1){

                $oddIndividual = array_pop($individuals);

                echo "Added remainder odd individual: ".$oddIndividual."<br>";
                $newPopulation->addIndividual($oddIndividual);

                echo "Original Population:<br> $population";
                echo "Crossed Population:<br> $newPopulation";

                return $newPopulation;

            }

            if(count($individuals) <= 0){

                echo "Original Population:<br> $population";
                echo "Crossed Population:<br> $newPopulation";

                return $newPopulation;
            }

            shuffle($individuals);

            $parent1 = array_pop($individuals);
            $parent2 = array_pop($individuals);

            echo "Parent 1: ".$parent1."<br>";
            echo "Parent 2: ".$parent2."<br>";

            if($this->crossoverRate > Random::generate()){

                $offspring1 = new Individual();
                $offspring2 = new Individual();

                $swapPoint = rand(1,$parent1->getChromosomeLength()-1);

                echo "Swap Point: $swapPoint<br>";

                for($geneIndex = 0; $geneIndex < $parent1->getChromosomeLength(); $geneIndex++){

                    if($geneIndex < $swapPoint){
                        $offspring1->setGene($geneIndex, $parent1->getGene($geneIndex));
                        $offspring2->setGene($geneIndex, $parent2->getGene($geneIndex));
                    }
                    else{
                        $offspring1->setGene($geneIndex, $parent2->getGene($geneIndex));
                        $offspring2->setGene($geneIndex, $parent1->getGene($geneIndex));

                    }
                }
                echo "Offspring1: $offspring1<br>";
                echo "Offspring2: $offspring2<br>";


                $newPopulation->addIndividual($offspring1);
                $newPopulation->addIndividual($offspring2);
            }
            else{
                echo "Added offspring unchanged: ".$parent1."<br>";
                echo "Added offsping unchanged: ".$parent2."<br>";
                $newPopulation->addIndividual($parent1);
                $newPopulation->addIndividual($parent2);
            }
            echo "-------------------------------------<br>";
        }

        return $newPopulation;
    }

    public function twoPointCrossover(Population $population){

    echo "Starting Two Point Crossover...<br>";

    $newPopulation = new Population($population->size());

    $individuals = $population->getIndividuals();

    for($i = 0; $i<$this->elitismCount; $i++){

        $newPopulation->addIndividual( $population->getFittestIndividual($i));
        echo "Added individual: ".$population->getFittestIndividual($i)."<br>";

    }

    while ($newPopulation->size() < $this->populationSize){

        if ($newPopulation->size() == $this->populationSize-1){

            $oddIndividual = array_pop($individuals);

            echo "Added remainder odd individual: ".$oddIndividual."<br>";
            $newPopulation->addIndividual($oddIndividual);

            echo "Original Population:<br> $population";
            echo "Crossed Population:<br> $newPopulation";

            return $newPopulation;

        }

        if(count($individuals) <= 0){

            echo "Original Population:<br> $population";
            echo "Crossed Population:<br> $newPopulation";

            return $newPopulation;
        }

        shuffle($individuals);

        $parent1 = array_pop($individuals);
        $parent2 = array_pop($individuals);
        echo "Parent 1: $parent1<br>";
        echo "Parent 2: $parent2<br>";


        if($this->crossoverRate > Random::generate() ){

            $offspring1 = new Individual();
            $offspring2 = new Individual();

            $swapPoint1 = rand(0,$parent1->getChromosomeLength()-2);
            $swapPoint2 = rand($swapPoint1+1, $parent1->getChromosomeLength()-1);

            echo "Swap Points: $swapPoint1, $swapPoint2<br>";

            for($geneIndex = 0; $geneIndex < $parent1->getChromosomeLength(); $geneIndex++){

                if($geneIndex < $swapPoint1 || $geneIndex > $swapPoint2 ){
                    $offspring1->setGene($geneIndex, $parent1->getGene($geneIndex));
                    $offspring2->setGene($geneIndex, $parent2->getGene($geneIndex));
                }
                else{
                    $offspring1->setGene($geneIndex, $parent2->getGene($geneIndex));
                    $offspring2->setGene($geneIndex, $parent1->getGene($geneIndex));
                }
            }

            echo "Offspring1: $offspring1<br>";
            echo "Offspring2: $offspring2<br>";


            $newPopulation->addIndividual($offspring1);
            $newPopulation->addIndividual($offspring2);
        }
        else{
            echo "Added offspring unchanged: ".$parent1."<br>";
            echo "Added offsping unchanged: ".$parent2."<br>";
            $newPopulation->addIndividual($parent1);
            $newPopulation->addIndividual($parent2);
        }

        echo "----------------------------------------<br>";
    }

    return $newPopulation;
}

    public function multiPointCrossover(Population $population, $numberOfSwapPoints){

        echo "Starting $numberOfSwapPoints Point Crossover...<br>";

        $newPopulation = new Population($population->size());

        $individuals = $population->getIndividuals();

        for($i = 0; $i<$this->elitismCount; $i++){

            $newPopulation->addIndividual( $population->getFittestIndividual($i));
            echo "Added individual: ".$population->getFittestIndividual($i)."<br>";

        }

        while ($newPopulation->size() < $this->populationSize){

            if ($newPopulation->size() == $this->populationSize-1){

                $oddIndividual = array_pop($individuals);

                echo "Added remainder odd individual: ".$oddIndividual."<br>";
                $newPopulation->addIndividual($oddIndividual);

                echo "Original Population:<br> $population";
                echo "Crossed Population:<br> $newPopulation";

                return $newPopulation;

            }

            if(count($individuals) <= 0){

                echo "Original Population:<br> $population";
                echo "Crossed Population:<br> $newPopulation";

                return $newPopulation;
            }

            shuffle($individuals);

            $parent1 = array_pop($individuals);
            $parent2 = array_pop($individuals);
            echo "Parent 1: $parent1<br>";
            echo "Parent 2: $parent2<br>";


            if($this->crossoverRate > Random::generate() ){

                $offspring1 = new Individual();
                $offspring2 = new Individual();

                $mask = $this->getMask($parent1, $numberOfSwapPoints);


                echo "Mask: <pre>";
                var_dump($mask);
                echo "</pre>";


                for($geneIndex = 0; $geneIndex < $parent1->getChromosomeLength(); $geneIndex++){

                    if($mask[$geneIndex] == 0 ){
                        $offspring1->setGene($geneIndex, $parent1->getGene($geneIndex));
                        $offspring2->setGene($geneIndex, $parent2->getGene($geneIndex));
                    }
                    else{
                        $offspring1->setGene($geneIndex, $parent2->getGene($geneIndex));
                        $offspring2->setGene($geneIndex, $parent1->getGene($geneIndex));
                    }
                }

                echo "Offspring1: $offspring1<br>";
                echo "Offspring2: $offspring2<br>";


                $newPopulation->addIndividual($offspring1);
                $newPopulation->addIndividual($offspring2);
            }
            else{
                echo "Added offspring unchanged: ".$parent1."<br>";
                echo "Added offsping unchanged: ".$parent2."<br>";
                $newPopulation->addIndividual($parent1);
                $newPopulation->addIndividual($parent2);
            }

            echo "----------------------------------------<br>";
        }

        return $newPopulation;
    }

    public function getMask(Individual $individual, $numberOfSwapPoints){

        $swapPoints = [0, $individual->getChromosomeLength()];

        for($i=0; $i < $numberOfSwapPoints; $i++){

            $swapPoint = rand(1,$individual->getChromosomeLength()-1);

            while (in_array($swapPoint, $swapPoints)){
                $swapPoint = rand(1,$individual->getChromosomeLength()-1);
            }

            $swapPoints[] = $swapPoint;
        }

        sort($swapPoints);


        echo "Swap Points:<br>";

        echo "<pre>";
        var_dump($swapPoints);
        echo "</pre>";

        $segments = [];

        for($geneIndex = 0; $geneIndex < $individual->getChromosomeLength(); $geneIndex++){

            for($i = 0; $i < count($swapPoints); $i++){

                if($geneIndex >= $swapPoints[$i] && $geneIndex <= $swapPoints[$i+1]){

                    $segments[$i][] = 0;
                    break;
                }
            }
        }

        $mask = [];
        foreach ($segments as $key => $segment) {


            foreach ($segment as $s) {
                if($key % 2 == 0){
                    $mask[] = 0;
                }
                else{
                    $mask[] = 1;
                }
            }

        }

        return $mask;
    }

    public function uniformMutation(Population $population){

        $newPopulation = new Population($population->size());

        for($populationIndex = 0; $populationIndex < $population->size(); $populationIndex++){

            $individual = $population->getFittestIndividual($populationIndex);


            $randomIndividual = new Individual(null, $this->element);
            $randomIndividual->generateRandom();


            for($geneIndex = 0; $geneIndex < $individual->getChromosomeLength(); $geneIndex++){

                if($populationIndex >= $this->elitismCount){
                    if($this->mutationRate > Random::generate()){

                        //echo "Mutating individual: $individual  Gene at locus: $geneIndex from {$individual->getGene($geneIndex)} to {$randomIndividual->getGene($geneIndex)}<br>";
                        $individual->setGene($geneIndex, $randomIndividual->getGene($geneIndex));
                    }

                }
            }

            $newPopulation->setIndividual($populationIndex,$individual);

        }

        return $newPopulation;
    }

    public function nonUniformMutation(Population $population){

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

    public function setSessionEnd(){

        $this->sessionEnd = date("Y-m-d H:i:s", time());

        $sql = "UPDATE session SET session_end='$this->sessionEnd' WHERE session_id=?";
        $params = [$this->session_id];
        $result = $this->db->query($sql, $params);

        if($result->error()){
            throw new Exception("Error updating session end time field in Session Table");
        }

        $sql = "UPDATE generation SET end_time='$this->sessionEnd' WHERE generation_id=?";
        $params = [$this->generation_id];
        $result = $this->db->query($sql, $params);

        if($result->error()){
            throw new Exception("Error updating generation end time field in Generation Table");
        }

    }
}
