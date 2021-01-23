$(document).ready(function () {
  $(".your-class").slick({
    dots: true,
    infinite: true,
    speed: 500,
    fade: true,
    cssEase: "linear",
    slidesToShow: 1,
    adaptiveHeight: true,
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

$(".selectpicker").change(function () {
  var raza = $("#razasfilter").val();
  var categoria = $("#categoriasfilter").val();
  var cabana = $("#cabanasfilter").val();

  var datos = {
    raza: raza,
    categoria: categoria,
    cabana: cabana,
  };

  $.ajax({
    type: "POST",
    url: Routing.generate("filterlotes"),
    data: datos,
  })
    .done(function (data) {
      $("#countholder").html(Object.keys(data).length);
      $("#lotescontainer").html("");
      data.forEach(function (obj) {       
        let div =
          '<div class="col-md-4 col-sm-6">' +
          '<div class="small-box-c"><div class="small-img-b">' +
          '<a href="' +
          Routing.generate("lote_detail", { id: obj.id }) +
          '" ><img src="' +
          getImgPrinc(obj) +
          '" alt="' +
          obj.nombre +
          '" /></a>' +
          "</div>" +
          '<div class="dit-t clearfix">' +
          '<div class="left-ti">' +
          "<h4>" +
          obj.nombre +
          "</h4>" +
          "<p>" +
          getCabanaName(obj) +
          "</p>" +
          "</div>" +
          '<a href="#" tabindex="0">	<p>Oferta Actual:</p> $1220</a>' +
          "</div>" +
          '<div class="prod-btn">' +
          '<a href="' +
          Routing.generate("lote_detail", { id: obj.id }) +
          '"><i class="" aria-hidden="true"></i> Hacer Pre-Oferta</a>' +
          "</div>" +
          "</div>" +
          "</div>";
        let existence = $("#lotescontainer").html();
        $("#lotescontainer").html(existence + div);
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
    if (responseData.hasprev == false) {
        console.log('NOT HASPREV');
        var actualValue = $("#ofertaId").val();
        if (actualValue < responseData.preciobase) {
          $("#messageofer").show("");
          $("#messageofer").html(
            "La oferta debe ser mayor o igual que el precio base"
          );
          $("#sendoferbutton").hide();
        } else {
          $("#sendoferbutton").show();
          $("#messageofer").hide("");
        } 
        $('#calculandodiv').hide(); 
    }
     else {
      //Si ya hay oferta
        console.log('HASPREV'); 
        if (
             (parseInt(actualValue) >= responseData.preciobase ) && ((actualValue - responseData.preciobase) % responseData.incminimo == 0)
           ) {
            $("#sendoferbutton").show();
            $("#messageofer").hide("");
            $('#calculandodiv').hide(); 
        
        } else {
          $("#messageofer").show("");
          $("#messageofer").html(
            "La oferta debe ser mayor que la oferta actual vigente con incremento mínimo de $" +
              responseData.incminimo );
              $('#calculandodiv').hide(); 
             
        }
    
    }
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
