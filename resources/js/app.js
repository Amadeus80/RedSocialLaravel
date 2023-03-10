import './bootstrap';
import '../css/app.scss';
import * as bootstrap from "bootstrap";
import jQuery from 'jquery';

window.$ = jQuery;

$(function () {
    /* Hace una peticion ajax y dar like a algun post */
    let elemento;
    $(".likes").click(function ( event ){
        elemento = $(this);
        event.preventDefault();

        $.ajax({
            async:true,
            type: "GET",
            url: "http://sleepy-harbor-98328.herokuapp.com/"+$(this).attr("href")+"/"+$(this).attr("id"),
            beforeSend: function(){
                elemento.html(`<div class="spinner-border text-dark" role="status">
                <span class="visually-hidden">Loading...</span>
                </div>`);
            },
            success: function(datos){
                if (elemento.attr("href")=="darLike") {
                    elemento.next().html(parseInt(elemento.next().html())+1);   
                    elemento.html(`<i class="icono bi bi-heart-fill fs-2 text-dark"></i>`);
                    elemento.attr("href", "quitarLike");
                } else if((elemento.attr("href")=="quitarLike")) {
                    elemento.next().html(parseInt(elemento.next().html())-1);  
                    elemento.html(`<i class="icono bi bi-heart fs-2 text-dark"></i>`);
                    elemento.attr("href", "darLike");
                }
            }
        });
    })

    /* RECUPERA CON PETICION AJEX USUARIOS QUE TENGAN EN SU NOMBRE LA CADENA ESCRITA EN EL INPUT */
    $("#campoBusqueda").keyup(function(event){
        let x = $( document );
        event.preventDefault();
        if(($(this).val()).length >= 2){
            $.ajax({
                async: true,
                type: "GET",
                dataType:"json",
                url: `http://sleepy-harbor-98328.herokuapp.com/user/${$(this).val()}`,
                beforeSend : function(){
                    $("#usuarios").html(`<div class="text-center"><div class="spinner-border text-dark fs-3" style="width: 5rem; height: 5rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                    </div></div>`);
                },
                success : function(usuarios){
                    let data = "";
                    if(usuarios.length != 0){
                        for (const usuario of usuarios) {
                            let infoFollow = "No seguido";
                            if(usuario.follow){
                                infoFollow = "Seguido";
                            }
                            data += `<div class="d-flex gap-2 align-items-center"><a href="http://sleepy-harbor-98328.herokuapp.com/perfil/${usuario.user_id}"><img src="http://localhost:8000/${usuario.img}" class="rounded-circle" width="50" height="50"></a> <a href="http://sleepy-harbor-98328.herokuapp.com/perfil/${usuario.user_id}" class="text-decoration-none text-dark">${usuario.name} - ${infoFollow}</a></div>`;
                        }

                    }
                    else{
                        data = "<h2 class='text-center'>Sin coincidencias...</h2>";
                    }
                    $("#usuarios").html(data);
                }
            });
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

        let elemento = $(this);

        $.ajax({
            async:true,
            type: "GET",
            url: `http://sleepy-harbor-98328.herokuapp.com/postPerfil/${elemento.attr("href")}`,
            beforeSend: function(){
                $("#contenedorInfoPerfiles").html(`<div class="text-center"><div class="spinner-border text-dark fs-3" style="width: 5rem; height: 5rem;" role="status">
                <span class="visually-hidden">Loading...</span>
                </div></div>`);
            },
            success: function(datos){
                let data = "";
                if(datos.length > 0){
                    for (const dato of datos) {
                        data += `<div class="col-12 col-md-4 mb-3 cuadroPerfil">
                            <a href="http://sleepy-harbor-98328.herokuapp.com/post/${dato.id}"><img src="http://localhost:8000/${dato.img}" alt="" class="img-fluid rounded h-100 w-100" style="object-fit: cover;"></a>
                            </div>`
                    }
                }
                else{
                    data = "<h2 class='p-3'>No hay posts</h2>";
                }
                $("#contenedorInfoPerfiles").html(data);
            }
        });
    });

    /* Recuperar likes */
    $("#recuperarLikes").click(function(event){
        event.preventDefault();
        $(this).addClass("active");
        $("#recuperarPost").removeClass("active");
        $("#recuperarSiguiendo").removeClass("active");
        let elemento = $(this);
        $.ajax({
            async:true,
            type: "GET",
            url: `http://sleepy-harbor-98328.herokuapp.com/likesPerfil/${elemento.attr("href")}`,
            beforeSend: function(){
                $("#contenedorInfoPerfiles").html(`<div class="text-center"><div class="spinner-border text-dark fs-3" style="width: 5rem; height: 5rem;" role="status">
                <span class="visually-hidden">Loading...</span>
                </div></div>`);
            },
            success: function(datos){
                let data = "";
                if(datos.length > 0){
                    for (const dato of datos) {
                        data += `<div class="col-12 col-md-4 mb-3 cuadroPerfil">
                            <a href="http://sleepy-harbor-98328.herokuapp.com/post/${dato.id}"><img src="http://localhost:8000/${dato.img}" alt="" class="img-fluid rounded h-100 w-100"></a>
                            </div>`
                    }
                }
                else{
                    data = "<h2 class='p-3'>No hay ningún like</h2>";
                }
                $("#contenedorInfoPerfiles").html(data);
            }
        });
    });

    /* Recuperar siguiendo */
    $("#recuperarSiguiendo").click(function(event){
        event.preventDefault();
        $(this).addClass("active");
        $("#recuperarPost").removeClass("active");
        $("#recuperarLikes").removeClass("active");
        
        let elemento = $(this);

        $.ajax({
            async:true,
            type: "GET",
            url: `http://sleepy-harbor-98328.herokuapp.com/siguiendoPerfil/${elemento.attr("href")}`,
            beforeSend: function(){
                $("#contenedorInfoPerfiles").html(`<div class="text-center"><div class="spinner-border text-dark fs-3" style="width: 5rem; height: 5rem;" role="status">
                <span class="visually-hidden">Loading...</span>
                </div></div>`);
            },
            success: function(datos){
                let data = "";
                if(datos.length > 0){
                    for (const dato of datos) {
                        data += `<div class="col-12 col-md-4 mb-3">
                            <a href="http://sleepy-harbor-98328.herokuapp.com/perfil/${dato.user_id}"><img src="http://localhost:8000/${dato.img}" class="rounded-circle" height="100" width="100"></a> <a href="#" class="text-decoration-none text-dark"><h3 class="mt-2">${dato.name}</h3></a>
                            </div>`
                    }
                }
                else{
                    data = "<h2 class='p-3'>No sigue a nadie</h2>";
                }
                $("#contenedorInfoPerfiles").html(data);
            }
        });
    });

    /* OPCIONES FOLLOW */

    /* Dar Follow */
    function follow (event) {
        event.preventDefault(); 
        let id = $(this).attr("href");

        $.get(`http://sleepy-harbor-98328.herokuapp.com/follow/${$(this).attr("href")}`, function(datos){
            $("#botonFollow").html(`<a href="${id}" class="btn btn-outline-danger" id="unfollow"><i class="bi bi-person-dash-fill"></i> Unfollow</a>`);
            $("#unfollow").click(unfollow);
        })
    }
    $("#follow").click(follow);

    /* Dar Follow */
    function unfollow (event) {
        event.preventDefault();
        let id = $(this).attr("href");

        $.get(`http://sleepy-harbor-98328.herokuapp.com/unfollow/${$(this).attr("href")}`, function(datos){
            $("#botonFollow").html(`<a href="${id}" class="btn btn-outline-success" id="follow"><i class="bi bi-person-plus-fill"></i> Follow</a>`);
            $("#follow").click(follow);
        })
    }
    $("#unfollow").click(unfollow);

});

/* TOOLTIP */
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))