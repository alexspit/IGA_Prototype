<?php

require_once "core/init.php";
//require 'vendor/autoload.php';

if(Input::exists('get') && Session::exists('user_id')){

    if(Input::get('type') == Evaluation::ORIGINAL){

        $evaluation = new Evaluation(Session::get('user_id'), Evaluation::ORIGINAL);

        $currentTask = $evaluation->getTask(Input::get('task'));

    }
    else if(Input::get('type') == Evaluation::EVOLVED){

        $evaluation = new Evaluation(Session::get('user_id'), Evaluation::EVOLVED);

        $currentTask = $evaluation->getTask(Input::get('task'));

    }

   // $ga = new GeneticAlgorithm($user_id);

    //$individual = new Individual($individual_id);


}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Individual Interface</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/hover.css"/>
    <!--<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine:i|Tangerine:b|Inconsolata|Droid+Sans">-->


    <!-- Custom CSS -->
    <link href="css/individual_style.css" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        <?php
            $headerOrder = "";
            $categoryPosition = "left";
            $footerOrder = "";
            if(Input::get('type') == Evaluation::EVOLVED){


                echo $evaluation->decode($headerOrder, $categoryPosition, $footerOrder);
            }
        ?>

    </style>

</head>

<body>

<!--Task Modal -->
<div class="modal fade" id="taskModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="gridSystemModalLabel">Task <?php echo $currentTask->getNumber()." of ".$evaluation->getTaskCount();?></h4>
            </div>
            <div class="modal-body">

                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse1"><?php echo $currentTask->getQuestion(); ?> <i class="fa fa-question-circle"></i></a>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse">
                            <div class="panel-body"><?php echo $currentTask->getDescription(); ?></div>
                        </div>
                    </div>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" id="start" class="btn btn-default" data-dismiss="modal">Start Task</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Satisfaction Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="seqModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="seqModalHeader">Task <?php echo $currentTask->getNumber()." - ";?> </h4>
            </div>
            <div class="modal-body">

               <!-- <p>Overall, how difficult or easy did you find this task?</p>
                <select name="seq_score" id="seq_score">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>-->

                <div class="row">
                    <div class="col-sm-12" style="text-align: center">
                        <p>How would you describe how difficult or easy it was to complete this task?</p>
                    </div>

                    <div class="col-sm-4">
                        <p class="pull-right" style="padding-top: 5px;">Difficult</p>
                    </div>

                    <div id="difficulty_group" class="btn-group col-sm-4" data-toggle="buttons">
                        <label class="btn btn-default">
                            <input type="radio"  name="difficulty" value="1" /> 1
                        </label>
                        <label class="btn btn-default">
                            <input type="radio" name="difficulty" value="2" /> 2
                        </label>
                        <label class="btn btn-default active">
                            <input type="radio" name="difficulty" checked="checked" value="3" /> 3
                        </label>
                        <label class="btn btn-default">
                            <input type="radio"  name="difficulty" value="4" /> 4
                        </label>
                        <label class="btn btn-default">
                            <input type="radio" name="difficulty" value="5" /> 5
                        </label>
                    </div>

                    <div class="col-sm-3" style="padding-left: 4px;">
                        <p class="pull-left" style="padding-left: 0; padding-top: 5px;">Very Easy</p>
                    </div>

                </div>



                <div class="row"><hr>
                    <div class="col-sm-12" style="text-align: center">
                        <p>How satisfied are you with using this interface to complete this task?</p>
                    </div>

                    <div class="col-sm-4">
                        <p class="pull-right" style="padding-top: 5px;">Very Unsatisfied</p>
                    </div>

                    <div id="satisfaction_group" class="btn-group col-sm-4" data-toggle="buttons">
                        <label class="btn btn-default">
                            <input type="radio"  name="satisfaction" value="1" /> 1
                        </label>
                        <label class="btn btn-default">
                            <input type="radio" name="satisfaction" value="2" /> 2
                        </label>
                        <label class="btn btn-default active">
                            <input type="radio" name="satisfaction" checked="checked" value="3" /> 3
                        </label>
                        <label class="btn btn-default">
                            <input type="radio"  name="satisfaction" value="4" /> 4
                        </label>
                        <label class="btn btn-default">
                            <input type="radio" name="satisfaction" value="5" /> 5
                        </label>
                    </div>

                    <div class="col-sm-3" style="padding-left: 4px;">
                        <p class="pull-left" style="padding-left: 0; padding-top: 5px;">Very Satisfied</p>
                    </div>

                </div>



                <div id="time_group_container" class="row" style="text-align: center"><hr>
                    <div class="col-sm-12">
                        <p>How would you rate the amount of time it took to complete this task? </p>
                    </div>

                    <div class="col-sm-4">
                        <p class="pull-right" style="padding-top: 5px;">Too Much Time</p>
                    </div>

                    <div id="time_group" class="btn-group col-sm-4" data-toggle="buttons">
                        <label class="btn btn-default">
                            <input type="radio"  name="time" value="1" /> 1
                        </label>
                        <label class="btn btn-default">
                            <input type="radio" name="time" value="2" /> 2
                        </label>
                        <label class="btn btn-default active">
                            <input type="radio" name="time" checked="checked" value="3"/> 3
                        </label>
                        <label class="btn btn-default">
                            <input type="radio"  name="time" value="4"/> 4
                        </label>
                        <label class="btn btn-default">
                            <input type="radio" id="time_failed" name="time" value="5" /> 5
                        </label>
                    </div>

                    <div class="col-sm-3" style="padding-left: 4px;">
                        <p class="pull-left" style="padding-left: 0; padding-top: 5px;">Very Little Time</p>
                    </div>

                </div>





            </div>
            <div class="modal-footer">
                <button type="button" id="nextTask" class="btn btn-default" data-dismiss="modal">Next Task</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- Navigation -->
