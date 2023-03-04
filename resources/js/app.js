import './bootstrap';
import '../css/app.scss';

/* Funcion de jquery para hacer una peticion ajax y dar like a algun post */
$(function () {
    $(".likes").click(function ( event ){
        event.preventDefault();
        $.get("http://127.0.0.1:8000/"+$(this).attr("href")+"/"+$(this).attr("id"), function (datos) {

        });
        if ($(this).attr("href")=="darLike") {
            $(this).next().html(parseInt($(this).next().html())+1);   
            $(this).children().attr("class", "icono bi bi-heart-fill fs-2 text-dark");
            $(this).attr("href", "quitarLike");
        } else {
            $(this).next().html(parseInt($(this).next().html())-1);  
            $(this).children().attr("class", "icono bi bi-heart fs-2 text-dark");
            $(this).attr("href", "darLike");
        }
    })
});
