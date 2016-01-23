$( document ).ready(function() {
    //To fix values
   /* var range = $('.input-range'), value = $('.range-value');

    value.html(range.attr('value'));
    range.on('input', function(){
        value.html(this.value);
    });*/

    $(".input_range").ionRangeSlider({
            min: 1,
            max: 10,
            from: 5
    });

    $(".gallery").ionZoom({
        visibleControls: false                  // Disable visual controls
    });

    $("#loader").hide();

    $("#next_generation").on("click", function() {
        //console.log($("#form1").serialize());

       // $("#interface_thumbnails").html("<img src='img/ion.zoom.preloader.gif'>");
        $("#interface_thumbnails").hide();
        $("#loader").show();
        $("#instructions").text("Please Wait: Generating new population of interfaces...").css("text-align", "center").css("margin-top", "100px");
        $("#form1").submit();
    });


    //CONFIGURATION.php SETTINGS

    $('.config_range').each(function(i, range){

        var $range = $(range);

        var min = $range.attr("min");
        var max = $range.attr("max");
        var val = $range.value;
        var postfix = "";
        var step = $range.attr("step");

        if($range.data("postfix") != undefined){
            postfix = $range.data("postfix");
        }


        $range.ionRangeSlider({
            min: min,
            max: max,
            from: val,
            postfix: postfix,
            step: step
        });
    });



    /*
    var $pop_size = $("#pop_size");
    var min = $pop_size.attr("min");
    var max = $pop_size.attr("max");
    var val = $pop_size.value;

    $pop_size.ionRangeSlider({
        min: min,
        max: max,
        from: val
    });*/

});