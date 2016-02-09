/**
 * Created by Dell on 2/9/2016.
 */

$( document ).ready(function() {

    $("#taskModal").modal('show');

    var start = false, startTime, endTime, wrongClicks = 0, totalTime, points = [], straightDist, travelledDist;

    $("#start").on("click", function(e){
        start = true;
        wrongClicks = 0;
        points = [];
        startTime = Date.now();
    });

    $(finish).on("click", function(e){

        if(start){
            start = false;
            endTime = Date.now();

            totalTime = endTime - startTime;
            travelledDist = travelledDistance();
            straightDist = straightDistance();

            console.log(startTime);
            console.log(endTime);
            console.log("Total time: " + totalTime);
            console.log("Wrong Clicks: " + (wrongClicks-1));
            console.log(points);

            console.log("Shortest Distance: " + straightDist);
            console.log("Travelled Distance: " + travelledDist);

            console.log(maxTimeOut);
            console.log(finish);
        }

    });

    $(document).on("click", function(e){
        if(start){
            wrongClicks++;
        }

    });

    $(document).on("mousemove", function( event ) {
        if(!start)
            return;
        points.push(event.pageX + "," + event.pageY);
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

});

