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
                        <a id="submit_sus_form" class="active" href="">Submit Form</a>
                    </li>

                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

    <h1 id="config_title" style="text-align: center;">Standard Usability Scale  <small>Please answer the following 10 questions as accurately as possible. </small></h1>


    <form method="post" action="process/sus.php" name="sus_form" id="sus_form">

        <!-- Question 1 -->
        <div class="row">
            <div class="col-sm-offset-1 col-sm-5">
                <h4>1. I think that I would like to use this system frequently</h4>
            </div>

            <div class="col-sm-5">

                <span style="margin-right:10px;">Strongly Disagree</span>

                <div id="difficulty_group" class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default">
                        <input type="radio"  name="q1" value="0" /> 1
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="q1" value="1" /> 2
                    </label>
                    <label class="btn btn-default active">
                        <input type="radio" name="q1" checked="checked" value="2" /> 3
                    </label>
                    <label class="btn btn-default">
                        <input type="radio"  name="q1" value="3" /> 4
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="q1" value="4" /> 5
                    </label>
                </div>

                <span style="margin-left: 10px">Strongly Agree</span>
            </div>
        </div> <br><br>
        <!-- End Question -->

        <!-- Question 2 -->
        <div class="row">
            <div class="col-sm-offset-1 col-sm-5">
                <h4>2. I found the system unnecessarily complex</h4>
            </div>

            <div class="col-sm-5">

                <span style="margin-right:10px;">Strongly Disagree</span>

                <div id="difficulty_group" class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default">
                        <input type="radio"  name="q2" value="4" /> 1
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="q2" value="3" /> 2
                    </label>
                    <label class="btn btn-default active">
                        <input type="radio" name="q2" checked="checked" value="2" /> 3
                    </label>
                    <label class="btn btn-default">
                        <input type="radio"  name="q2" value="1" /> 4
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="q2" value="0" /> 5
                    </label>
                </div>

                <span style="margin-left: 10px">Strongly Agree</span>
            </div>
        </div> <br><br>
        <!-- End Question -->

        <!-- Question 3 -->
        <div class="row">
            <div class="col-sm-offset-1 col-sm-5">
                <h4>3. I thought the system was easy to use</h4>
            </div>

            <div class="col-sm-5">

                <span style="margin-right:10px;">Strongly Disagree</span>

                <div id="difficulty_group" class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default">
                        <input type="radio"  name="q3" value="0" /> 1
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="q3" value="1" /> 2
                    </label>
                    <label class="btn btn-default active">
                        <input type="radio" name="q3" checked="checked" value="2" /> 3
                    </label>
                    <label class="btn btn-default">
                        <input type="radio"  name="q3" value="3" /> 4
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="q3" value="4" /> 5
                    </label>
                </div>

                <span style="margin-left: 10px">Strongly Agree</span>
            </div>
        </div> <br><br>
        <!-- End Question -->

        <!-- Question 4 -->
        <div class="row">
            <div class="col-sm-offset-1 col-sm-5">
                <h4>4. I think that I would need the support of a technical person to be able to use this system</h4>
            </div>

            <div class="col-sm-5">

                <span style="margin-right:10px;">Strongly Disagree</span>

                <div id="difficulty_group" class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default">
                        <input type="radio"  name="q4" value="4" /> 1
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="q4" value="3" /> 2
                    </label>
                    <label class="btn btn-default active">
                        <input type="radio" name="q4" checked="checked" value="2" /> 3
                    </label>
                    <label class="btn btn-default">
                        <input type="radio"  name="q4" value="1" /> 4
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="q4" value="0" /> 5
                    </label>
                </div>

                <span style="margin-left: 10px">Strongly Agree</span>
            </div>
        </div> <br>
        <!-- End Question -->

        <!-- Question 5 -->
        <div class="row">
            <div class="col-sm-offset-1 col-sm-5">
                <h4>5. I found the various functions in this system were well integrated</h4>
            </div>

            <div class="col-sm-5">

                <span style="margin-right:10px;">Strongly Disagree</span>

                <div id="difficulty_group" class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default">
                        <input type="radio"  name="q5" value="0" /> 1
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="q5" value="1" /> 2
                    </label>
                    <label class="btn btn-default active">
                        <input type="radio" name="q5" checked="checked" value="2" /> 3
                    </label>
                    <label class="btn btn-default">
                        <input type="radio"  name="q5" value="3" /> 4
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="q5" value="4" /> 5
                    </label>
                </div>

                <span style="margin-left: 10px">Strongly Agree</span>
            </div>
        </div> <br>
        <!-- End Question -->

        <!-- Question 6 -->
        <div class="row">
            <div class="col-sm-offset-1 col-sm-5">
                <h4>6. I thought there was too much inconsistency in this system</h4>
            </div>

            <div class="col-sm-5">

                <span style="margin-right:10px;">Strongly Disagree</span>

                <div id="difficulty_group" class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default">
                        <input type="radio"  name="q6" value="4" /> 1
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="q6" value="3" /> 2
                    </label>
                    <label class="btn btn-default active">
                        <input type="radio" name="q6" checked="checked" value="2" /> 3
                    </label>
                    <label class="btn btn-default">
                        <input type="radio"  name="q6" value="1" /> 4
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="q6" value="0" /> 5
                    </label>
                </div>

                <span style="margin-left: 10px">Strongly Agree</span>
            </div>
        </div> <br>
        <!-- End Question -->

        <!-- Question 7 -->
        <div class="row">
            <div class="col-sm-offset-1 col-sm-5">
                <h4>7. I would imagine that most people would learn to use this system very quickly</h4>
            </div>

            <div class="col-sm-5">

                <span style="margin-right:10px;">Strongly Disagree</span>

                <div id="difficulty_group" class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default">
                        <input type="radio"  name="q7" value="0" /> 1
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="q7" value="1" /> 2
                    </label>
                    <label class="btn btn-default active">
                        <input type="radio" name="q7" checked="checked" value="2" /> 3
                    </label>
                    <label class="btn btn-default">
                        <input type="radio"  name="q7" value="3" /> 4
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="q7" value="4" /> 5
                    </label>
                </div>

                <span style="margin-left: 10px">Strongly Agree</span>
            </div>
        </div> <br>
        <!-- End Question -->

        <!-- Question 8 -->
        <div class="row">
            <div class="col-sm-offset-1 col-sm-5">
                <h4>8. I found the system very cumbersome to use</h4>
            </div>

            <div class="col-sm-5">

                <span style="margin-right:10px;">Strongly Disagree</span>

                <div id="difficulty_group" class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default">
                        <input type="radio"  name="q8" value="4" /> 1
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="q8" value="3" /> 2
                    </label>
                    <label class="btn btn-default active">
                        <input type="radio" name="q8" checked="checked" value="2" /> 3
                    </label>
                    <label class="btn btn-default">
                        <input type="radio"  name="q8" value="1" /> 4
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="q8" value="0" /> 5
                    </label>
                </div>

                <span style="margin-left: 10px">Strongly Agree</span>

            </div>
        </div> <br><br>
        <!-- End Question -->

        <!-- Question 9 -->
        <div class="row">
            <div class="col-sm-offset-1 col-sm-5">
                <h4>9. I felt very confident using the system</h4>
            </div>

            <div class="col-sm-5">

                <span style="margin-right:10px;">Strongly Disagree</span>

                <div id="difficulty_group" class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default">
                        <input type="radio"  name="q9" value="0" /> 1
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="q9" value="1" /> 2
                    </label>
                    <label class="btn btn-default active">
                        <input type="radio" name="q9" checked="checked" value="2" /> 3
                    </label>
                    <label class="btn btn-default">
                        <input type="radio"  name="q9" value="3" /> 4
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="q9" value="4" /> 5
                    </label>
                </div>

                <span style="margin-left: 10px">Strongly Agree</span>
            </div>
        </div> <br><br>
        <!-- End Question -->

        <!-- Question 10 -->
        <div class="row">
            <div class="col-sm-offset-1 col-sm-5">
                <h4>10. I needed to learn a lot of things before I could get going with this system</h4>
            </div>

            <div class="col-sm-5">

                <span style="margin-right:10px;">Strongly Disagree</span>

                <div id="difficulty_group" class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default">
                        <input type="radio"  name="q10" value="4" /> 1
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="q10" value="3" /> 2
                    </label>
                    <label class="btn btn-default active">
                        <input type="radio" name="q10" checked="checked" value="2" /> 3
                    </label>
                    <label class="btn btn-default">
                        <input type="radio"  name="q10" value="1" /> 4
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="q10" value="0" /> 5
                    </label>
                </div>

                <span style="margin-left: 10px">Strongly Agree</span>
            </div>
        </div> <br>
        <!-- End Question -->



        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

        <input type="submit" id="sus_btn" class="hidden" name="sus_form_submit" value="Send">
    </form>

<?php require_once "includes/masterpage/footer.php"; ?>