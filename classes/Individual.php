<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26-Dec-15
 * Time: 18:26
 */

use JonnyW\PhantomJs\Client;

class Individual {

    private $chromosome;
    private $fitness;
    private $individual_id;
    private $image_path;
    private $db;


    /**
     * Creates a new instance of the Individual class or retrieves it from the database
     *
     * @param null $id If it is set, the new Individual creates is retrieved from the database
     * @param bool|false $new Create a new random Individual or retrieve it from database
     * @param null $user_id The user_id associated with the individual
     * @throws Exception
     */
    public function __construct($id = null, $new = false, $user_id = null)
    {
        $this->db = DB::getInstance();
        $this->chromosome = [];
        //$this->elements = $elements;

        if(!$new && !is_null($id)){

            $sql = "SELECT chromosome, image_path, fitness FROM individual WHERE individual_id=?";
            $params = [$id];

            $pdo = $this->db->query($sql, $params);

            $this->individual_id = $id;
            $this->image_path = $pdo->result()[0]->image_path;
            $this->fitness = $pdo->result()[0]->fitness;
            $this->chromosome = explode(",", $pdo->result()[0]->chromosome);

        }
        else if ($new && !is_null($id)){


            $sql = "SELECT sc.section FROM session s INNER JOIN section sc ON (s.session_id=sc.session_id) WHERE s.user_id = ? ORDER BY sc.section DESC LIMIT 1 ";
            $params = [$user_id];

            $pdo = $this->db->query($sql, $params);

            if(!$pdo->error()){

                $this->fitness = -1;
                $this->chromosome = $this->encode($pdo->result()[0]->section);
                //TODO: Find way to pass user_id like in save method
                $sql = "INSERT INTO individual (generation_id, chromosome, fitness) VALUES (?,?,?)";
                $params = [$id, implode(',',$this->chromosome), $this->fitness];
                $result = $this->db->query($sql, $params);

                if($result->error()){

                    throw new Exception("Error adding new Individual");

                }else{

                    $this->individual_id = $result->last_inserted_id;


                    if($this->captureImage($user_id)){

                        $sql = "UPDATE individual SET image_path='{$this->image_path}' WHERE individual_id=?";
                        $params = [$this->individual_id];
                        $result = $this->db->query($sql, $params);

                        if($result->error()){
                            throw new Exception("Error updating image_path field in Database");
                        }
                    }
                }
            }
            else{
                throw new Exception("Error getting current section");
            }
        }
    }

    /**
     * Encodes the interface array into a chromosome.
     *
     * @param int $section The section to work on.
     * @return array An encoded chromosome array.
     */
    private function encode($section){

        $locus = 0;

        $i = new Individual();

        $interface = $GLOBALS["interface"];

        switch ($section){
            case Section::HEADER:
                $interface = [$interface[Section::HEADER]];
                break;
            case Section::BODY:
                $interface = [$interface[Section::BODY]];
                break;
            case Section::FOOTER:
                $interface = [$interface[Section::FOOTER]];
                break;
        }

        foreach ($interface as $section => $sections) {

            foreach ($sections as $selector => $selectors) {

                foreach ($selectors as $property => $properties) {
                    //Picking a random index from the properties
                    $randomIndex = rand(0,count($properties)-1);
                    $i->setGene($locus, $randomIndex);
                    $locus++;
                }
            }
        }

        return $i->getChromosome();
    }

    /**
     *
     *
     * @param $generation_id
     * @param null $user_id
     * @throws Exception
     */
    public function save($generation_id, $user_id = null){
        $sql = "INSERT INTO individual (generation_id, chromosome) VALUES (?,?)";
        $params = [$generation_id, implode(',',$this->chromosome)];
        $result = $this->db->query($sql, $params);

        if($result->error()){

            throw new Exception("Error adding new Individual");

        }else{

            $this->individual_id = $result->last_inserted_id;

            if($this->captureImage($user_id) || file_exists(__DIR__."/thumbnails/individual_".$this->individual_id.".jpg")){

                $sql = "UPDATE individual SET image_path='{$this->image_path}' WHERE individual_id=?";
                $params = [$this->individual_id];
                $result = $this->db->query($sql, $params);

                if($result->error()){
                    throw new Exception("Error updating image_path field in Database");
                }
            }
            else{
                setcookie("capture_error", "Error capturing screenshot of individual");
            }
        }
    }

