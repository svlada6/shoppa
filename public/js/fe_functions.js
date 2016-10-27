$(document).ready(function(){
    // Setup AJAX with global CSRF token
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    


});



// AJAX function that sends the request to the server
function sendAjaxRequest( input_data )
{
    $.ajax({
        type:       'POST',
        dataType:   'json',
        async:      false,
        url:        input_data.target,
        
        data: {
            id: input_data.id,
            value: input_data.value,
        },
        
        error: function() {
            $response = 'error';
        },
        
        success: function(data) {
            $response = 'success';
        },
        
    });

    return $response;
}