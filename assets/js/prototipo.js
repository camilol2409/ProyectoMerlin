 var tiempo=new Date();
 var segundos=tiempo.getTime();
 var borrador=1;
 function imagenes(opcion)
 {
    //$.borrando = false;
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
    imgs.src=urll+opcion+".png";
    //imgs.title=""+segundos;
    divs.id=""+segundos;
        
    divs.setAttribute('onclick','borrar(this.id)');
    divs.appendChild(imgs);

    $( ".reformable" ).resizable({
      minWidth: 50, 
      minHeight: 50,
      maxWidth: 350,
      maxHeight: 350
    });
   $(".reformable").draggable({ containment: [465, 62, 990, 460] });
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
      imgs.src=urll+opcion;
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
    element.parentNode.removeChild(element);
  }
 }

 function setBorrar()
 {
  if(borrador==-1)
  {
      document.getElementById("borrador").style.color = "blue";
      //element.src="basura.png"; 
      $.borrando = false;  
  }
  else
  {
      document.getElementById("borrador").style.color = "red";
      //element.src="basura2.png";
      $.borrando = true;
  }
  borrador=borrador*-1;
    
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
  if (!$.estado_actual[pageNumber]) {
    return;
  }
  if ($.pagina_actual != pageNumber) {
    var estado = obtenerEstadoActualPagina();
    $.estado_actual[$.pagina_actual] = $.estado_actual[$.pagina_actual] || {};
    $.estado_actual[$.pagina_actual]['elementos'] = estado;
    $.estado_actual[$.pagina_actual]['nombre'] = $('#page_' + $.pagina_actual + ' span.name-holder').html();
    $("#page_list .page-element.bg-primary").removeClass('bg-primary');
    $('#page_'+pageNumber).addClass('bg-primary');
    $('#contenido_lienzo').html('');
    repaint(pageNumber);
    $.pagina_actual = pageNumber;
  }
}

function addPage() {
  // TODO: obtener el estado actual y guardarlo
  var estado = obtenerEstadoActualPagina();
  var currentNumber = $.numero_de_paginas + $.deletedPages;
  $.estado_actual[$.pagina_actual] = $.estado_actual[$.pagina_actual] || {};
  $.estado_actual[$.pagina_actual]['elementos'] = estado;
  $.estado_actual[$.pagina_actual]['nombre'] = "Página " + $.pagina_actual;
  currentNumber++;
  $.estado_actual[currentNumber] = $.estado_actual[currentNumber] || {};
  $.estado_actual[currentNumber]['nombre'] = "Página " + currentNumber;
  $('#page_list').append('<div id = "page_' + currentNumber + '" class = "col page-element" onclick = "changePage(' + currentNumber + ')"><span class = "name-holder"> Página ' + currentNumber + '</span><button onclick = "launchEditModal('+ currentNumber +')" class= "btn btn-edit btn-link float-right"><span class = "mdi mdi-pencil"></span></button ><button onclick = "deletePage('+ currentNumber +')" class= "btn btn-link float-right btn-delete"><span class = "mdi mdi-delete"></span></button ></div>');
  $.pagina_actual = currentNumber;
  $.numero_de_paginas++;
  // Seleccionar la nueva página
  $("#page_list .page-element.bg-primary").removeClass('bg-primary')
  $("#page_list .page-element:last-child").addClass('bg-primary')
  // Limpiar el lienzo
  $('#contenido_lienzo').html('');
}

function repaint(pageNumber) {
  if(!$.estado_actual || !$.estado_actual[pageNumber]) {
    return
  }
  var elementos = $.estado_actual[pageNumber]['elementos'];
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
    newElement.draggable({ containment: [455,62,970,465] });
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
        //$.borrando = false;
      }
    })
    $('#contenido_lienzo').append(newElement);
  });
}

function guardar(base_url, lienzo_id) {
  // Capturar estado actual antes de enviar
  $.estado_actual[$.pagina_actual] = $.estado_actual[$.pagina_actual] || {};
  $.estado_actual[$.pagina_actual]['elementos'] = obtenerEstadoActualPagina();
  $.estado_actual[$.pagina_actual]['nombre'] = $('#page_' + $.pagina_actual + ' span.name-holder').html();
  debugger;
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
      ordered_indexes = Object.keys($.estado_actual).map((el) => parseInt(el)).sort();
      changePage(ordered_indexes[ordered_indexes.indexOf(pageNumber) - 1]);
    }
    delete($.estado_actual[pageNumber]);
    $.deletedPages++;
    $("#page_" + pageNumber).remove();
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

function launchEditModal(page_number) {
  $.editing_name_page = page_number;
  $('#cambiarNombrePaginaModal').modal('show');
}

function guardarNuevoNombre() {
  var list_element = $('#page_' + $.editing_name_page + ' span.name-holder');
  $.estado_actual[$.editing_name_page] = $.estado_actual[$.editing_name_page] || {};
  $.estado_actual[$.editing_name_page]['nombre'] = $('#new_page_name').val();
  list_element.html($('#new_page_name').val());
  $('#cambiarNombrePaginaModal').modal('hide');
}

$(document).ready(function() {
  $.pagina_actual = 1;
  $.numero_de_paginas = 1;
  $.deletedPages = 0;
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