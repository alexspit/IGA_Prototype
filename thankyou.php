<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 1/17/2016
 * Time: 1:06 PM
 */

require_once "includes/masterpage/header.php";
?>


    <!-- Navigation -->
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="#"> Interactive Web Interface Evolution </a>

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">

                    <li class="hidden">
                        <a href="#">Configuration</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav pull-right">


                    <li class="">
                        <a id="new_session" class="active" href="consent.php">Start New Session</a>
                    </li>

                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <?php
            $user = new User();
            $user->get(Session::get('user_id'));

        ?>

        <h1 style="text-align: center; margin-top: 270px; margin-bottom: 270px; font-size: 100px">Thank You, <?php echo ucfirst($user->getName());?> <i id="thumbs" class="fa fa-thumbs-up hvr-pulse"></i></h1>









<?php

require_once "includes/masterpage/footer.php";
?>