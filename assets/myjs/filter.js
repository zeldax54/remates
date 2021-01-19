

$('.selectpicker').change(function(){

    var raza = $('#razasfilter').val();
    var categoria = $('#categoriasfilter').val();
    var cabana = $('#cabanasfilter').val();
    
    var datos = {
         raza: raza,
        categoria:categoria,
        cabana:cabana
      };  
    
    $.ajax({
	    type: "POST",
	    url: Routing.generate('filterlotes'),
	    data: datos
	})
	.done(function(data){
        $('#countholder').html(Object.keys(data).length); 
        $('#lotescontainer').html('');      
        data.forEach(function(obj) {
           
             let div = '<div class="col-md-4 col-sm-6">'+
             '<div class="small-box-c"><div class="small-img-b">'+
             '<img src="'+getImgPrinc(obj)+'" alt="#" />'+
                '</div>'+
                '<div class="dit-t clearfix">'+
                   '<div class="left-ti">'+
                   '<h4>'+obj.nombre+'</h4>'+
                    '<p>'+
                     getCabanaName(obj)+
                     '</p>'+
                   '</div>'+
                   '<a href="#" tabindex="0">	<p>Oferta Actual:</p> $1220</a>'+
                '</div>'+
                '<div class="prod-btn">'+
                   '<a href="'+Routing.generate('lote_detail',{'id': obj.id})+'"><i class="" aria-hidden="true"></i> Hacer Pre-Oferta</a>'+                
                 
                '</div>'+
             '</div>'+
          '</div>';
          let existence =  $('#lotescontainer').html();
          $('#lotescontainer').html(existence + div);
        });
	  
       // console.log(data);
	})
	.fail(function(data)
	{
		console.log(data);
	});

});

function getImgPrinc(obj){
    console.log(obj);
    if(obj.gallery!=null && obj.gallery.length>0){
        return '/remates/public/uploads/Lote/gallery/'+obj.gallery[0];
    }
    return '/remates/public/uploads/genericsimages/bullsilhouette.jpg';
}
function getCabanaName(obj){
    if(obj.cabana!=undefined && obj.cabana!=null)
      return '<a class="cabanaclass" href=" '+Routing.generate('cabana_detail',{'id': obj.cabana.id})+' ">'+
      '<span>'+obj.cabana.nombre+'</span> </a>';
    return '';
}