<?php
include_once "includes/masterpage/header.php";
?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="#">  Rate each interface on Aesthetic/Visual Appeal </a>
            <a class="navbar-brand" href="#"><small> (1 = Lowest Aesthetic Appeal; 10 = Highest Aesthetic Appeal)</small></a>
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
                    <a id="next_generation" href="#">Next Generation</a>
                </li>

            </ul>

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">

    <form name="form1" id="form1" method="get" action="screencapture.php"></form>

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1> Rate each interface on Aesthetic/Visual Appeal  <small> 1 = Lowest Aesthetic Appeal; 10 = Highest Aesthetic Appeal</small></h1>

        </div>
    </div>
    <!-- /.row -->

    <!-- Projects Row -->
    <div class="row">
        <div class="col-md-3 individual-thumbnail">
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
        </div>
    </div>
    <!-- /.row -->

    <!-- Projects Row -->
    <div class="row">
        <div class="col-md-3 individual-thumbnail">
            <a href="thumbnails/individual5.jpg" class="gallery">
                <img class="img-responsive" src="thumbnails/individual5.jpg" alt="">
            </a>
            <input type="text" class="input_range" id="range_1" form="form1" name="individual_1" value="" />
        </div>
        <div class="col-md-3 individual-thumbnail">
            <a href="thumbnails/individual6.jpg" class="gallery">
                <img class="img-responsive" src="thumbnails/individual6.jpg" alt="">
            </a>
            <input type="text" class="input_range" id="range_1" form="form1" name="individual_1" value="" />
        </div>
        <div class="col-md-3 individual-thumbnail">
            <a href="thumbnails/individual7.jpg" class="gallery">
                <img class="img-responsive" src="thumbnails/individual7.jpg" alt="">
            </a>
            <input type="text" class="input_range" id="range_1" form="form1" name="individual_1" value="" />
        </div>
        <div class="col-md-3 individual-thumbnail">
            <a href="thumbnails/individual8.jpg" class="gallery">
                <img class="img-responsive" src="thumbnails/individual8.jpg" alt="">
            </a>
            <input type="text" class="input_range" id="range_1" form="form1" name="individual_1" value="" />
        </div>
    </div>
    <!-- /.row -->

    <!-- Projects Row -->
    <div class="row">
        <div class="col-md-3 individual-thumbnail">
            <a href="thumbnails/individual9.jpg" class="gallery">
                <img class="img-responsive" src="thumbnails/individual9.jpg" alt="">
            </a>
            <input type="text" class="input_range" id="range_1" form="form1" name="individual_1" value="" />
        </div>
        <div class="col-md-3 individual-thumbnail">
            <a href="thumbnails/individual10.jpg" class="gallery">
                <img class="img-responsive" src="thumbnails/individual10.jpg" alt="">
            </a>
            <input type="text" class="input_range" id="range_1" form="form1" name="individual_1" value="" />
        </div>
        <div class="col-md-3 individual-thumbnail">
            <a href="thumbnails/individual11.jpg" class="gallery">
                <img class="img-responsive" src="thumbnails/individual11.jpg" alt="">
            </a>
            <input type="text" class="input_range" id="range_1" form="form1" name="individual_1" value="" />
        </div>
        <div class="col-md-3 individual-thumbnail">
            <a href="thumbnails/individual12.jpg" class="gallery">
                <img class="img-responsive" src="thumbnails/individual12.jpg" alt="">
            </a>
            <input type="text" class="input_range" id="range_1" form="form1" name="individual_1" value="" />
        </div>
    </div>
    <!-- /.row -->






<?php include_once "includes/masterpage/footer.php "; ?>