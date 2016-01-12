$( document ).ready(function() {
    //To fix values
   /* var range = $('.input-range'), value = $('.range-value');

    value.html(range.attr('value'));
    range.on('input', function(){
        value.html(this.value);
    });*/

    $(".input_range").ionRangeSlider({
            min: 0,
            max: 10,
            from: 5
    });
});