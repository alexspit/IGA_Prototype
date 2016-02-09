<?php

require_once "core/init.php";
//require 'vendor/autoload.php';

if(Input::exists('get') && Session::exists('user_id')){

    if(Input::get('type') == Evaluation::ORIGINAL){

        $evaluation = new Evaluation(Session::get('user_id'), Evaluation::ORIGINAL);

        $currentTask = $evaluation->getTask(Input::get('task'));

    }
    else if(Input::get('type') == Evaluation::EVOLVED){


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

<div class="modal fade" id="taskModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Genetic Algorithm Configuration</h4>
            </div>
            <div class="modal-body">

               <p>
                   <?php
                        echo $currentTask->getDescription();
                   ?>
               </p>
            </div>
            <div class="modal-footer">
                <button type="button" id="start" class="btn btn-primary" data-dismiss="modal">Start Task</button>
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
                        <a href="#">Home</a>
                    </li>
                    <li >
                        <a href="#">My Account</a>
                    </li>
                    <li >
                        <a href="#">Shopping Cart</a>
                    </li>
                </ul>
            </div>';

            $search = '<div class="col-md-5" id="search">

                <form method="post" action="" class="navbar-form" role="search">
                    <div class="form-group">
                        <input type="search" name="search" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" disabled class="btn btn-default">Search</button>
                </form>
            </div>';

            $currency = ' <div class="col-md-3" id="currency">
                <ul class="nav navbar-nav">

                    <li >
                        <a id="product_1" href="#">Currency</a>
                    </li>
                    <li>
                        <a href="#">&dollar;</a>
                    </li>
                    <li >
                        <a href="#">&euro;</a>
                    </li>
                    <li >
                        <a href="#">&pound;</a>
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
                <li class="active"><a href="#">Category 1</a></li>
                <li><a href="#">Category 2</a></li>
                <li><a href="#">Category 3</a></li>
                <li><a href="#">Category 4</a></li>
                <li><a href="#">Category 5</a></li>
            </ul>
        </div>
        <div class="col-md-<?php if($categoryPosition == "top" || $categoryPosition=="top-right" || $categoryPosition =="top-left") { echo "12"; } else { echo "10"; }?>">

            <div class="row">

                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src="img/320x150.png" alt="">
                        <div class="caption">
                            <h4 class="pull-right">$24.99</h4>
                            <h4><a href="#">First Product</a>
                            </h4>
                            <p>Description of product goes here. Bla bla this product is so cool becuase...</p>
                            <button class="btn btn-default pull-right">Add to Cart</button>
                            <button class="btn btn-default pull-left">Add to Wishlist</button>
                        </div>

                    </div>
                </div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src="img/320x150.png" alt="">
                        <div class="caption">
                            <h4 class="pull-right">$15.99</h4>
                            <h4><a href="#">Second Product</a>
                            </h4>
                            <p>Description of product goes here. Bla bla this product is so cool becuase...</p>
                            <button class="btn btn-default pull-right">Add to Cart</button>
                            <button class="btn btn-default pull-left">Add to Wishlist</button>
                        </div>

                    </div>
                </div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src="img/320x150.png" alt="">
                        <div class="caption">
                            <h4 class="pull-right">$50.99</h4>
                            <h4><a href="#">Third Product</a>
                            </h4>
                            <p>Description of product goes here. Bla bla this product is so cool becuase...</p>
                            <button class="btn btn-default pull-right">Add to Cart</button>
                            <button class="btn btn-default pull-left">Add to Wishlist</button>
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
                    <dd><a href="">Delivery Information</a></dd>
                    <dd><a href="">Return a product</a></dd>
                    <dd><a href="">Terms and Conditions</a></dd>
                    <dd><a href="">Privacy Policy</a></dd>
                </dl>';

    $serv = '<dl>
                    <dt><h4>Customer Service</h4></dt>
                    <dd><a href="">Contact Us</a></dd>
                    <dd><a href="">About Us</a></dd>
                    <dd><a href="">Sign up for Newsletter</a></dd>
                    <dd><a href="">Sitemap</a></dd>
              </dl>';

    $social = '<div id="social_icons">
                    <a href=""> <span class="fa fa-facebook"></span></a>
                    <a href=""> <span class="fa fa-twitter"></span></a>
                    <a href=""> <span class="fa fa-google-plus"></span></a>
                    <a href=""> <span class="fa fa-youtube"></span></a>
                    <a href=""> <span class="fa fa-pinterest"></span></a>
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


<script src="js/evaluation_tracking.js"></script>



</body>

</html>
