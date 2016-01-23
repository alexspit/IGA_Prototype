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
    <select name="selection_operator">
        <option value="<?php echo Selection::ROULETTE; ?>">Roulette Wheel</option>
        <option value="<?php echo Selection::TOURNAMENT; ?>" selected>Tournament</option>
        <option value="<?php echo Selection::STOCHASTIC_UNIVERSAL_SAMPLING; ?>">Stochastic Universal Sampling</option>
    </select><br><br>

    <p>Tournament Size </p>
    <input type="text" class="config_range" id="tourny_size" name="tournament_size" min="0" max="100" value="20" step="5" data-postfix="%"/>
    <br>

    <p>Crossover Operator</p>
    <select name="crossover_operator">
        <option value="<?php echo Crossover::SINGLE_POINT; ?>">Single Point</option>
        <option value="<?php echo Crossover::TWO_POINT; ?>">Two Point</option>
        <option value="<?php echo Crossover::MULTI_POINT; ?>">Multi Point</option>
        <option value="<?php echo Crossover::UNIFORM; ?>" selected>Uniform</option>
    </select>
    <br><br>

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