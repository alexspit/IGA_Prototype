$( document ).ready(function() {
    //To fix values
    var range = $('.input-range'), value = $('.range-value');

    value.html(range.attr('value'));
    range.on('input', function(){
        value.html(this.value);
    });
});