    /**
     * @param $section
     */
    public function generateRandom($section){

        $this->chromosome = $this->encode($section);

    }

    /**
     * Captures a screenshot of an Individual Interface
     *
     * @param null $user_id The current user
     * @return bool True if the status code is between 200 and 300, False otherwise
     */
    public function captureImage($user_id = null){

        $client = Client::getInstance();
        $client->getEngine()->setPath('C:/xampp/htdocs/IGA_Prototype/bin/phantomjs.exe');

        $requestPath = 'http://localhost/IGA_Prototype/individual_interface.php?id='.$this->individual_id;
        if(!is_null($user_id)){
            $requestPath .= "&user_id=$user_id";
        }

        $request  = $client->getMessageFactory()->createCaptureRequest($requestPath);
        $response = $client->getMessageFactory()->createResponse();

        $imagePath = '../thumbnails/individual_'.$this->individual_id.'.jpg';

        $top    = 0;
        $left   = 0;
        $width  = 1600;
        $height = 1150;

        $request->setViewportSize($width, $height);
        $request->setCaptureDimensions($width, $height, $top, $left);
        //$request->setDelay(200);

        $request->setOutputFile($imagePath);

        $response = $client->send($request, $response);

        $this->image_path = 'thumbnails/individual_'.$this->individual_id.'.jpg';

        return $response->getStatus() >= 200 && $response->getStatus() < 300;

    }

    /**
     * @return array
     */
    public function getChromosome(){

        return $this->chromosome;
    }

    /**
     * @return int
     */
    public function getChromosomeLength(){

        return count($this->chromosome);
    }

    /**
     * @param $locus
     * @param $gene
     */
    public function setGene($locus, $gene){

        $this->chromosome[$locus] = $gene;
    }

    /**
     * @param $locus
     * @return mixed
     */
    public function getGene($locus){

        return $this->chromosome[$locus];
    }

    /**
     * @return int
     */
    public function getFitness()
    {
        return $this->fitness;
    }

    /**
     * @param $fitness
     * @param $persistInDB
     * @throws Exception
     */
    public function setFitness($fitness, $persistInDB)
    {
        $this->fitness = $fitness;

        if($persistInDB){

            $sql = "UPDATE individual SET fitness='{$this->fitness}' WHERE individual_id=?";
            $params = [$this->individual_id];
            $result = $this->db->query($sql, $params);

            if($result->error()){
                throw new Exception("Error updating fitness field for Individual");
            }
        }


    }

    /**
     * @param array $chromosome
     */
    public function setChromosome(array $chromosome){
        $this->chromosome = $chromosome;
    }


    /**
     * @return mixed
     */
    public function getIndividualId()
    {
        return $this->individual_id;
    }

    /**
     * @param mixed $individual_id
     */
    public function setIndividualId($individual_id)
    {
        $this->individual_id = $individual_id;
    }

    /**
     * @return mixed
     */
    public function getImagePath()
    {
        return $this->image_path;
    }

    /**
     * @param mixed $image_path
     */
    public function setImagePath($image_path)
    {
        $this->image_path = $image_path;
    }


    /**
     * @return string
     */
    public function __toString(){
        $output = "";

        for($gene = 0; $gene< $this->getChromosomeLength(); $gene++){

            $output .= $this->getChromosome()[$gene].", ";
        }

        return "$output ID: {$this->getIndividualId()} Fitness: {$this->getFitness()}";
    }





} 