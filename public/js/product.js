$(document).ready(function(){
    
    // contador de cantidad de producto
    
    $('.count').prop('disabled', true);
    $(document).on('click','.plus',function(){
        $('.count').val(parseInt($('.count').val()) + 1 );
    });
    $(document).on('click','.minus',function(){
        $('.count').val(parseInt($('.count').val()) - 1 );
        if ($('.count').val() == 0) {
            $('.count').val(1);
        }
    });
    
    
    //carousel de fotos de producto
    
    $('.center').slick({
        arrows:true,
        centerMode: true,
        centerPadding: '60px',
        slidesToShow: 3,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
    });
    
    $('.color-choose input').on('click', function() {
        var productColor = $(this).attr('data-image');
        
        $('.active').removeClass('active');
        $('.left-column img[data-image = ' + productColor + ']').addClass('active');
        $(this).addClass('active');
    })
    
    
    
});