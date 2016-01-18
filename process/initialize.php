<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 1/17/2016
 * Time: 1:16 PM
 */
require_once "../core/init_process.php";


if($_POST){


    /*TODO: -Check if filtered values or null before saving!! (Check for nulls)
    *       -User token against CSRF
    */

    $args = [
        "population_size"      => [ "filter"    => FILTER_VALIDATE_INT,
                                    "flags"     => FILTER_NULL_ON_FAILURE,
                                    "options"   => ["min_range" => 1, "max_range" => 30]
                                ],
        "max_generations"      => [ "filter"    => FILTER_VALIDATE_INT,
                                    "flags"     => FILTER_NULL_ON_FAILURE,
                                    "options"   => ["min_range" => 1, "max_range" => 100]
                                ],
        "elitism_count"        => [ "filter"    => FILTER_VALIDATE_INT,
                                    "flags"     => FILTER_NULL_ON_FAILURE,
                                    "options"   => ["min_range" => 0, "max_range" => 5]
                                ],
        "selection_operator"   => [ "filter"    => FILTER_VALIDATE_INT,
                                    "flags"     => FILTER_NULL_ON_FAILURE,
                                ],
        "tournament_size"      => [ "filter"    => FILTER_VALIDATE_INT,
                                    "flags"     => FILTER_NULL_ON_FAILURE,
                                    "options"   => ["min_range" => 0, "max_range" => 100]
                                ],
        "crossover_operator"   => [ "filter"    => FILTER_VALIDATE_INT,
                                    "flags"     => FILTER_NULL_ON_FAILURE,
                                ],
        "crossover_rate"       => [ "filter"    => FILTER_VALIDATE_INT,
                                    "flags"     => FILTER_NULL_ON_FAILURE,
                                    "options"   => ["min_range" => 0, "max_range" => 100]
                                ],
        "mutation_operator"    => [ "filter"    => FILTER_VALIDATE_INT,
                                    "flags"     => FILTER_NULL_ON_FAILURE,
                                ],
        "mutation_rate"        => [ "filter"    => FILTER_VALIDATE_INT,
                                    "flags"     => FILTER_NULL_ON_FAILURE,
                                    "options"   => ["min_range" => 0, "max_range" => 100]
                                ],
    ];

    $clean = filter_input_array(INPUT_POST, $args);

    //check if null, ect

    if(isset($_SESSION['user_id'])) {

        $user_id = $_SESSION['user_id'];
        $user = new User();
        $user->get($user_id);

        $ga = new GeneticAlgorithm();

        $clean["tournament_size"] = round(($clean["tournament_size"]/100) * $clean["population_size"] );

        $ga->init($clean["population_size"], $clean["elitism_count"], $clean["max_generations"], $clean["selection_operator"], $clean["tournament_size"],
            $clean["crossover_operator"], $clean["crossover_rate"], $clean["mutation_operator"], $clean["mutation_rate"], $user);

        $currentPopulation = $ga->initPopulation();

        Redirect::to("../iga_interface.php");


    }
}






