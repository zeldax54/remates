$(document).ready(function()
{
    $('#lote_toros').chosen();
    $('#lote_categoria').chosen();
    $('#lote_raza').chosen();
    $('#toro_lote').chosen();
    $('#cabana_lotes').chosen();
    $('#lote_cabana').chosen();
    
    

    $('.owl-carousel').owlCarousel({
        loop: true,
        items: 1,
        navigation: true,
        pagination: true,
        lazyLoad: true,
        autoHeight:true
     
    });
});

