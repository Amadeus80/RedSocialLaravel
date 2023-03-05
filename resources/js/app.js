import './bootstrap';
import '../css/app.scss';
import jQuery from 'jquery';

window.$ = jQuery;

$(function () {
    /* Hace una peticion ajax y dar like a algun post */
    let elemento;
    let x = $( document );
    $(".likes").click(function ( event ){
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

    /* RECUPERA CON PETICION AJEX USUARIOS QUE TENGAN EN SU NOMBRE LA CADENA ESCRITA EN EL INPUT */
    $("#campoBusqueda").keyup(function(){
        if(($(this).val()).length >= 2){
            $.get(`http://127.0.0.1:8000/user/${$(this).val()}`, function(usuarios){
                let data = "";
                if(usuarios.length != 0){
                    for (const usuario of usuarios) {
                        let infoFollow = "No seguido";
                        if(usuario.follow){
                            infoFollow = "Seguido";
                        }
                        data += `<div class="d-flex gap-2 align-items-center"><a href="#"><img src="http://localhost:8000/${usuario.img}" class="rounded-circle" width="50" height="50"></a> <a href="#" class="text-decoration-none text-dark">${usuario.name} - ${infoFollow}</a></div>`;
                    }
                    
                }
                else{
                    data = "<h2 class='text-center'>Sin coincidencias...</h2>";
                }
                $("#usuarios").html(data);
            })
        }
        else if(($(this).val()).length == 0){
            $("#usuarios").html("");
        }
    });

});
