 var tiempo=new Date();
 var segundos=tiempo.getTime();

 function imagenes(opcion)
 {
    $.borrando = false;
    var i=1;
    var imgs = document.createElement("img");
    var divs = document.createElement("div");
    divs.className="ui-widget-content reformable";
    var element = document.getElementById("contenido_lienzo");
    $(divs).on('click', function(element) {
      if($.borrando) {
      
        var elementToRemove = $(element.target).hasClass('ui-draggable') ? $(element.target) : $(element.target).parents('.ui-draggable').remove()
        $.borrando = false;
      }
    });
    element.appendChild(divs);
    imgs.className="ui-widget-header";
    if(opcion==1)
      imgs.src=urll+"circulo.png";
    else if(opcion==2)
      imgs.src=urll+"cuadrado.png";
    else if(opcion==3)
      imgs.src=urll+"triangulo.png";
    //imgs.title=""+segundos;
    divs.id=""+segundos;
    divs.appendChild(imgs);

    $( ".reformable" ).resizable({
      minWidth: 50, 
      minHeight: 50,
      maxWidth: 350,
      maxHeight: 350
    });
   $(".reformable").draggable({ containment: [316, 62, 935, 461] });
    segundos=segundos+1;
 }


 function etiquetas(opcion)
 {
   $.borrando = false;
    var i=1;
    var imgs = document.createElement("img");
    var divs = document.createElement("div");
    divs.className="ui-widget-content movible";
    var element = document.getElementById("contenido_lienzo");
    element.appendChild(divs);
    imgs.className="ui-widget-header";
    if(opcion==1)
      imgs.src=urll+"check.png";
    else if(opcion==2)
      imgs.src=urll+"llave.png";
    else if(opcion==3)
      imgs.src=urll+"lock.png";
    else if(opcion==4)
      imgs.src=urll+"corazon.png";
    imgs.title="etiqueta"+"\n"+"encargado";
    divs.id=""+segundos;
    divs.setAttribute('onclick','borrar(this.id)');
    divs.setAttribute('ondblclick','nuevaEtiqueta(this.id)');
    divs.appendChild(imgs);

    $( ".movible" ).draggable();
    segundos=segundos+1;
    

 }
 function nuevaEtiqueta(id)
 {
      var etiqueta = document.getElementById(id).firstChild;
      if(etiqueta.title)
      {




        //alert(etiqueta.title);
        var arr = etiqueta.title.split("\n");
        var valor=document.getElementById("valor_etiqueta");
        var encargado=document.getElementById("valor_encargado");
        var valid=document.getElementById("valor_id"); 

//
$.confirm({
                            title: 'Etiqueta',
                            content: 'VALOR DE LA ETIQUETA:'+arr[0]+'<br> ENCARGAD@:'+arr[1]+'<br> Desea modificarla????',
                            icon: 'fa fa-question-circle',
                            animation: 'scale',
                            closeAnimation: 'scale',
                            opacity: 0.5,
                            buttons: {
                                'confirm': {
                                    text: 'SI',
                                    btnClass: 'btn-blue',
                                    action: function () {
                                        valid.setAttribute('value',id);
                                        $("#modalEtiqueta").modal();
                                    }
                                },
                                no: function () {
                                    //$.alert('you clicked on <strong>cancel</strong>');
                                },
                            }
                        });

//


        
      } 
      //var element=document.getElementById("valor_encargado");
      //element.setAttribute('value','netflix special');
      
 }
 function registrarEtiqueta()
 {
    var etiqueta = document.getElementById($("#valor_id").val()).firstChild;
    etiqueta.setAttribute('title',$("#valor_etiqueta").val()+"\n"+$("#valor_encargado").val());
 $("#modal_etiqueta").on("hidden.bs.modal", function(){
    $(".modal-body").html("");
});
    //alert($("#valor_id").val());

 }

 function borrar(titulo)
 {
   
  if(borrador==-1)
  {
    
    var element = document.getElementById(titulo);
    var bodyRect = document.body.getBoundingClientRect(),
    elemRect = element.getBoundingClientRect(),
    offset   = elemRect.left - bodyRect.left,
    tamanio=elemRect.width;

alert('Element is ' + tamanio + ' vertical pixels from <body>');
    element.parentNode.removeChild(element);
    
  }
 }

 function setBorrar()
 {
    $.borrando = true;
 }