<nav class="navbar navbar-inverse" id="top_nav" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="top_nav_order">




        <?php

            $nav = '  <div class="col-md-4" id="nav">
               <ul class="nav navbar-nav">
                    <li>
                        <a href="#" class="hvr-grow">Home</a>
                    </li>
                    <li >
                        <a href="#" class="hvr-grow">My Account</a>
                    </li>
                    <li >
                        <a href="#" class="hvr-grow">Shopping Cart</a>
                    </li>
                </ul>
            </div>';

            $search = '<div class="col-md-5" id="search">

                <form method="post" action="" class="navbar-form" id="search_form" role="search">
                    <div class="form-group">
                        <input type="search" name="search" class="form-control" id="search_input" placeholder="Search">
                    </div>
                    <button type="button" id="search_bar" class="btn btn-default">Search</button>
                </form>
            </div>';

            $currency = ' <div class="col-md-3" id="currency">
                <ul class="nav navbar-nav">

                    <li >
                        <a href="#">Currency</a>
                    </li>
                    <li>
                        <a id="currency_dollar" href="#" class="hvr-pop active">&dollar;</a>
                    </li>
                    <li >
                        <a id="currency_euro" href="#" class="hvr-pop">&euro;</a>
                    </li>
                    <li >
                        <a id="currency_pound" href="#" class="hvr-pop">&pound;</a>
                    </li>
                </ul>

            </div>';


            if(is_array($headerOrder)){
                echo $$headerOrder[0].$$headerOrder[1].$$headerOrder[2];
            }else{
                echo $nav.$search.$currency;
            }

        ?>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container" id="content">


    <div class="row" id="logo">

        <div class="col-md-12">

            <h1><span class="glyphicon glyphicon-shopping-cart"></span>MyStore</h1>
        </div>
       <!-- <div class="col-md-4 hidden" style="text-align: center">
            <h1><span class="glyphicon glyphicon-shopping-cart"></span>MyStore</h1>

        </div>
        <div class="col-md-4 hidden">
            <h1 class="pull-right"><span class="glyphicon glyphicon-shopping-cart"></span>MyStore</h1>

        </div>-->

    </div>

    <div class="row carousel-holder">

        <div class="col-md-12">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" id="banner">
                    <div class="item active">
                        <img class="slide-image" src="img/banner1.jpg" alt="">
                    </div>
                    <div class="item">
                        <img class="slide-image" src="img/banner2.jpg" alt="">
                    </div>
                    <div class="item">
                        <img class="slide-image" src="img/banner3.jpg" alt="">
                    </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-md-<?php if($categoryPosition == "top") { echo "offset-3 col-md-6"; } else if ($categoryPosition == "top-right") { echo "12"; } else if ($categoryPosition == "top-left") { echo "12"; } else { echo "2"; }?> pull-<?php echo $categoryPosition; ?>">
            <ul class="nav nav-pills <?php if($categoryPosition == "right" || $categoryPosition == "left") { echo "nav-stacked"; } else { echo "nav-not-stacked";}  if ($categoryPosition == "top-right") { echo " pull-right"; } ?> nav-jusified">
                <li><a href="#" class="hvr-grow-shadow">Category 1</a></li>
                <li><a id="category_2" href="#" class="hvr-grow-shadow">Category 2</a></li>
                <li><a href="#" class="hvr-grow-shadow">Category 3</a></li>
                <li><a href="#" class="hvr-grow-shadow">Category 4</a></li>
                <li><a href="#" class="hvr-grow-shadow">Category 5</a></li>
            </ul>
        </div>
        <div class="col-md-<?php if($categoryPosition == "top" || $categoryPosition=="top-right" || $categoryPosition =="top-left") { echo "12"; } else { echo "10"; }?>">

            <div class="row">

                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src="img/320x150.png" alt="">
                        <div class="caption">
                            <h4 class="pull-right"><span class="currency">$</span><span class="price">28.99</span></h4>
                            <h4><a href="#">Product 1</a>
                            </h4>
                            <p>Description of product goes here. Bla bla this product is so cool becuase...</p>
                            <button id="product_1" class="btn btn-default pull-right hvr-grow">Add to Cart</button>
                            <button class="btn btn-default pull-left hvr-grow">Add to Wishlist</button>
                        </div>

                    </div>
                </div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src="img/320x150.png" alt="">
                        <div class="caption">
                            <h4 class="pull-right"><span class="currency">$</span><span class="price">28.99</span></h4>
                            <h4><a href="#">Product 2</a>
                            </h4>
                            <p>Description of product goes here. Bla bla this product is so cool becuase...</p>
                            <button class="btn btn-default pull-right hvr-grow">Add to Cart</button>
                            <button class="btn btn-default pull-left hvr-grow">Add to Wishlist</button>
                        </div>

                    </div>
                </div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src="img/320x150.png" alt="">
                        <div class="caption">
                            <h4 class="pull-right"><span class="currency">$</span><span class="price">28.99</span></h4>
                            <h4><a href="#">Product 3</a>
                            </h4>
                            <p>Description of product goes here. Bla bla this product is so cool becuase...</p>
                            <button class="btn btn-default pull-right hvr-grow">Add to Cart</button>
                            <button class="btn btn-default pull-left hvr-grow">Add to Wishlist</button>
                        </div>

                    </div>
                </div>




            </div>

        </div>

    </div>

