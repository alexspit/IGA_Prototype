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

        $ga->init($clean["population_size"], $clean["elitism_count"], $clean["max_generations"], $clean["selection_operator"], $clean["tournament_size"],
            $clean["crossover_operator"], $clean["crossover_rate"], $clean["mutation_operator"], $clean["mutation_rate"], $user);

        $element = new Element("h1", 1);

        $element->addProperty(new Property(1, "color", ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"]));
        $element->addProperty(new Property(2, "text-align", ["center", "left", "right", "justified"]));
        $element->addProperty(new Property(3, "text-decoration", ["overline", "underline", "line-through"]));
        $element->addProperty(new Property(4, "font-family", ["Tangerine", "Inconsolata", "Droid Sans"]));
        $element->addProperty(new Property(5, "font-style", ["normal", "italic", "oblique"]));
        $element->addProperty(new Property(6, "font-weight", ["normal", "lighter", "bold"]));
        $element->addProperty(new Property(7, "letter-spacing", ["-3px", "-2px", "-1px", "0px", "1px", "2px", "3px"]));
        $element->addProperty(new Property(7, "background-color", ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"]));


        $currentPopulation = $ga->initPopulation($element);

        echo "<pre>";
        var_dump($currentPopulation);
        echo "</pre>";

    }
}






