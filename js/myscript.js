$( document ).ready(function() {
    //To fix values
   /* var range = $('.input-range'), value = $('.range-value');

    value.html(range.attr('value'));
    range.on('input', function(){
        value.html(this.value);
    });*/

    //-------CONSENT.php----------//

    $("#submit_consent_form").on("click", function(e){
        e.preventDefault();
        $("#submit_btn").click();
    });

    //-------CONFIGURATION.php-------//


    $("#submit_config_form").on("click", function(e){
        e.preventDefault();
        $("#configuration_form").hide();
        $("#loader").show();
        $("#config_title").text("Please Wait: Applying configuration settings and initializing algorithm...").css("text-align", "center").css("margin-top", "100px");
        $("#config_submit_btn").click();
    });

    //-------SUS.php-------------//

    $("#submit_sus_form").on("click", function(e){
        e.preventDefault();
        $("#sus_btn").click();
    });





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

    $("#tournament_size_container").hide();

    $("#selection_operator").on("change", function() {


        if($(this).val() == 2){
            $("#tournament_size_container").show();
        }
        else{
            $("#tournament_size_container").hide();
        }

    });

    $("#number_of_swap_points").hide();

    $("#crossover_operator").on("change", function() {


        if($(this).val() == 4){
            $("#number_of_swap_points").show();
        }
        else{
            $("#number_of_swap_points").hide();
        }

    });


    //-------IGA_INTERFACE.php-----//

    $(".fancybox").fancybox({
        fitToView	: true,
        width		: '100%',
        height		: '90%',
        autoSize	: true,
        padding : 0,
        openEffect: 'elastic',
        closeEffect: 'elastic',

    });

    $('.img-responsive').contenthover({
        overlay_height:65,
        effect:'slide',
        slide_speed:150,
        overlay_background:'#000',
        overlay_opacity:0.5
    });

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