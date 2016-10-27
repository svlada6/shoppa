$( document ).ready(function() {

    // Setup AJAX with global CSRF token
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    /*-- faq accordion --*/
    $( ".our-coffees .box-pack" ).click(function() {
      $(this).find('.float-info').stop().fadeToggle();
    });

    var allPanels = $('.faq-accordion li > div').hide();
    $('.faq-accordion li > a').click(function() {
      allPanels.slideUp();
      $('.faq-accordion li > a').removeClass('active');
      $(this).addClass('active').next().slideDown();
      return false;
    });

    $(".mobile-nav").click(function() {
        $(this).toggleClass('active');
      $('.main-nav').stop().slideToggle('fast');
    });

    $(".add-plus").click(function() {
        $(this).parent().addClass('active-packeg');
    });


    $(".coffee-ofers .main-action").on('click', function(e){
        var data = {
            id: $(this).data('id'),
            name: $(this).data('name'),
            price: $(this).data('price'),
            packs: $(this).data('packs'),
            type: $(this).data('type'),
            delivery: $(this).parent().find('select').val(),
            target: "update_cart"
        };

        sendAjaxRequest( data );
        // e.preventDefault();
    });


    $("body .add-plus").on('click', function(e){
        var data = {
            id: $(this).data('id'),
            name: $(this).data('name'),
            type: $(this).data('type'),
            target: "add_item_to_cart"
        };

        var _this = $(this);

        var response = sendAjaxRequest( data );

        if( response.status == 'success' )
        {
            $('.continue-box .pull-left').text( response.message );
            $(_this).parent().find('.minus-pack').show();
            _this.parent().find('.item_name').text(response.item_amount);

            if( response.amount == 0 )
            {
                $('.add-plus').hide();
                $('.continue-box .main-action').removeClass('disabled_link');
                scrollTo( ".continue-box .main-action", 1000 ); 
            }
        }
        else
        {
            scrollTo( ".continue-box .main-action", 1000 ); 
        }

        e.preventDefault();
    });




    $("body .minus-pack").on('click', function(e){
        var data = {
            id: $(this).data('id'),
            name: $(this).data('name'),
            type: $(this).data('type'),
            target: "remove_item_from_cart"
        };

        var _this = $(this);

        var response = sendAjaxRequest( data );

        if( response.status == 'success' )
        {
            $('.continue-box .pull-left').text( response.message );
            _this.parent().find('.item_name').text(response.item_amount);
            
            if( response.item_amount == 0 )
            {
                $(_this).hide();
                $(this).parent().removeClass('active-packeg');
                _this.parent().find('.item_name').text('');
            }

            if( response.amount > 0 )
            {
                $('.add-plus').show();
                $('.continue-box .main-action').addClass('disabled_link');
                // scrollTo( ".veriety-pack", 1000 ); 
            }
        }
        else
        {
            // scrollTo( ".veriety-pack", 1000 ); 
        }

        e.preventDefault();
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
        
        data: input_data,
        
        error: function() {
            $response = 'error';
        },
        
        success: function(data) {
            $response = data;
        },
        
    });

    return $response;
}

function scrollTo( selector, interval ) 
{
    $('html, body').animate({
        scrollTop: $(selector).offset().top
    }, interval);
}