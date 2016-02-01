<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 1/17/2016
 * Time: 1:06 PM
 */

require_once "includes/masterpage/header.php";

?>

<form method="post" action="process/initialize.php" name="configuration_form" id="configuration_form">
    <p>Population Size </p>
    <input type="text" class="config_range" id="pop_size" name="population_size" min="1" max="30" value="12" />
    <br>

    <p>Maximum Generations </p>
    <input type="text" class="config_range" id="max_gen" name="max_generations" min="1" max="120" value="10" />
    <br>

    <p>Elitism Count </p>
    <input type="text" class="config_range" id="elitism_count" name="elitism_count" min="0" max="5" value="1"  />
    <br>

    <p>Selection Operator</p>
    <select id="selection_operator" name="selection_operator">
        <option value="<?php echo Selection::ROULETTE; ?>" selected>Roulette Wheel</option>
        <option value="<?php echo Selection::TOURNAMENT; ?>" >Tournament</option>
        <option value="<?php echo Selection::STOCHASTIC_UNIVERSAL_SAMPLING; ?>">Stochastic Universal Sampling</option>
    </select><br><br>

    <div id="tournament_size_container">
        <p>Tournament Size </p>
        <input type="text" class="config_range" id="tourny_size" name="tournament_size" disabled min="0" max="100" value="20" step="5" data-postfix="%"/>
        <br>
    </div>


    <p>Crossover Operator</p>
    <select id="crossover_operator" name="crossover_operator">
        <option value="<?php echo Crossover::SINGLE_POINT; ?>">Single Point</option>
        <option value="<?php echo Crossover::TWO_POINT; ?>">Two Point</option>
        <option value="<?php echo Crossover::MULTI_POINT; ?>">Multi Point</option>
        <option value="<?php echo Crossover::UNIFORM; ?>" selected>Uniform</option>
    </select>
    <br><br>

    <div id="number_of_swap_points">
        <p>Number of Swap Points </p>
        <input type="text" class="config_range" id="swap_point_count" name="swap_point_count" disabled min="1" max="10" value="3" step="1" />
        <br>
    </div>


    <p>Crossover Rate</p>
    <input type="text" class="config_range" id="xover_rate" name="crossover_rate" min="0" max="100" value="85" data-postfix="%"/>
    <br>

    <p>Mutation Operator</p>
    <select name="mutation_operator">
        <option value="<?php echo Mutation::UNIFORM; ?>">Uniform</option>
        <option value="<?php echo Mutation::NON_UNIFORM; ?>">Non-Uniform</option>
    </select>
    <br><br>

    <p>Mutation Rate</p>
    <input type="text" class="config_range" id="mut_rate" name="mutation_rate" min="0" max="100" value="5" data-postfix="%"/>
    <br>


    <input type="submit" name="configuration_form_submit" value="Apply Configuration Settings">
</form>

<?php

require_once "includes/masterpage/footer.php"; ?>