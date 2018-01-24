jQuery(function ($) {

    $('.my-color-field').wpColorPicker();


    $("#submit").click(function (event) {
        event.preventDefault();

        var input_post_type = $('#filtering_post_type').val();
        var input_columns = $('#filtering_columns').val();
        var input_taxonomy = $('#filtering_taxonomy').val();
        var input_color = $('#filtering_color').val();

        var new_shortcode = '[iso-archive post_type="' + input_post_type + '" columns="' + input_columns + '" taxonomy="' + input_taxonomy + '" color="' + input_color + '" ]';


        $('#label-shortcode').html('Copy your shortcode:');
        $('#new-shortcode').html(new_shortcode);


    })

});
