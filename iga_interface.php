<?php
include_once "includes/masterpage/header.php";

$user_id = Session::get("user_id");

$ga = new GeneticAlgorithm($user_id);

if(is_null($ga->getSessionID())){
    Redirect::to("consent.php");
}

$currentPopulation = $ga->currentPopulation();


$currentPopulation->shuffle();


?>

    <div class="modal fade" id="configModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Genetic Algorithm Configuration</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="process/initialize.php" name="configuration_form" id="configuration_form">

                        <div class="form-group">
                            <label for="selection_operator">Selection Operator</label>
                            <select class="form-control" id="selection_operator" name="selection_operator" disabled>
                                <option value="<?php echo Selection::ROULETTE; ?>" <?php if($ga->getSelectionOperator() == Selection::ROULETTE){echo "selected";} ?>>Roulette Wheel</option>
                                <option value="<?php echo Selection::TOURNAMENT; ?>" <?php if($ga->getSelectionOperator() == Selection::TOURNAMENT){echo "selected";} ?>>Tournament</option>
                                <option value="<?php echo Selection::STOCHASTIC_UNIVERSAL_SAMPLING; ?>" <?php if($ga->getSelectionOperator() == Selection::STOCHASTIC_UNIVERSAL_SAMPLING){echo "selected";} ?>>Stochastic Universal Sampling</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="crossover_operator">Crossover Operator</label>
                            <select class="form-control" id="crossover_operator" name="crossover_operator" disabled>
                                <option value="<?php echo Crossover::SINGLE_POINT; ?>" <?php if($ga->getCrossoverOperator() == Crossover::SINGLE_POINT){echo "selected";} ?>>Single Point</option>
                                <option value="<?php echo Crossover::TWO_POINT; ?>" <?php if($ga->getCrossoverOperator() == Crossover::TWO_POINT){echo "selected";} ?>>Two Point</option>
                                <option value="<?php echo Crossover::MULTI_POINT; ?>" <?php if($ga->getCrossoverOperator() == Crossover::MULTI_POINT){echo "selected";} ?>>Multi Point</option>
                                <option value="<?php echo Crossover::UNIFORM; ?>" <?php if($ga->getCrossoverOperator() == Crossover::UNIFORM){echo "selected";} ?>>Uniform</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="xover_rate">Crossover Rate</label>
                            <input type="text" class="config_range form-control" id="xover_rate" name="crossover_rate" min="0" max="100" value="<?php echo $ga->getCrossoverRate()*100; ?>" data-postfix="%"/>
                        </div>

                        <div class="form-group">
                            <label for="mutation_operator">Mutation Operator</label>
                            <select class="form-control" id="mutation_operator" name="mutation_operator" disabled>
                                <option value="<?php echo Mutation::UNIFORM; ?>">Uniform</option>
                                <option value="<?php echo Mutation::NON_UNIFORM; ?>">Non-Uniform</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="mut_rate">Mutation Rate</label>
                            <input type="text" class="config_range form-control" id="mut_rate" name="mutation_rate" min="0" max="100" value="<?php echo $ga->getMutationRate()*100; ?>" data-postfix="%"/>
                        </div>

                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" disabled>Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!--Task Modal -->
    <div class="modal fade" id="warningModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="warningModalLabel"><i class="fa fa-warning"></i><?php echo " Warning: Last Generation from ".$ga->getCurrentSectionName()." Section"; ?></h4>
                </div>
                <div class="modal-body">

                    <p>Please note that the interface with the highest rating from this generation will be your preferred choice for this section, and will remain constant beyond this point.</p>
                    <p>In case of multiple highest ratings with the same score, a random interface amongst them will be chosen as your preference. It is highly recommended to give a highest rating to a single interface.</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

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
                <li class="">
                    <a id="current_generation" href="#">Section: <?php echo $ga->getCurrentSectionName()." (".$ga->getCurrentSection()."/3)"; ?></a>
                </li>
                <li class="">
                    <a id="current_generation" href="#">Generation: <?php echo $ga->getGenerationNumber()." of ".$ga->getMaxGenerations(); ?></a>
                </li>

            </ul>
            <ul class="nav navbar-nav pull-right">

                <li class="">
                    <a href="#" data-toggle="modal" data-target="#configModal">Configuration</a>
                </li>
                <li class="">
                    <a id="next_generation" class="active" href="#">Next Generation</a>
                </li>

            </ul>

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container" style="width: 80%">

    <form name="form1" id="form1" method="post" action="process/evolve.php"></form>

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 id="instructions"> Rate each interface on Aesthetic/Visual Appeal  <small> 1 = Lowest Aesthetic Appeal; 10 = Highest Aesthetic Appeal</small></h1>

        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-5"></div>
        <div class="col-lg-2">
           <i id="loader" class="fa fa-cog fa-spin pull-right"></i>
           <!-- <svg id="loader" width='350px' height='350px' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="uil-gear"><rect x="0" y="0" width="100" height="100" fill="none" class="bk"></rect><path d="M75,50.5l5-1.5c-0.1-2.2-0.4-4.3-0.9-6.3l-5.2-0.1c-0.2-0.6-0.4-1.1-0.6-1.7l4-3.3c-0.9-1.9-2-3.8-3.2-5.5L69.2,34 c-0.4-0.5-0.8-0.9-1.2-1.3l2.4-4.6c-1.6-1.4-3.3-2.7-5.1-3.8l-3.7,3.6c-0.5-0.3-1.1-0.5-1.6-0.8l0.5-5.2c-2-0.7-4-1.3-6.2-1.6 l-2.1,4.8c-0.6-0.1-1.2-0.1-1.8-0.1l-1.5-5c-2.2,0.1-4.3,0.4-6.3,0.9l-0.1,5.2c-0.6,0.2-1.1,0.4-1.7,0.6l-3.3-4 c-1.9,0.9-3.8,2-5.5,3.2l1.9,4.9c-0.5,0.4-0.9,0.8-1.3,1.2l-4.6-2.4c-1.4,1.6-2.7,3.3-3.8,5.1l3.6,3.7c-0.3,0.5-0.5,1.1-0.8,1.6 l-5.2-0.5c-0.7,2-1.3,4-1.6,6.2l4.8,2.1c-0.1,0.6-0.1,1.2-0.1,1.8l-5,1.5c0.1,2.2,0.4,4.3,0.9,6.3l5.2,0.1c0.2,0.6,0.4,1.1,0.6,1.7 l-4,3.3c0.9,1.9,2,3.8,3.2,5.5l4.9-1.9c0.4,0.5,0.8,0.9,1.2,1.3l-2.4,4.6c1.6,1.4,3.3,2.7,5.1,3.8l3.7-3.6c0.5,0.3,1.1,0.5,1.6,0.8 l-0.5,5.2c2,0.7,4,1.3,6.2,1.6l2.1-4.8c0.6,0.1,1.2,0.1,1.8,0.1l1.5,5c2.2-0.1,4.3-0.4,6.3-0.9l0.1-5.2c0.6-0.2,1.1-0.4,1.7-0.6 l3.3,4c1.9-0.9,3.8-2,5.5-3.2L66,69.2c0.5-0.4,0.9-0.8,1.3-1.2l4.6,2.4c1.4-1.6,2.7-3.3,3.8-5.1l-3.6-3.7c0.3-0.5,0.5-1.1,0.8-1.6 l5.2,0.5c0.7-2,1.3-4,1.6-6.2l-4.8-2.1C74.9,51.7,75,51.1,75,50.5z M50,65c-8.3,0-15-6.7-15-15c0-8.3,6.7-15,15-15s15,6.7,15,15 C65,58.3,58.3,65,50,65z" fill="#222222"><animateTransform attributeName="transform" type="rotate" from="0 50 50" to="90 50 50" dur="1s" repeatCount="indefinite"></animateTransform></path></svg>-->
           <!-- <svg id="loader" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="uil-pie"><rect x="0" y="0" width="100" height="100" fill="none" class="bk"></rect><path d="M0 50A50 50 0 0 1 50 0L50 50L0 50" fill="#16a085" opacity="0.5"><animateTransform attributeName="transform" type="rotate" from="0 50 50" to="360 50 50" dur="0.8s" repeatCount="indefinite"></animateTransform></path><path d="M50 0A50 50 0 0 1 100 50L50 50L50 0" fill="#f1c40f" opacity="0.5"><animateTransform attributeName="transform" type="rotate" from="0 50 50" to="360 50 50" dur="1.6s" repeatCount="indefinite"></animateTransform></path><path d="M100 50A50 50 0 0 1 50 100L50 50L100 50" fill="#2e8ece" opacity="0.5"><animateTransform attributeName="transform" type="rotate" from="0 50 50" to="360 50 50" dur="2.4s" repeatCount="indefinite"></animateTransform></path><path d="M50 100A50 50 0 0 1 0 50L50 50L50 100" fill="#c0392b" opacity="0.5"><animateTransform attributeName="transform" type="rotate" from="0 50 50" to="360 50 50" dur="3.2s" repeatCount="indefinite"></animateTransform></path></svg>-->
        </div>
        <div class="col-lg-5"></div>
    </div>

    <div id="interface_thumbnails">

    <!-- Projects Row -->
    <div class="row">
        <?php
        $index = 0;
        for($i=0;$i<4;$i++){
            echo '<div class="col-md-3 individual-thumbnail">
                        <img class="img-responsive" src="thumbnails/individual_'.$currentPopulation->getIndividual($index)->getIndividualId().'.jpg" alt="">
                        <div class="contenthover">
                            <a class="fancybox" href="thumbnails/individual_'.$currentPopulation->getIndividual($index)->getIndividualId().'.jpg">
                                <i class="fa fa-search-plus hvr-grow" title="Zoom Image"></i>
                            </a>
                            <a class="fancybox" data-fancybox-type="iframe" href="http://localhost/IGA_Prototype/individual_interface.php?id='.$currentPopulation->getIndividual($index)->getIndividualId().'">
                                <i class="fa fa-code hvr-skew" title="View HTML version"></i>
                            </a>
                        </div>
                        <input type="text" class="input_range" id="individual_'.$currentPopulation->getIndividual($index)->getIndividualId().'" form="form1" name="individual_'.$currentPopulation->getIndividual($index)->getIndividualId().'" value="" />
                      </div>';
            $index++;
        }
        ?>
    </div>
    <!-- /.row -->

    <!-- Projects Row -->
    <div class="row">
        <?php
        for($i=0;$i<4;$i++){
            echo '<div class="col-md-3 individual-thumbnail">
                        <img class="img-responsive" src="thumbnails/individual_'.$currentPopulation->getIndividual($index)->getIndividualId().'.jpg" alt="">
                        <div class="contenthover">
                            <a class="fancybox" href="thumbnails/individual_'.$currentPopulation->getIndividual($index)->getIndividualId().'.jpg">
                                <i class="fa fa-search-plus hvr-grow" title="Zoom Image"></i>
                            </a>
                            <a class="fancybox" data-fancybox-type="iframe" href="http://localhost/IGA_Prototype/individual_interface.php?id='.$currentPopulation->getIndividual($index)->getIndividualId().'">
                                <i class="fa fa-code hvr-skew" title="View HTML version"></i>
                            </a>
                        </div>
                        <input type="text" class="input_range" id="individual_'.$currentPopulation->getIndividual($index)->getIndividualId().'" form="form1" name="individual_'.$currentPopulation->getIndividual($index)->getIndividualId().'" value="" />
                      </div>';
            $index++;
        }
        ?>
    </div>
    <!-- /.row -->

    <!-- Projects Row -->
    <div class="row">
        <?php
        for($i=0;$i<4;$i++){
            echo '<div class="col-md-3 individual-thumbnail">
                        <img class="img-responsive" src="thumbnails/individual_'.$currentPopulation->getIndividual($index)->getIndividualId().'.jpg" alt="">
                        <div class="contenthover">
                            <a class="fancybox" href="thumbnails/individual_'.$currentPopulation->getIndividual($index)->getIndividualId().'.jpg">
                                <i class="fa fa-search-plus hvr-grow" title="Zoom Image"></i>
                            </a>
                            <a class="fancybox" data-fancybox-type="iframe" href="http://localhost/IGA_Prototype/individual_interface.php?id='.$currentPopulation->getIndividual($index)->getIndividualId().'">
                                <i class="fa fa-code hvr-skew" title="View HTML version"></i>
                            </a>
                        </div>
                        <input type="text" class="input_range" id="individual_'.$currentPopulation->getIndividual($index)->getIndividualId().'" form="form1" name="individual_'.$currentPopulation->getIndividual($index)->getIndividualId().'" value="" />
                      </div>';
            $index++;
        }
        ?>
    </div>
    <!-- /.row -->

    </div>

    <span id="warning" data-warning="<?php if($ga->getGenerationNumber() == $ga->getMaxGenerations()){ echo "show";}else{echo "hide";} ?>"></span>


<?php include_once "includes/masterpage/footer.php "; ?>