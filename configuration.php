<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 1/17/2016
 * Time: 1:06 PM
 */

require_once "includes/masterpage/header.php";

if(!Session::exists("user_id")){
    Redirect::to("consent.php");
}

?>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="#"> Interactive Web Interface Evolution </a>

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <li class="hidden">
                        <a href="#">Configuration</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav pull-right">

                    <li class="">
                        <a id="submit_config_form" class="active" href="">Apply Configuration Settings</a>
                    </li>

                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

    <h1 id="config_title">Genetic Algorithm Configuration</h1>

    <div class="row">
        <div class="col-lg-5"></div>
        <div class="col-lg-2">
            <i id="loader" class="fa fa-cog fa-spin pull-right"></i>
        </div>
        <div class="col-lg-5"></div>
    </div>


    <form method="post" action="process/initialize.php" name="configuration_form" id="configuration_form">

        <?php if(Session::exists("init-error")){ echo '<p class="bg-danger">'.Session::flash("init-error").'</p>'; } ?>

        <div class="form-group">
            <label for="pop_size">Population Size</label>
            <input type="text" class="config_range form-control" id="pop_size" name="population_size" min="4" max="40" step="4" value="12" />
        </div>

        <div class="form-group">
            <label for="max_gen">Maximum Generations</label>
            <input type="text" class="config_range form-control" id="max_gen" name="max_generations" min="2" max="50" value="10" />
        </div>

        <div class="form-group">
            <label for="elitism_count">Elitism Count</label>
            <input type="text" class="config_range form-control" id="elitism_count" name="elitism_count" min="0" max="5" value="1"  />
        </div>

        <div class="form-group">
            <label for="selection_operator">Selection Operator</label>
            <select class="form-control" id="selection_operator" name="selection_operator">
                <option value="<?php echo Selection::ROULETTE; ?>" selected>Roulette Wheel</option>
                <option value="<?php echo Selection::TOURNAMENT; ?>" >Tournament</option>
                <option value="<?php echo Selection::STOCHASTIC_UNIVERSAL_SAMPLING; ?>">Stochastic Universal Sampling</option>
            </select>
        </div>

        <div class="form-group" id="tournament_size_container">
            <label for="tourny_size">Tournament Size</label>
            <input type="text" class="config_range form-control" id="tourny_size" name="tournament_size" disabled min="0" max="100" value="20" step="5" data-postfix="%"/>
        </div>

        <div class="form-group">
            <label for="crossover_operator">Crossover Operator</label>
            <select class="form-control" id="crossover_operator" name="crossover_operator">
                <option value="<?php echo Crossover::SINGLE_POINT; ?>">Single Point</option>
                <option value="<?php echo Crossover::TWO_POINT; ?>">Two Point</option>
                <option value="<?php echo Crossover::MULTI_POINT; ?>">Multi Point</option>
                <option value="<?php echo Crossover::UNIFORM; ?>" selected>Uniform</option>
            </select>
        </div>

        <div class="form-group" id="number_of_swap_points">
            <label for="swap_point_count">Number of Swap Points </label>
            <input type="text" class="config_range form-control" id="swap_point_count" name="swap_point_count" disabled min="1" max="10" value="3" step="1" />
        </div>

        <div class="form-group">
            <label for="xover_rate">Crossover Rate</label>
            <input type="text" class="config_range form-control" id="xover_rate" name="crossover_rate" min="0" max="100" value="85" data-postfix="%"/>
        </div>

        <div class="form-group">
            <label for="mutation_operator">Mutation Operator</label>
            <select class="form-control" id="mutation_operator" name="mutation_operator">
                <option value="<?php echo Mutation::UNIFORM; ?>">Uniform</option>
                <option value="<?php echo Mutation::NON_UNIFORM; ?>">Non-Uniform</option>
            </select>
        </div>

        <div class="form-group">
            <label for="mut_rate">Mutation Rate</label>
            <input type="text" class="config_range form-control" id="mut_rate" name="mutation_rate" min="0" max="100" value="5" data-postfix="%"/>
        </div>

        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

        <input type="submit" id="config_submit_btn" class="hidden" name="configuration_form_submit" value="Apply Configuration Settings">
    </form>

<?php require_once "includes/masterpage/footer.php"; ?>