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

    <!-- Custom CSS -->
    <link href="css/individual_style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse " role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">

            <div class="col-md-4">

                <ul class="nav navbar-nav navbar-left">
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
            </div>

            <div class="col-md-4">

                <form method="get" action="individual_interface.php" class="navbar-form" role="search">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </form>
            </div>

            <div class="col-md-4">
                <ul class="nav navbar-nav navbar-right">

                    <li >
                        <a href="#">Currency</a>
                    </li>
                    <li class="active">
                        <a href="#">$</a>
                    </li>
                    <li >
                        <a href="#">€</a>
                    </li>
                    <li >
                        <a href="#">£</a>
                    </li>
                </ul>

            </div>




        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">

    <div class="row" id="logo">

        <div class="col-md-4">

            <h1><span class="glyphicon glyphicon-shopping-cart"></span>MyStore</h1>

        </div>
        <div class="col-md-4 hidden" style="text-align: center">
            <h1><span class="glyphicon glyphicon-shopping-cart"></span>MyStore</h1>

        </div>
        <div class="col-md-4 hidden">
            <h1 class="pull-right"><span class="glyphicon glyphicon-shopping-cart"></span>MyStore</h1>

        </div>

    </div>

    <div class="row carousel-holder" id="banner">

        <div class="col-md-12">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img class="slide-image" src="http://lorempixel.com/800/200/sports/" alt="">
                    </div>
                    <div class="item">
                        <img class="slide-image" src="http://lorempixel.com/800/200/sports/" alt="">
                    </div>
                    <div class="item">
                        <img class="slide-image" src="http://lorempixel.com/800/200/sports/" alt="">
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
        <div class="col-md-2">
            <ul class="nav nav-pills nav-stacked nav-jusified">
                <li class="active"><a href="#">Category 1</a></li>
                <li><a href="#">Category 2</a></li>
                <li><a href="#">Category 3</a></li>
                <li><a href="#">Category 4</a></li>
                <li><a href="#">Category 5</a></li>
            </ul>
        </div>
        <div class="col-md-10">

            <div class="row">

                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src="http://lorempixel.com/320/150/sports/" alt="">
                        <div class="caption">
                            <h4 class="pull-right">$24.99</h4>
                            <h4><a href="#">First Product</a>
                            </h4>
                            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                            <button class="btn btn-default pull-right">Add to Cart</button>
                            <button class="btn btn-default pull-left">Add to Wishlist</button>
                        </div>

                    </div>
                </div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src="http://lorempixel.com/320/150/sports/" alt="">
                        <div class="caption">
                            <h4 class="pull-right">$24.99</h4>
                            <h4><a href="#">First Product</a>
                            </h4>
                            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                            <button class="btn btn-default pull-right">Add to Cart</button>
                            <button class="btn btn-default pull-left">Add to Wishlist</button>
                        </div>

                    </div>
                </div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src="http://lorempixel.com/320/150/sports/" alt="">
                        <div class="caption">
                            <h4 class="pull-right">$24.99</h4>
                            <h4><a href="#">First Product</a>
                            </h4>
                            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                            <button class="btn btn-default pull-right">Add to Cart</button>
                            <button class="btn btn-default pull-left">Add to Wishlist</button>
                        </div>

                    </div>
                </div>




                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src="http://lorempixel.com/320/150/sports/" alt="">
                        <div class="caption">
                            <h4 class="pull-right">$24.99</h4>
                            <h4><a href="#">First Product</a>
                            </h4>
                            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                            <button class="btn btn-default pull-right">Add to Cart</button>
                            <button class="btn btn-default pull-left">Add to Wishlist</button>
                        </div>

                    </div>
                </div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src="http://lorempixel.com/320/150/sports/" alt="">
                        <div class="caption">
                            <h4 class="pull-right">$24.99</h4>
                            <h4><a href="#">First Product</a>
                            </h4>
                            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                            <button class="btn btn-default pull-right">Add to Cart</button>
                            <button class="btn btn-default pull-left">Add to Wishlist</button>
                        </div>

                    </div>
                </div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src="http://lorempixel.com/320/150/sports/" alt="">
                        <div class="caption">
                            <h4 class="pull-right">$24.99</h4>
                            <h4><a href="#">First Product</a>
                            </h4>
                            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
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

<div class="container">

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Your Website 2014</p>
            </div>
        </div>
    </footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
