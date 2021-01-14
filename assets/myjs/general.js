$(document).ready(function()
{
    $('#lote_toros').chosen();
    $('#lote_categoria').chosen();
    $('#lote_raza').chosen();
    $('#toro_lote').chosen();

    $('.owl-carousel').owlCarousel({
        items:1,
        merge:true,
        loop:true,
        margin:10,
        video:true,
        lazyLoad:true,
        center:true,
        responsive:{
            480:{
                items:2
            },
            600:{
                items:4
            }
        }
    });
});

