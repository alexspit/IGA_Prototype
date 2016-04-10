/**
 * Created by Dell on 2/9/2016.
 */

$( document ).ready(function() {

    $("#taskModal").modal('show');

   /* $("#help").hide();
    $("#help_btn").on("click", function(e){
        e.preventDefault();
        $("#help").fadeToggle();
    });*/

    var start = false, startTime, endTime, wrongClicks = 0, totalTime, points = [], straightDist, travelledDist, completed, diffScore, timeScore, satScore;

    function startTimer(){

        startTimer = setInterval(function(){
            if(start){//If max execution time is reach before task is finished
                start=false;
                endTime = Date.now();
                totalTime = endTime - startTime;
                if(points.length > 0){
                    travelledDist = travelledDistance();
                    straightDist = straightDistance();
                }
                else{
                    travelledDist = 0;
                    straightDist = 0;
                }

                completed = 0;
                width = $(finish).outerWidth();


                $("#seqModalHeader").append(" Failed to complete task in pre-determined time-frame");
                $("#time_group_container").html('<input type="radio" class="hidden" name="time" value="1" checked/>');

                $("#seqModal").modal('show');
            }
            stopTime();

        }, maxTimeOut);

    }

    function stopTime() {
        clearInterval(startTimer);
    }

    $("#start").on("click", function(){
        start = true;
        startTimer();
        wrongClicks = 0;
        points = [];
        startTime = Date.now();
    });

    $(finish).on("click", function(){

        if(start){
            start = false;
            stopTime();
            endTime = Date.now();

            totalTime = endTime - startTime;
            travelledDist = travelledDistance();
            straightDist = straightDistance();
            width = $(finish).outerWidth();

            if(wrongClicks > 0){
                wrongClicks -= 1;
            }


            var searchPhrase = $("#search_input").val().toLowerCase();

            //If wrong search phrase
            if(finish == "#search_bar" &&  searchPhrase != "product 2"){
                if(searchPhrase == ""){
                    wrongClicks += 8;
                }else if(searchPhrase != "product2"){
                    wrongClicks += 4;
                }
            }

            if(totalTime <= (maxTimeOut*1000) ){
                completed = 1;
            }
            else{
                completed = 0;
            }

            console.log( $(finish).outerWidth());
            console.log(startTime);
            console.log(endTime);
            console.log("Total time: " + totalTime);
            console.log("Wrong Clicks: " + (wrongClicks));
            console.log(points);

            console.log("Shortest Distance: " + straightDist);
            console.log("Travelled Distance: " + travelledDist);

            console.log(maxTimeOut);
            console.log(finish);
            console.log(completed);


            $("#seqModalHeader").append("Completed Successfully");

            $("#seqModal").modal('show');

        }

    });

    $(document).on("click", function(e){
        if(start){

            if(finish == "#search_bar"){

                if(e.target.id != "search_input"){
                    wrongClicks++;
                    console.log(e.target.id);
                }
            }
            else{
                wrongClicks++;
                console.log(e.target.id);
            }

        }

    });

    $(document).on("mousemove", function(e) {
        if(!start)
            return;
        points.push(e.pageX + "," + e.pageY);
    });

    function travelledDistance(){
        var distance = 0;
        var start_point, end_point;

        for (i = 0; i < points.length - 1; i++) {
            start_point = points[i].split(",");
            end_point = points[i+1].split(",");

            distance += Math.round(Math.sqrt(Math.pow(end_point[0] - start_point[0], 2) + Math.pow(end_point[1] - start_point[1], 2)));
        }

        return distance;
    }

    function straightDistance(){
        var start_point, end_point;

        start_point = points[0].split(",");
        end_point = points[points.length-1].split(",");

        return Math.round(Math.sqrt(Math.pow(end_point[0] - start_point[0], 2) + Math.pow(end_point[1] - start_point[1], 2)));
    }

    $("#nextTask").on("click", function(){

        diffScore = $("input:radio[name='difficulty']:checked").val();
        satScore = $("input:radio[name='satisfaction']:checked").val();
        timeScore = $("input:radio[name='time']:checked").val();

        var taskForm = $("#taskForm");

        taskForm.append('<input type="hidden" name="total_time" value="'+totalTime+'">');
        taskForm.append('<input type="hidden" name="wrong_clicks" value="'+wrongClicks+'">');
        taskForm.append('<input type="hidden" name="straight_dist" value="'+straightDist+'">');
        taskForm.append('<input type="hidden" name="travelled_dist" value="'+travelledDist+'">');
        taskForm.append('<input type="hidden" name="completed" value="'+completed+'">');
        taskForm.append('<input type="hidden" name="diff_score" value="'+diffScore+'">');
        taskForm.append('<input type="hidden" name="sat_score" value="'+satScore+'">');
        taskForm.append('<input type="hidden" name="time_score" value="'+timeScore+'">');
        taskForm.append('<input type="hidden" name="width" value="'+width+'">');

        taskForm.submit();
    });

    //----Change currency----//
    $("#currency_pound").on('click', function(e){
        e.preventDefault();

        $(".currency").html("&pound;");
        $(".price").html("20.99");

    });

    $("#currency_euro").on('click', function(e){
        e.preventDefault();

        $(".currency").html("&euro;");
        $(".price").html("25.99");

    });

    $("#currency_dollar").on('click', function(e){
        e.preventDefault();

        $(".currency").html("&dollar;");
        $(".price").html("28.99");

    });

    //-----Do not submit search form -------//
    $("#search_form").on("submit", function(e){
        e.preventDefault();
    });


});

