$(document).ready(function () {
  $(".your-class").slick({
    dots: true,
    infinite: true,
    speed: 500,
    fade: true,
    cssEase: "linear",
    slidesToShow: 1,
    adaptiveHeight: true,
    enableCellNavigation: true,
    arrows: true,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true,
          arrows: true,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });
});

$(".detailselectlote").change(function () {
  var raza = $("#razasfilter").val();
  var categoria = $("#categoriasfilter").val();
  var cabana = $("#cabanasfilter").val();
  var cabanasentity = $("#cabanasentityfilter").val();
  

  var datos = {
    raza: raza,
    categoria: categoria,
    cabana: cabana,
    cabanasentity:cabanasentity    
  };

  $.ajax({
    type: "POST",
    url: Routing.generate("filterlotes"),
    data: datos,
  })
    .done(function (response) {
      $("#countholder").html(response.data.length);
      $('.allvisible').hide();				
      response.data.forEach(function (obj) {
        $('div[name="' + obj + '"]').show();
      
      });

      // console.log(data);
    })
    .fail(function (data) {
      console.log(data);
    });
});

function getImgPrinc(obj) {
  return obj.portadaImg;
}
function getCabanaName(obj) {
  if (obj.cabana != undefined && obj.cabana != null)
    return (
      '<a class="cabanaclass" href=" ' +
      Routing.generate("cabana_detail", { id: obj.cabana.id }) +
      '">' +
      "<span>" +
      obj.cabana.nombre +
      "</span></a>"
    );
  return "";
}

  function getlastOferLive(datos,updatefieldvalue) {   
    var resp;
  $.ajax({
    type: "POST",
    url: Routing.generate("getLastOffer"),
    data: datos,
    async: false,
        cache: false,
  })
    .done(function (responseData) {
      resp = responseData;
      if(updatefieldvalue==true)
         $("#ofertaId").val(responseData.preciobase);
    })
    .fail(function (responseData) {
      console.log("Fail");
    });
    return resp;
}

//LoteDetail
async function GetlastOfer(loteId, toroId) {
  if (toroId != -1) {
    var datos = {
      loteId: loteId,
      toroId: toroId,
    };
     await getlastOferLive(datos,true);    
  }
}

async function manageoferinpage(loteId) 
{
  $('#calculandodiv').show();    
  var toroId = $('#toroselectid').val(); 
  if (toroId != -1) {
    var datos = {
      loteId: loteId,
      toroId: toroId,
    };
    var actualValue = $("#ofertaId").val();   
    var responseData = await getlastOferLive(datos,false);     
        var actualValue = $("#ofertaId").val();
        if (actualValue < responseData.preciobase) {
          $("#messageofer").show("");
          $("#messageofer").html(
            "La oferta debe ser mayor o igual a la oferta actual con un incremento mínimo de $"+ responseData.incminimo
          );
          $("#sendoferbutton").hide();
        } else {
          $("#sendoferbutton").show();
          $("#messageofer").hide("");
        } 
        $('#calculandodiv').hide(); 
   
    }  
 }
// }

function showMsj(msj, tipo) {
  $("#modalmsj").html(msj);
  $(".modal-title").html(tipo);
  $("#myModal").modal("show");
}



$("#oferform").on("submit", function (e) {
  e.preventDefault();
  $('#calculandodiv').show();    
  $.ajax({
    url: Routing.generate("setOffer"),
    type: "POST",
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
     //  $("#ofertaId").val(data.newValue);
      showMsj(data.msj, "Info");
    },
    error: function (error, stat, err) {},
  });
  setTimeout(function(){  $('#calculandodiv').hide(); }, 3000);
 
});
