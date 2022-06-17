$(document).ready(function() {
    $("#catalogo").validate({
        rules: {
            nombre: "required",
            tipo: "required"
        },
        messages: {
            nombre: "* Ingrese el nombre del catálogo ",
            tipo: "* Ingrese el nombre del tipo"
        }
    });

     /* eliminar */
     $("a[rel='eliminar']").click(function(event) {
        alert("aqui");
        var id = $(this).attr('val');
        var base_url = $("#base_url").val();
        var res = confirm("¿Seguro desea eliminar?");
        if (res) {
            $.ajax({
                type: "POST",
                url: base_url + "administracion/catalogo/eliminar/" + id,
                success: function(html) {
                    event.preventDefault();
                    if (html == 'n') {
                        alert("No se puede eliminar porque existe datos relacionados.");
                    } else
                    window.location = base_url + "administracion/catalogo";

                }
            });
        }
    });
    
});