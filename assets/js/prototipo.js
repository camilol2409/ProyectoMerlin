    

 var tiempo=new Date();
 var segundos=tiempo.getTime();
 var borrador=1;

 
  /*$( function() {
    $( ".reformable" ).resizable();
    $( ".reformable" ).draggable();
  } );
 */
 function imagenes(opcion)
 {
    var i=1;
    var imgs = document.createElement("img");
    var divs = document.createElement("div");
    divs.className="ui-widget-content reformable";
    var element = document.getElementById("division1");
    element.appendChild(divs);
    imgs.className="ui-widget-header";
    if(opcion==1)
      imgs.src="http://localhost/levantamientorequisitos/iconos/circulo.png";
    else if(opcion==2)
      imgs.src="http://localhost/levantamientorequisitos/iconos/cuadrado.png";
    else if(opcion==3)
      imgs.src="http://localhost/levantamientorequisitos/iconos/triangulo.png";
    //imgs.title=""+segundos;
    divs.id=""+segundos;
    divs.setAttribute('onclick','borrar(this.id)');
    divs.appendChild(imgs);

    $( ".reformable" ).resizable();
    $( ".reformable" ).draggable();
    segundos=segundos+1;
    

 }


 function etiquetas(opcion)
 {
    var i=1;
    var imgs = document.createElement("img");
    var divs = document.createElement("div");
    divs.className="ui-widget-content movible";
    var element = document.getElementById("division1");
    element.appendChild(divs);
    imgs.className="ui-widget-header";
    if(opcion==1)
      imgs.src="http://localhost/levantamientorequisitos/iconos/check.png";
    else if(opcion==2)
      imgs.src="http://localhost/levantamientorequisitos/iconos/llave.png";
    else if(opcion==3)
      imgs.src="http://localhost/levantamientorequisitos/iconos/lock.png";
    else if(opcion==4)
      imgs.src="http://localhost/levantamientorequisitos/iconos/corazon.png";
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
  //var element = document.getElementById("trash");
  //document.write(document.getElementById("sel").innerHTML);



  
  if(borrador==-1)
  {
      document.getElementById("sel").innerHTML = "Seleccion NoRMaL!!!!";
      //element.src="basura.png";   
  }
  else
  {
      document.getElementById("sel").innerHTML = "Seleccion BOrRAdOR!!!!";
      //element.src="basura2.png";
  }
  borrador=borrador*-1;
    

 }
function guardar()
{
    var listado="";
    var a =document.getElementById('division1').getElementsByTagName('div');
    var bodyRect = document.body.getBoundingClientRect();
    for (var i=0; i < a.length; i++ )
    {
          
          if(a[i].firstChild)
          {
            listado=listado+"*";
            var elemRect = a[i].getBoundingClientRect(),
            pathh=a[i].firstChild.src,
            x   = elemRect.left - bodyRect.left,
            y   = elemRect.top - bodyRect.top,
            ancho=elemRect.width,
            alto=elemRect.height;
            arraysource=pathh.split("/");
            source=arraysource[arraysource.length-1];
            listado=listado+source+'/';
            listado=listado+ancho+'/'+alto+'/'+x+'/'+y;
            if(a[i].firstChild.title)
              listado=listado+'+'+a[i].firstChild.title;
            


            
          }
    
    }
          alert(listado);
}