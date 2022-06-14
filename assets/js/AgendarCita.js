$(document).ready(function () {
    $('#tituloPagina').text("Agendar Cita Médica");
    
});

//registro papel
/*function listPapel() {
    $.ajax({
        type: 'ajax',
        url: 'administracion/showRegPapel',
        async: false,
        dataType: 'json',
        success: function (data) {
            var html = '';
            var i;
            if (data != true) {
                for (i = 0; i < data.length; i++) {
                    html += '<tr id="' + data[i].REPA_ID + '">' +
                        '<td>' + data[i].REPA_FECHA + '</td>' +
                        '<td>' + data[i].REPA_RESMAS + '</td>' +
                        '<td>' + data[i].GUIA_NUMERO + '</td>' +
                        '<td>' + data[i].SITE_CLIENTE + '</td>' +
                        '<td>' +
                        '<a title="Eliminar" href="javascript:void(0);" style="color: red;" class="deleteRegPapel" data-id="' + data[i].REPA_ID + '" data-guia="' + data[i].GUIA_ID + '" data-fecha="' + data[i].REPA_FECHA + '" data-resmas="' + data[i].REPA_RESMAS + '"><i class="fas fa-minus-square"></i></a>' +
                        '</td>' +
                        '</tr>';
                }
            } else {
                toastr.warning(data);
            }
            $('#listPapel').html(html);
        }
    });
}*/