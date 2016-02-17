

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

    </style>

</head>

<body>


<!-- Navigation -->
<nav class="navbar navbar-inverse" id="top_nav" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="top_nav_order">




            <div class="col-md-4" id="nav">
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
            </div><div class="col-md-5" id="search">

                <form method="post" action="" class="navbar-form" id="search_form" role="search">
                    <div class="form-group">
                        <input type="search" name="search" class="form-control" id="search_input" placeholder="Search">
                    </div>
                    <button type="button" id="search_bar" class="btn btn-default">Search</button>
                </form>
            </div> <div class="col-md-3" id="currency">
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

            </div>        </div>
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
        <div class="col-md-2 pull-left">
            <ul class="nav nav-pills nav-stacked nav-jusified">
                <li><a href="#" class="hvr-grow-shadow">Category 1</a></li>
                <li><a id="category_2" href="#" class="hvr-grow-shadow">Category 2</a></li>
                <li><a href="#" class="hvr-grow-shadow">Category 3</a></li>
                <li><a href="#" class="hvr-grow-shadow">Category 4</a></li>
                <li><a href="#" class="hvr-grow-shadow">Category 5</a></li>
            </ul>
        </div>
        <div class="col-md-10">

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


    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-3 col-lg-offset-2">
                <dl>
                    <dt><h4>Information</h4></dt>
                    <dd><a id="footer_shipping" href="#">Shipping Information</a></dd>
                    <dd><a href="#">Return a product</a></dd>
                    <dd><a href="#">Terms and Conditions</a></dd>
                    <dd><a href="#">Privacy Policy</a></dd>
                </dl>            </div>
            <div class="col-lg-3">
                <dl>
                    <dt><h4>Customer Service</h4></dt>
                    <dd><a href="#">Contact Us</a></dd>
                    <dd><a href="#">About Us</a></dd>
                    <dd><a href="#">Sign up for Newsletter</a></dd>
                    <dd><a href="#">Sitemap</a></dd>
                </dl>            </div>
            <div class="col-lg-3">
                <div id="social_icons">
                    <a id="social_icons_facebook" href="#"> <span class="fa fa-facebook hvr-grow"></span></a>
                    <a href="#"> <span class="fa fa-twitter hvr-grow"></span></a>
                    <a href="#"> <span class="fa fa-google-plus hvr-grow"></span></a>
                    <a href="#"> <span class="fa fa-youtube hvr-grow"></span></a>
                    <a href="#"> <span class="fa fa-pinterest hvr-grow"></span></a>
                </div>            </div>
        </div>
    </footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<script>

    var maxTimeOut = 30000;
    var finish = '#product_1';

</script>

<form action="process/task.php" method="post" id="taskForm">

    <input type="hidden" name="task" value="1">
    <input type="hidden" name="type" value="original">
    <input type="hidden" name="token" value="87337fdffa26578d5f62ef03c547e7fc94fdae91">
</form>

<script src="js/evaluation_tracking.js"></script>



</body>

</html>
