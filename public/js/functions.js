$(document).ready(function(){
    // Setup AJAX with global CSRF token
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });


    // FAQ Categories - DataTable
    $("#faq_categories_table").DataTable(
        {
            "iDisplayLength": 100,
            "bLengthChange": false,
        } 
    );


    // Update DB row enabled or disabled 
    $('.update-row').on('click', function(){

        data = {
            target: $(this).attr('data-target'),
            value:  $(this).attr('data-value'),
            id:     $(this).parents('tr').attr('id')
        };

        var response = sendAjaxRequest( data );

        if( response == 'success' )
        {
            if( data.value == 0 )
            {
                $(this).removeClass('btn-warning').addClass('btn-success').text('Enable').attr('data-value', '1');
                $(this).parents('tr').find('.label').removeClass('label-success').addClass('label-danger').text('Disabled');
            }
            else
            {
                $(this).removeClass('btn-success').addClass('btn-warning').text('Disable').attr('data-value', '0');
                $(this).parents('tr').find('.label').removeClass('label-danger').addClass('label-success').text('Enabled');
            }
        }
    });


    // Delete DB row
    $('.delete-row').on('click', function(e){
        var $this = $(this);

        $('.modal-danger').modal();

        $('#confirm-delete').click(function(event){
            
            $('#confirm-delete').off('click');
            
            data = {
                target: $this.attr('data-target'),
                value:  $this.attr('data-value'),
                id:     $this.parents('tr').attr('id')
            };

            var response = sendAjaxRequest( data );

            if( response == 'success' )
            {
                $('.modal-danger').modal('hide');
                $this.parents('tr').fadeOut('slow');
            }
            event.preventDefault();
        });
        e.preventDefault();
    });




    // Delete Image
    $('.delete_image').on('click', function(e){
        var $this = $(this);

        $('.modal-danger').modal();

        $('#confirm-delete').click(function(event){
            
            $('#confirm-delete').off('click');
            
            data = {
                target: $this.attr('data-target'),
                value:  $this.attr('data-value'),
                id:     $this.attr('data-product_id')
            };

            var response = sendAjaxRequest( data );

            if( response == 'success' )
            {
                $('.modal-danger').modal('hide');
                $this.parent().fadeOut('slow');
            }
            event.preventDefault();
        });
        e.preventDefault();
    });

    // AJAX function that sends the request to the server
    function sendAjaxRequest(input_data)
    {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            async: false,
            url: input_data.target,
            data: {
                id: input_data.id,
                value: input_data.value,
            },
            error: function () {
                $response = 'error';
            },
            success: function (data) {
                $response = 'success';
            },
        });

        return $response;
    }

        //SEO Preview
        $('#input_slug').keyup(function () {

            var value = $(this).val();
            var slug = $('#span_slug').val(value.split(' ').join('-'));

            $('#slug').html($('#span_slug').val().split(' ').join('-'));

        });

        $('#span_title').keyup(function () {

            var value = $(this).val();
            $('#title').html(value);

        });

        $('#span_description').keyup(function () {

            var value = $(this).val();
            $('#description').html(value);

        });

    // Detail view row
    $('.details-row').on('click', function(e){
        var $this = $(this);

        $this.parent().find('.modal-detail').modal();

        e.preventDefault();
    });

});