</div>
<!-- /.container -->

<div class="container-fluid" id="footer">

    <?php

    $info = '<dl>
                    <dt><h4>Information</h4></dt>
                    <dd><a id="footer_shipping" href="#">Shipping Information</a></dd>
                    <dd><a href="#">Return a product</a></dd>
                    <dd><a href="#">Terms and Conditions</a></dd>
                    <dd><a href="#">Privacy Policy</a></dd>
                </dl>';

    $serv = '<dl>
                    <dt><h4>Customer Service</h4></dt>
                    <dd><a href="#">Contact Us</a></dd>
                    <dd><a href="#">About Us</a></dd>
                    <dd><a href="#">Sign up for Newsletter</a></dd>
                    <dd><a href="#">Sitemap</a></dd>
              </dl>';

    $social = '<div id="social_icons">
                    <a id="social_icons_facebook" href="#"> <span class="fa fa-facebook hvr-grow"></span></a>
                    <a href="#"> <span class="fa fa-twitter hvr-grow"></span></a>
                    <a href="#"> <span class="fa fa-google-plus hvr-grow"></span></a>
                    <a href="#"> <span class="fa fa-youtube hvr-grow"></span></a>
                    <a href="#"> <span class="fa fa-pinterest hvr-grow"></span></a>
               </div>';

    ?>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-3 col-lg-offset-2">
                <?php
                    if(is_array($footerOrder)){
                        echo $$footerOrder[0];
                    }else{
                        echo $info;
                    }
                ?>
            </div>
            <div class="col-lg-3">
                <?php
                    if(is_array($footerOrder)){
                        echo $$footerOrder[1];
                    }else{
                        echo $serv;
                    }
                ?>
            </div>
            <div class="col-lg-3">
                <?php
                    if(is_array($footerOrder)){
                        echo $$footerOrder[2];
                    }else{
                        echo $social;
                    }
                ?>
            </div>
        </div>
    </footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<script>

    var maxTimeOut = <?php echo $currentTask->getMaxtimeout(); ?>;
    var finish = '#<?php echo $currentTask->getTargetID(); ?>';

</script>

<form action="process/task.php" method="post" id="taskForm">

    <input type="hidden" name="task" value="<?php echo Input::get('task'); ?>">
    <input type="hidden" name="type" value="<?php echo Input::get('type'); ?>">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>

<script src="js/evaluation_tracking.js"></script>



</body>

</html>
