<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27-Dec-15
 * Time: 02:16
 */

class GeneticAlgorithm {

    private $session_id;
    private $section;
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

    /**
     * Creates a new instance of the GeneticAlgorithm class, if a user_id is supplied it will retrieve the data associated with the id
     *
     * @param null $user_id
     */
    public function __construct($user_id = null)
    {
        $this->db = DB::getInstance();

        if (!is_null($user_id)){

            $sql = "SELECT sc.section, s.population_size, s.elitism_count, s.max_generations, s.selection_operator, s.tournament_size,
                s.crossover_operator, g.crossover_rate, s.mutation_operator, g.mutation_rate, g.generation_number, s.user_id, s.session_id, g.generation_id
                FROM session s INNER JOIN generation g ON (s.session_id = g.session_id) INNER JOIN section sc ON (s.session_id = sc.session_id)
                WHERE s.user_id = ? ORDER BY g.generation_id DESC, sc.section DESC LIMIT 1 ";
            $param = [$user_id];

            $pdo = $this->db->query($sql, $param);

            if($pdo->count() > 0){
                $this->session_id =$pdo->result()[0]->session_id;
                $this->section = $pdo->result()[0]->section;
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

    /**
     * Initialize the class by passing all the data, which is inserted in the DB.
     *
     * @param int $populationSize The population size for each generation
     * @param int $elitismCount The number of individuals to be kept unaltered for the next generation
     * @param int $maxGenerations The number of iterations
     * @param int $selectionOperator The selection operator to be used for the algorithm
     * @param int $tournamentSize The tournament size incase the tournament operator is chosen
     * @param int $crossoverOperator The crossover operator to be used for the algorithm
     * @param int $crossoverRate The percentage of individuals to undergo crossover
     * @param int $mutationOperator The mutation operator to be user for the algorithm
     * @param int $mutationRate The percentage chance for a particular gene to undergo mutation
     * @param User $user The user associated with the current session
     * @return bool If there class was initialized correctly
     * @throws Exception
     */
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

            $this->section = Section::HEADER;

            $sql = "INSERT INTO section (section, session_id) VALUES (?,?)";
            $params = [$this->section, $this->session_id];

            $result = $this->db->query($sql, $params);

            if($result->error()){
                throw new Exception("Error adding new Section");
            }
            else{
                $sql = "INSERT INTO generation (session_id, section, generation_number, crossover_rate, mutation_rate, start_time) VALUES (?,?,?,?,?,?)";
                $params = [$this->session_id, $this->section, $this->generationNumber, $this->crossoverRate, $this->mutationRate, $this->sessionStart];

                $result = $this->db->query($sql, $params);

                if($result->error()){
                    throw new Exception("Error adding new Generation");
                }
                else{
                    $this->generation_id = $result->last_inserted_id;
                    return true;

                }
            }
        }
    }

    /**
     * Initializes a new generation
     *
     * @throws Exception
     */
    public function initGeneration(){

        $generationStart = date("Y-m-d H:i:s", time());
        $this->generationNumber = 1;
        $sql = "INSERT INTO generation (session_id, section, generation_number, crossover_rate, mutation_rate, start_time) VALUES (?,?,?,?,?,?)";
        $params = [$this->session_id, $this->section, $this->generationNumber, $this->crossoverRate, $this->mutationRate, $generationStart];

        $result = $this->db->query($sql, $params);

        if($result->error()){
            throw new Exception("Error adding new Generation");
        }
        else{
            $this->generation_id = $result->last_inserted_id;
        }
        //return new Population($this->populationSize, $this->generation_id, $this->user->getUserId());
    }

    /**
     * Initializes a new population
     *
     * @return Population A new population
     */
    public function initPopulation(){

        return new Population($this->populationSize, $this->generation_id, $this->user->getUserId());
    }

    /**
     * Gets an Individual object and decodes it's chromosome and returns a CSS string
     *
     * @param Individual $i The individual to be decoded
     * @param null $headerOrder Variable for header nav order
     * @param null $footerOrder Variable for category position
     * @param null $categoryPosition Variable for footer order
     * @return string A decoded CSS string
     */
    public function decode(Individual $i, &$headerOrder = null, &$footerOrder = null, &$categoryPosition = null){

        $css = "";
        $geneIndex = 0;

        $interface = $GLOBALS["interface"];

        switch ($this->section){
            case Section::HEADER:
                $interface = [Section::HEADER => $interface[Section::HEADER]];
                    break;
            case Section::BODY:
                $interface = [Section::HEADER => $interface[Section::HEADER], Section::BODY =>$interface[Section::BODY]];
                $headerChromosome = $this->getSectionChromosome(Section::HEADER);
                $currentChromosome = $i->getChromosome();
                $combinedChromosome = explode(",", $headerChromosome.",".implode(",", $currentChromosome));
                $i->setChromosome($combinedChromosome);
                    break;
            case Section::FOOTER:
                $headerChromosome = $this->getSectionChromosome(Section::HEADER);
                $bodyChromosome = $this->getSectionChromosome(Section::BODY);
                $currentChromosome = $i->getChromosome();
                $combinedChromosome = explode(",",$headerChromosome.",".$bodyChromosome.",".implode(",", $currentChromosome));
                $i->setChromosome($combinedChromosome);
                break;
        }

        foreach ($interface as $section => $sections) {


            foreach ($sections as $selector => $selectors) {

                $css .= "$selector {".PHP_EOL;

                foreach ($selectors as $property => $properties) {


                    foreach ($properties as $key => $value) {



                        if($key == $i->getGene($geneIndex)){

                            if($property == "order" || $property == "position"){

                                if($section == Section::HEADER){
                                    $headerOrder = explode(",", $value);
                                }
                                if($section == Section::BODY){
                                    $categoryPosition = $value;
                                }
                                if($section == Section::FOOTER){
                                    $footerOrder = explode(",", $value);
                                }
                                break;
                            }
                            //echo "Match!<br>";
                            $css .= "$property : $value !important;".PHP_EOL;
                            break;
                        }
                    }
                    $geneIndex++;
                }
                $css .= "}".PHP_EOL;
            }
        }

        return $css;

    }

    /**
     * Gets the current population from the database
     *
     * @return Population The current population
     */
    public function currentPopulation(){

        $sql = "SELECT i.individual_id FROM individual i
                INNER JOIN generation g ON (i.generation_id = g.generation_id)
                INNER JOIN session s ON (g.session_id = s.session_id)
                INNER JOIN user u ON (s.user_id = u.user_id)
                WHERE u.user_id = ? AND g.generation_number = ? AND g.section= ?";
        $param = [$this->user->getUserId(), $this->generationNumber, $this->section];

        $pdo = $this->db->query($sql, $param);

        $currentPopulation = new Population($this->populationSize);

        foreach ($pdo->result() as $i) {
            $currentPopulation->addIndividual(new Individual($i->individual_id, false));
        }

        return $currentPopulation;

    }

    /**
     * Evaluates a population by assigning the user's ratings the each individual
     *
     * @param Population $population The current population
     * @param array $ratings The ratings array posted by the user
     * @return Population An evaluated population
     * @throws Exception
     */
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

    /**
     * Sends the algorithm to the next generation phase
     *
     * @param Population $population The current population
     * @throws Exception
     */
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
            $sql = "INSERT INTO generation (session_id, section, generation_number, crossover_rate, mutation_rate, start_time) VALUES (?,?,?,?,?,?)";
            $params = [$this->session_id, $this->section, $this->generationNumber, $this->crossoverRate, $this->mutationRate, date("Y-m-d H:i:s", time())];
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
                    $individual->save($this->generation_id, $this->user->getUserId());
                }

            }
    }

    /**
     * Checks if the current generation number is the same as the maximum generations number supplied by the researcher
     *
     * @return bool If the termination condition is met
     */
    public function terminationConditionMet(){

        return $this->generationNumber == $this->maxGenerations;
    }

    //--Genetic Operators--//

    /**
     * Selection method, checks which particular operator was chosen and calls it.
     *
     * @param Population $population The current population
     * @return null|Population The mating pool, null on failure
     */
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

    /**
     * Crossover method, checks which particular operator was chosen and calls it.
     *
     * @param Population $population The current population
     * @return null|Population Crossed population, null on failure.
     */
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

    /**
     * Mutation method, checks which particular operator was chosen and calls it.
     *
     * @param Population $population The current population
     * @return null|Population Mutated population, null of failure
     */
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

    //--Selection Operators--//

    /**
     * Applies the Roulette Wheel selection operator to select individuals
     *
     * @param Population $population The evaluated population to be selected
     * @return Population The mating pool
     */
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
        }

        //Selecting the rest of the individuals for the mating pool
        for ($i = 0; $i< $population->size() - $this->elitismCount; $i++){

            $tmpFitness= 0;
            $rouletteWheelPosition = rand(0, ($populationFitness*1000))/1000;

            foreach ($individuals as $individual) {
                $tmpFitness += $individual->getFitness();

                if($tmpFitness >= $rouletteWheelPosition){
                    $matingPool->addIndividual($individual);
                    break;
                }
            }

        }

        return $matingPool;

    }


    /**
     * Applies the Stochastic Universal Sampling algorithm to select individuals proportionally.
     *
     * @param Population $population The evaluated population to be selected.
     * @return Population The Mating Pool.
     */
    public function stochasticUniversalSampling(Population $population){

        //Cloning population
        $tmpPopulation = $population->getClone();
        $pointers = [];
        $matingPool = new Population($population->size());

        //Setting the fitness relative to a total of 1.0
        foreach ($tmpPopulation->getIndividuals() as $individual) {
            $individual->setFitness($individual->getFitness()/$population->getPopulationFitness(), false);
        }

        //Creating array of pointers

        //Size of pointer
        $pointerSize = 1/$tmpPopulation->size();
        //Starting pointer position
        $rndStartingPoint = rand(0, $pointerSize*1000)/1000;

        //Adding first pointer
        $pointers[] = $rndStartingPoint;

        //Adding the rest of the pointers
        for($i = 0; $i < $tmpPopulation->size()-1; $i++){

            $rndStartingPoint += $pointerSize;
            $pointers[] = $rndStartingPoint;
        }

        $fitnessCount = 0;
        foreach ($tmpPopulation->getIndividuals() as $individual) {

            foreach ($pointers as $key => $pointer) {

                if($pointer >= $fitnessCount && $pointer < ($individual->getFitness() + $fitnessCount)){
                    $matingPool->addIndividual($individual);
                }
            }

            $fitnessCount += $individual->getFitness();
        }
        return $matingPool;
    }

    /**
     * Applies tournament selection on the given population and selects individuals to add to the mating pool
     *
     * @param Population $population The evaluated population to be selected
     * @return Population The mating pool
     */
    public function tournamentSelection(Population $population){

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

            $tournamentPopulation->orderedByFittest();
            $matingPool->addIndividual($tournamentPopulation->getIndividual(0));
        }

        return $matingPool;
    }

    //--Crossover Operators--//

    /**
     * Applies uniform crossover on the mating pool and returns a crossed population
     *
     * @param Population $population The mating pool to be crossed
     * @return Population The crossed population
     */
    public function uniformCrossover(Population $population){

        $newPopulation = new Population($population->size());

        $individuals = $population->getIndividuals();

        for($i = 0; $i<$this->elitismCount; $i++){

            $newPopulation->addIndividual( $population->getFittestIndividual($i));
        }

        while ($newPopulation->size() < $this->populationSize){

            if ($newPopulation->size() == $this->populationSize-1){

                $oddIndividual = array_pop($individuals);

                $newPopulation->addIndividual($oddIndividual);

                return $newPopulation;
            }

            if(count($individuals) <= 0){
                return $newPopulation;
            }

            shuffle($individuals);

            $parent1 = array_pop($individuals);
            $parent2 = array_pop($individuals);

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

                $newPopulation->addIndividual($offspring1);
                $newPopulation->addIndividual($offspring2);

            }
            else{
                $newPopulation->addIndividual($parent1);
                $newPopulation->addIndividual($parent2);
            }

        }

        return $newPopulation;
    }

    /**
     * Applies single point crossover on the mating pool and returns a crossed population
     *
     * @param Population $population The mating pool to be crossed
     * @return Population The crossed population
     */
    public function singlePointCrossover(Population $population){

        $newPopulation = new Population($population->size());

        $individuals = $population->getIndividuals();

        for($i = 0; $i<$this->elitismCount; $i++){

            $newPopulation->addIndividual( $population->getFittestIndividual($i));
        }

        while ($newPopulation->size() < $this->populationSize){

            if ($newPopulation->size() == $this->populationSize-1){

                $oddIndividual = array_pop($individuals);

                $newPopulation->addIndividual($oddIndividual);

                return $newPopulation;

            }

            if(count($individuals) <= 0){
                return $newPopulation;
            }

            shuffle($individuals);

            $parent1 = array_pop($individuals);
            $parent2 = array_pop($individuals);

            if($this->crossoverRate > Random::generate()){

                $offspring1 = new Individual();
                $offspring2 = new Individual();

                $swapPoint = rand(1,$parent1->getChromosomeLength()-1);

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

                $newPopulation->addIndividual($offspring1);
                $newPopulation->addIndividual($offspring2);
            }
            else{

                $newPopulation->addIndividual($parent1);
                $newPopulation->addIndividual($parent2);
            }
        }

        return $newPopulation;
    }

    /**
     * Applies two point crossover on the mating pool and returns a crossed population
     *
     * @param Population $population The mating pool to be crossed
     * @return Population The crossed population
     */
    public function twoPointCrossover(Population $population){

        $newPopulation = new Population($population->size());

        $individuals = $population->getIndividuals();

        for($i = 0; $i<$this->elitismCount; $i++){
            $newPopulation->addIndividual( $population->getFittestIndividual($i));
        }

        while ($newPopulation->size() < $this->populationSize){

            if ($newPopulation->size() == $this->populationSize-1){

                $oddIndividual = array_pop($individuals);
                $newPopulation->addIndividual($oddIndividual);

                return $newPopulation;
            }

            if(count($individuals) <= 0){
                return $newPopulation;
            }

            shuffle($individuals);

            $parent1 = array_pop($individuals);
            $parent2 = array_pop($individuals);

            if($this->crossoverRate > Random::generate() ){

                $offspring1 = new Individual();
                $offspring2 = new Individual();

                $swapPoint1 = rand(0,$parent1->getChromosomeLength()-2);
                $swapPoint2 = rand($swapPoint1+1, $parent1->getChromosomeLength()-1);

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

                $newPopulation->addIndividual($offspring1);
                $newPopulation->addIndividual($offspring2);
            }
            else{
                $newPopulation->addIndividual($parent1);
                $newPopulation->addIndividual($parent2);
            }
        }
        return $newPopulation;
    }

    /**
     * Applies multipoint crossover on the mating pool and returns a crossed population
     *
     * @param Population $population The mating pool to be crossed
     * @param int $numberOfSwapPoints The number of swap points to used
     * @return Population The crossed population
     */
    public function multiPointCrossover(Population $population, $numberOfSwapPoints){

        $newPopulation = new Population($population->size());

        $individuals = $population->getIndividuals();

        for($i = 0; $i<$this->elitismCount; $i++){
            $newPopulation->addIndividual( $population->getFittestIndividual($i));
        }

        while ($newPopulation->size() < $this->populationSize){

            if ($newPopulation->size() == $this->populationSize-1){

                $oddIndividual = array_pop($individuals);
                $newPopulation->addIndividual($oddIndividual);

                return $newPopulation;
            }

            if(count($individuals) <= 0){
                return $newPopulation;
            }

            shuffle($individuals);

            $parent1 = array_pop($individuals);
            $parent2 = array_pop($individuals);

            if($this->crossoverRate > Random::generate() ){

                $offspring1 = new Individual();
                $offspring2 = new Individual();

                $mask = $this->getMask($parent1, $numberOfSwapPoints);

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

                $newPopulation->addIndividual($offspring1);
                $newPopulation->addIndividual($offspring2);
            }
            else{
                $newPopulation->addIndividual($parent1);
                $newPopulation->addIndividual($parent2);
            }
        }

        return $newPopulation;
    }

    //--Mutation Operators--//

    /**
     * Applies the uniform mutation operator on a population and returns a mutated population
     *
     * @param Population $population A population to be mutated
     * @return Population A mutated population
     */
    public function uniformMutation(Population $population){

        $newPopulation = new Population($population->size());

        for($populationIndex = 0; $populationIndex < $population->size(); $populationIndex++){

            $individual = $population->getFittestIndividual($populationIndex);

            $randomIndividual = new Individual();
            $randomIndividual->generateRandom($this->section);

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

    /**
     * @param Population $population
     */
    public function nonUniformMutation(Population $population){

    }

    //--Other functions--//

    /**
     * Method to be used in multipoint crossover operator. Generates a mask of swap points for an individual
     *
     * @param Individual $individual Individual to create a mask from
     * @param $numberOfSwapPoints Number of swap points
     * @return array The mask as an array
     */
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

    /**
     * Increments the generation number
     *
     */
    public function incrementGeneration(){
        $this->generationNumber++;
    }

    /**
     * Gets the generation number
     *
     * @return int The Generation number
     */
    public function getGenerationNumber(){
        return $this->generationNumber;
    }

    /**
     * Gets the session ID
     *
     * @return int The session ID
     */
    public function getSessionID(){
        return $this->session_id;
    }

    /**
     * Gets the generation ID
     *
     * @return int The generation ID
     */
    public function getGenerationID(){
        return $this->generation_id;
    }

    //--Getters and Setters--//

    /**
     * Sets the session end timestamp in the database
     *
     * @throws Exception
     */
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

    /**
     * Sets the generation end timestamp in the database
     *
     * @throws Exception
     */
    public function setGenerationEnd(){

        $this->sessionEnd = date("Y-m-d H:i:s", time());

        $sql = "UPDATE generation SET end_time='$this->sessionEnd' WHERE generation_id=?";
        $params = [$this->generation_id];
        $result = $this->db->query($sql, $params);

        if($result->error()){
            throw new Exception("Error updating generation end time field in Generation Table");
        }

    }

    /**
     * Gets the current section
     *
     * @return int The current section
     */
    public function getCurrentSection(){
        return $this->section;
    }

    /**
     * Sets the section
     *
     * @param int $section The current section
     * @throws Exception
     */
    public function setSection($section){

        $this->section = $section;

        $sql = "INSERT INTO section (section, session_id) VALUES (?,?)";
        $params = [$this->section, $this->session_id];

        $result = $this->db->query($sql, $params);

        if($result->error()){
            throw new Exception("Error adding new Section");
        }

    }

    /**
     * Sets the final chromosome for a particular section
     *
     * @param Individual $i The fittest individual from the last generation
     * @throws Exception
     */
    public function setSectionChromosome(Individual $i){
        $sql = "UPDATE section SET chromosome='".implode(",",$i->getChromosome())."' WHERE session_id=? AND section =?";
        $params = [$this->session_id, $this->section];
        $result = $this->db->query($sql, $params);

        if($result->error()){
            throw new Exception("Error updating section chromosome");
        }
    }

    /**
     * Gets the chromosome associated with a particular section from the database
     *
     * @param int $section The current section
     * @return string The chromosome stored in the database as a string
     */
    public function getSectionChromosome($section){

        $sql = "SELECT chromosome FROM section WHERE session_id=? AND section=?";
        $param = [$this->session_id, $section];

        $pdo = $this->db->query($sql, $param);

        if($pdo->count() > 0) {
            return $pdo->result()[0]->chromosome;
        }
    }

    /**
     * Gets the section name
     *
     * @return string The section name
     */
    public function getCurrentSectionName(){

        switch ($this->section){

            case Section::HEADER:
                return "Header";
            case Section::BODY:
                return "Body";
            case Section::FOOTER:
                return "Footer";
            default:
                return "No Section";
        }
    }

    /**
     * @return mixed
     */
    public function getMaxGenerations(){
        return $this->maxGenerations;
    }

    /**
     * @return mixed
     */
    public function getSelectionOperator(){
        return $this->selectionOperator;
    }

    /**
     * @return mixed
     */
    public function getCrossoverOperator()
    {
        return $this->crossoverOperator;
    }

    /**
     * @return mixed
     */
    public function getCrossoverRate()
    {
        return $this->crossoverRate;
    }

    /**
     * @return mixed
     */
    public function getMutationOperator()
    {
        return $this->mutationOperator;
    }

    /**
     * @return mixed
     */
    public function getMutationRate()
    {
        return $this->mutationRate;
    }

    /**
     * @return mixed
     */
    public function getTournamentSize()
    {
        return $this->tournamentSize;
    }

    /**
     * @return mixed
     */
    public function getElitismCount()
    {
        return $this->elitismCount;
    }

    /**
     * @return mixed
     */
    public function getPopulationSize()
    {
        return $this->populationSize;
    }




}
