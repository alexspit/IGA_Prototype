<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 1/17/2016
 * Time: 1:16 PM
 */
require_once "../core/init_process.php";


if(Input::exists()){

    if(Token::check(Input::get('token'))) {//protection against CSRF


        /*TODO: -Check if filtered values or null before saving!! (Check for nulls)
        *       -User token against CSRF
        */

        $args = [
            "population_size"      => [ "filter"    => FILTER_VALIDATE_INT,
                                        "flags"     => FILTER_NULL_ON_FAILURE,
                                        "options"   => ["min_range" => 4, "max_range" => 40]
                                    ],
            "max_generations"      => [ "filter"    => FILTER_VALIDATE_INT,
                                        "flags"     => FILTER_NULL_ON_FAILURE,
                                        "options"   => ["min_range" => 2, "max_range" => 50]
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

        if(Session::exists("user_id")) {

            $user_id = Session::get("user_id");
            $user = new User();
            $user->get($user_id);

            $ga = new GeneticAlgorithm();

            $clean["tournament_size"] = round(($clean["tournament_size"]/100) * $clean["population_size"] );

            $success = $ga->init($clean["population_size"], $clean["elitism_count"], $clean["max_generations"], $clean["selection_operator"], $clean["tournament_size"],
                                 $clean["crossover_operator"], $clean["crossover_rate"], $clean["mutation_operator"], $clean["mutation_rate"], $user);

            if($success){
                $currentPopulation = $ga->initPopulation();
                Redirect::to("../iga_interface.php");
            }
            else{
                Session::flash("init-error", "Error Generating new Population, please re-enter configuration settings");
                Redirect::to("../configuration.php");

            }
        }
        else{
            Session::flash("session-error", "Please re-enter your details");
            Redirect::to("../consent.php");
        }
    }

}


