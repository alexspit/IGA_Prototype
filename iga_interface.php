<?php
include_once "includes/masterpage/header.php";

$user_id = $_SESSION["user_id"];

$ga = new GeneticAlgorithm($user_id);

if(is_null($ga->getSessionID())){
    Redirect::to("consent.php");
}

$currentPopulation = $ga->currentPopulation();

$currentPopulation->shuffle();



?>

<!-- Navigation -->
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="#"> Web Interface Evaluation </a>

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
                    <a id="current_generation" href="#">Generation <?php echo $ga->getGenerationNumber(); ?></a>
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
<div class="container">

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
        </div>
        <div class="col-lg-5"></div>
    </div>

    <div id="interface_thumbnails">

    <!-- Projects Row -->
    <div class="row">
        <?php
            $index = 0;
            for($i=0;$i<4;$i++){
             /*   echo ' <div class="col-md-3 individual-thumbnail">
                            <a href="'.$currentPopulation->getIndividual($index)->getImagePath().'" class="gallery">
                                <img class="img-responsive" src="'.$currentPopulation->getIndividual($index)->getImagePath().'" alt="">
                            </a>
                            <input type="text" class="input_range" id="individual_'.$currentPopulation->getIndividual($index)->getIndividualId().'" form="form1" name="individual_'.$currentPopulation->getIndividual($index)->getIndividualId().'" value="" />
                       </div>';*/
                echo ' <div class="col-md-3 individual-thumbnail">
                            <a href="thumbnails/individual_'.$currentPopulation->getIndividual($index)->getIndividualId().'.jpg" class="gallery">
                                <img class="img-responsive" src="thumbnails/individual_'.$currentPopulation->getIndividual($index)->getIndividualId().'.jpg" alt="">
                            </a>
                            <input type="text" class="input_range" id="individual_'.$currentPopulation->getIndividual($index)->getIndividualId().'" form="form1" name="individual_'.$currentPopulation->getIndividual($index)->getIndividualId().'" value="" />
                       </div>';
                $index++;
            }

        ?>
       <!-- <div class="col-md-3 individual-thumbnail">
            <a href="thumbnails/individual1.jpg" class="gallery">
                <img class="img-responsive" src="thumbnails/individual1.jpg" alt="">
            </a>
            <input type="text" class="input_range" id="range_1" form="form1" name="individual_1" value="" />
        </div>
        <div class="col-md-3 individual-thumbnail">
            <a href="thumbnails/individual2.jpg" class="gallery">
                <img class="img-responsive" src="thumbnails/individual2.jpg" alt="">
            </a>
            <input type="text" class="input_range" id="range_1" form="form1" name="individual_1" value="" />
        </div>
        <div class="col-md-3 individual-thumbnail">
            <a href="thumbnails/individual3.jpg" class="gallery">
                <img class="img-responsive" src="thumbnails/individual3.jpg" alt="">
            </a>
            <input type="text" class="input_range" id="range_1" form="form1" name="individual_1" value="" />
        </div>
        <div class="col-md-3 individual-thumbnail">
            <a href="thumbnails/individual4.jpg" class="gallery">
                <img class="img-responsive" src="thumbnails/individual4.jpg" alt="">
            </a>
            <input type="text" class="input_range" id="range_1" form="form1" name="individual_1" value="" />
        </div>-->
    </div>
    <!-- /.row -->

    <!-- Projects Row -->
    <div class="row">
        <?php

       for($i=0;$i<4;$i++){
            echo ' <div class="col-md-3 individual-thumbnail">
                            <a href="'.$currentPopulation->getIndividual($index)->getImagePath().'" class="gallery">
                                <img class="img-responsive" src="'.$currentPopulation->getIndividual($index)->getImagePath().'" alt="">
                            </a>
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
            echo ' <div class="col-md-3 individual-thumbnail">
                            <a href="'.$currentPopulation->getIndividual($index)->getImagePath().'" class="gallery">
                                <img class="img-responsive" src="'.$currentPopulation->getIndividual($index)->getImagePath().'" alt="">
                            </a>
                            <input type="text" class="input_range" id="individual_'.$currentPopulation->getIndividual($index)->getIndividualId().'" form="form1" name="individual_'.$currentPopulation->getIndividual($index)->getIndividualId().'" value="" />
                       </div>';
            $index++;
        }

        ?>

    </div>
    <!-- /.row -->

    </div>







<?php include_once "includes/masterpage/footer.php "; ?>