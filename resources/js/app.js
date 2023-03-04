import './bootstrap';
import '../css/app.scss';

/* Funcion de jquery para hacer una peticion ajax y dar like a algun post */
$(function () {
    let elemento;
    $(".likes").click(function ( event ){
        let x = $( document );
        elemento = $(this);
        event.preventDefault();
        x.ajaxStart(function(){
            elemento.html(`<div class="spinner-border text-dark" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>`);
        });
        $.get("http://127.0.0.1:8000/"+$(this).attr("href")+"/"+$(this).attr("id"), function (datos) {
            if (elemento.attr("href")=="darLike") {
                elemento.next().html(parseInt(elemento.next().html())+1);   
                elemento.html(`<i class="icono bi bi-heart-fill fs-2 text-dark"></i>`);
                elemento.attr("href", "quitarLike");
            } else if((elemento.attr("href")=="quitarLike")) {
                elemento.next().html(parseInt(elemento.next().html())-1);  
                elemento.html(`<i class="icono bi bi-heart fs-2 text-dark"></i>`);
                elemento.attr("href", "darLike");
            }
        });
    })
});