function obtenerEstadoActualPagina()
{
  var listaElementos = [];
  var listado="";
  
  console.log('Hay ' + $('#contenido_lienzo > div').length + ' elementos');
  htmlElements = $('#contenido_lienzo > div')
  for (let index = 0; index < htmlElements.length; index++) {
    const element = $(htmlElements[index]);
    const img = element.find('img');
    elemento = { 
      source: img.attr('src'),
      width: element.css('width'),
      height: element.css('height'),
      left: element.css('left'),
      top: element.css('top')
    };
    listaElementos.push(elemento);
  }
  return listaElementos;
}

function changePage(pageNumber) {
  if ($.pagina_actual != pageNumber) {
    var estado = obtenerEstadoActualPagina();
    $.estado_actual[$.pagina_actual] = estado;
    $("#page_list .page-element.bg-primary").removeClass('bg-primary');
    $($('#page_list .page-element')[pageNumber - 1]).addClass('bg-primary');
    $('#contenido_lienzo').html('');
    repaint(pageNumber);
    $.pagina_actual = pageNumber;
  }
}

function addPage() {
  // TODO: obtener el estado actual y guardarlo
  var estado = obtenerEstadoActualPagina();
  var currentNumber = $.numero_de_paginas;
  $.estado_actual[$.pagina_actual] = estado;
  currentNumber++;
  $('#page_list').append('<div class = "col page-element" onclick = "changePage(' + currentNumber + ')"><span> Página ' + currentNumber + '</span><button onclick = "deletePage('+ currentNumber +')" class= "btn btn-link float-right btn-delete"><span class = "mdi mdi-delete"></span></button ></div>');
  $.pagina_actual = currentNumber;
  $.numero_de_paginas = currentNumber;
  // Seleccionar la nueva página
  $("#page_list .page-element.bg-primary").removeClass('bg-primary')
  $("#page_list .page-element:last-child").addClass('bg-primary')
  // Limpiar el lienzo
  $('#contenido_lienzo').html('');
}

function repaint(pageNumber) {
  var elementos = $.estado_actual[pageNumber];
  elementos.forEach(element => {
    var newElement = $('<div></div>');
    newElement.css('width', element.width);
    newElement.css('height', element.height);
    newElement.css('left', element.left);
    newElement.css('top', element.top);
    newElement.css('position', 'absolute');
    imgElement = $('<img/>');
    imgElement.attr('src', element.source);
    newElement.append(imgElement);
    newElement.draggable({ containment: [316, 62, 935, 461] });
    newElement.resizable({
      minWidth: 50,
      minHeight: 50,
      maxWidth: 350,
      maxHeight: 350
    });
    newElement.on('click', function(element) {
      if($.borrando) {
        var elementToRemove = $(element.target).hasClass('ui-draggable') ? $(element.target) : $(element.target).parents('.ui-draggable')
        elementToRemove.remove()
        $.borrando = false;
      }
    })
    $('#contenido_lienzo').append(newElement);
  });
}

function guardar(base_url, lienzo_id) {
  // Capturar estado actual antes de enviar
  $.estado_actual[$.pagina_actual] = obtenerEstadoActualPagina();
  $.post(base_url + '/PrototipoController/save/' + lienzo_id, $.estado_actual)
    .done(function (data) {
        alert('Estado guardado exitosamente');
    });
}

function deletePage(pageNumber) {
  if($.numero_de_paginas == 1) {
    alert('No puedes borrar todas las páginas');
  }
  else if(confirm('¿Realmente desea borrar esta página?')) {
    $.numero_de_paginas = $.numero_de_paginas - 1;
    if(pageNumber == $.pagina_actual) {
      changePage($.pagina_actual - 1);
    }
    delete($.estado_actual[pageNumber]);
    $($("#page_list .page-element")[pageNumber - 1]).remove();
  }
}

function groupBy(list, keyGetter) {
  const map = new Map();
  list.forEach((item) => {
    const key = keyGetter(item);
    const collection = map.get(key);
    if (!collection) {
      map.set(key, [item]);
    } else {
      collection.push(item);
    }
  });
  return map;
}

$(document).ready(function() {
  $.pagina_actual = 1;
  $.numero_de_paginas = 1;
  $.estado_actual = {};
  $.borrando = false;
  grouped = groupBy($.estado_desde_db, element => element['numero']);
  arr = Array.from(grouped.entries());
  arr.forEach(el => {
    el[1] = el[1].map(function (el2) {
      return { top: el2.top, left: el2.left_position, width: el2.width, height: el2.height, source: el2.source };
    });
  });
  $.estado_actual = arr.reduce(function(map, element) {
    map[element[0]] = element[1];
    return map;
  }, {});
  for (let i = 0; i < (arr.length - 1); i++) {
    repaint($.pagina_actual);
    addPage();
  }
  repaint($.pagina_actual);
});