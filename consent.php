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
                        <a id="pre_test" class="active" href="">Start Pre-Test</a>
                    </li>

                    <li class="">
                        <a id="full_test" class="active" href="">Start Full Test</a>
                    </li>

                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">


    <h1>Consent Form</h1>

    <!-- /.row -->
        <form method="post" action="process/consent.php" name="consent_form" id="consent_form">
            <?php if(Session::exists("session-error")){ echo '<p class="bg-danger">'.Session::flash("session-error").'</p>'; } ?>
            <div class="form-group">
                <label for="nameInput">First Name</label>
                <input type="text" name="name" required placeholder="Name" id="nameInput" class="form-control">
            </div>

            <div class="form-group">
                <label for="surnameInput">Last Name</label>
                <input type="text" name="surname" required placeholder="Surame" id="surnameInput" class="form-control">
            </div>

           <!-- <div class="form-group">
                <label for="ageInput">Age</label>
                <input type="number" name="age" required min="18" max="120" placeholder="Age" id="ageInput" class="form-control">
            </div>-->

            <div class="form-group <?php if(Session::exists("age-error")){echo "has-error has-feedback";}?>">
                <label class="control-label" for="ageInput"><?php if(Session::exists("age-error")){echo Session::flash("age-error");}else{echo "Age";}?></label>
                <input type="number" name="age" required min="18" max="80" placeholder="Age" id="ageInput" class="form-control">
                <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group">

                <label for="male">Gender</label>
                <br>

                <label class="radio-inline">
                    <input type="radio" name="sex" value="<?php echo Sex::MALE; ?>" id="male" checked>
                    Male
                </label>


                <label class="radio-inline">
                    <input type="radio" name="sex" value="<?php echo Sex::FEMALE; ?>" id="female">
                    Female
                </label>

            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Further Information</h3>
                </div>
                <div class="panel-body">
                    <p>I agree to participate in the study conducted and recorded by Alexander Spiteri during this interactive interface design and evaluation session developed in part fulfillment of a Bachelor of Science in Internet Applications Development at Middlesex University Malta.</p>
                    <p>I understand and consent to the use and release of the recording by Alexander Spiteri. I understand that the information and recording is for research purposes only and all data collected will be examined and reviewed to extract results.. My name and image will not be used for any other purpose. I relinquish any rights to the recording and understand the recording may be copied and used by Alexander Spiteri without further permission.</p>
                    <p>I understand that participation in this study is voluntary and I agree to immediately raise any concerns or areas of discomfort during the session with the study administrator. I understand that this session will take between 30 and 45 minutes and I agree to do all required tasks and answer all questions to the best of my abilities.</p>
                    <p>By checking the below combo box I confirm that I have read and understood the information on this form and that any questions I might have about the session have been answered.</p>
                </div>
            </div>

            <!--<label class="checkbox-inline pull-right">
                <input type="checkbox" name="consent" id="consent_checkbox" checked> Agree and Give Consent
            </label>-->

            <div class="<?php if(Session::exists("consent-error")){echo "has-error";}?>">
                <div class="checkbox-inline pull-right">
                    <label>
                        <input type="checkbox" id="consent_checkbox" name="consent" required checked>
                        <?php if(Session::exists("consent-error")){echo Session::flash("consent-error");}else{echo "Agree and Give Consent";}?>
                    </label>
                </div>
            </div>


            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

            <input type="submit" class="hidden" disabled id="submit_btn">


        </form>

<br>






<?php

require_once "includes/masterpage/footer.php";
?>