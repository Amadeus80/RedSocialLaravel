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
    $("#campoBusqueda").keyup(function(event){
        event.preventDefault();
        if(($(this).val()).length >= 2){
            $.get(`http://127.0.0.1:8000/user/${$(this).val()}`, function(usuarios){
                let data = "";
                if(usuarios.length != 0){
                    for (const usuario of usuarios) {
                        let infoFollow = "No seguido";
                        if(usuario.follow){
                            infoFollow = "Seguido";
                        }
                        data += `<div class="d-flex gap-2 align-items-center"><a href="http://127.0.0.1:8000/perfil/${usuario.user_id}"><img src="http://localhost:8000/${usuario.img}" class="rounded-circle" width="50" height="50"></a> <a href="http://127.0.0.1:8000/perfil/${usuario.user_id}" class="text-decoration-none text-dark">${usuario.name} - ${infoFollow}</a></div>`;
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

    $("#formBusqueda").submit(function(event){
        event.preventDefault();
    });

    /* LLENAR INFO PERFILES */

    /* Recuperar post */
    $("#recuperarPost").click(function(event){
        event.preventDefault();
        $(this).addClass("active");
        $("#recuperarLikes").removeClass("active");
        $("#recuperarSiguiendo").removeClass("active");

        x.ajaxStart(function(){
            $("#contenedorInfoPerfiles").html(`<div class="text-center"><div class="spinner-border text-dark fs-3" style="width: 5rem; height: 5rem;" role="status">
            <span class="visually-hidden">Loading...</span>
            </div></div>`);
        });

        $.get(`http://127.0.0.1:8000/postPerfil/${$(this).attr("href")}`, function(datos){
            let data = "";
            if(datos.length > 0){
                for (const dato of datos) {
                    data += `<div class="col-12 col-md-4 mb-3">
                        <a href="http://127.0.0.1:8000/post/${dato.id}"><img src="http://localhost:8000/${dato.img}" alt="" class="img-fluid rounded h-100 w-100"></a>
                        </div>`
                }
            }
            else{
                data = "<h2 class='p-3'>No hay posts</h2>";
            }
            $("#contenedorInfoPerfiles").html(data);
        })
    });

    /* Recuperar likes */
    $("#recuperarLikes").click(function(event){
        event.preventDefault();
        $(this).addClass("active");
        $("#recuperarPost").removeClass("active");
        $("#recuperarSiguiendo").removeClass("active");

        x.ajaxStart(function(){
            $("#contenedorInfoPerfiles").html(`<div class="text-center"><div class="spinner-border text-dark fs-3" style="width: 5rem; height: 5rem;" role="status">
            <span class="visually-hidden">Loading...</span>
            </div></div>`);
        });

        $.get(`http://127.0.0.1:8000/likesPerfil/${$(this).attr("href")}`, function(datos){
            let data = "";
            if(datos.length > 0){
                for (const dato of datos) {
                    data += `<div class="col-12 col-md-4 mb-3">
                        <a href="http://127.0.0.1:8000/post/${dato.id}"><img src="http://localhost:8000/${dato.img}" alt="" class="img-fluid rounded h-100 w-100"></a>
                        </div>`
                }
            }
            else{
                data = "<h2 class='p-3'>No has dado ningún like</h2>";
            }
            $("#contenedorInfoPerfiles").html(data);
        })
    });

    /* Recuperar siguiendo */
    $("#recuperarSiguiendo").click(function(event){
        event.preventDefault();
        $(this).addClass("active");
        $("#recuperarPost").removeClass("active");
        $("#recuperarLikes").removeClass("active");

        x.ajaxStart(function(){
            $("#contenedorInfoPerfiles").html(`<div class="text-center"><div class="spinner-border text-dark fs-3" style="width: 5rem; height: 5rem;" role="status">
            <span class="visually-hidden">Loading...</span>
            </div></div>`);
        });

        $.get(`http://127.0.0.1:8000/siguiendoPerfil/${$(this).attr("href")}`, function(datos){
            let data = "";
            if(datos.length > 0){
                for (const dato of datos) {
                    data += `<div class="col-12 col-md-4 mb-3">
                        <a href="http://127.0.0.1:8000/perfil/${dato.user_id}"><img src="http://localhost:8000/${dato.img}" class="rounded-circle" height="100" width="100"></a> <a href="#" class="text-decoration-none text-dark"><h3 class="mt-2">${dato.name}</h3></a>
                        </div>`
                }
            }
            else{
                data = "<h2 class='p-3'>No sigues a nadie</h2>";
            }
            $("#contenedorInfoPerfiles").html(data);
        })
    });

});

/* TOOLTIP */
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))