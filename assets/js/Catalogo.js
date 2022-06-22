$(document).ready(function () {
	listCatalogo();
	$(document).ready(function () {
		$('#tituloPagina').text("Catálogo");

		$('#tablelistCatalogo').DataTable({
			"lengthChange": true,
			"info": true,
			"paging": true,
			"processing": true,
			"language": {
				"sProcessing": "Procesando...",
				"sLengthMenu": "Mostrar _MENU_ registros",
				"sZeroRecords": "No se encontraron resultados",
				"sEmptyTable": "Ningún dato disponible en esta tabla",
				"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix": "",
				"sSearch": "Buscar:",
				"sUrl": "",
				"sInfoThousands": ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst": "Primero",
					"sLast": "Último",
					"sNext": "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			}
		});
	});
});
//-----------Catalogo----------------
//List
function listCatalogo() {
	$.ajax({
		type: 'ajax',
		url: 'administracion/showCatalogo',
		async: false,
		dataType: 'json',
		success: function (data) {
			var html = '';
			if (data != true) {
				for (var i = 0; i < data.length; i++) {
					html += '<tr id='+ data[i].TIP +'>' +
						'<td>' + data[i].ID_CATALOGO + '</td>' +
						'<td>' + data[i].NOMBRE + '</td>' +
						'<td>' + data[i].TIPO + '</td>' +
						'<td>' +
						'<a title="Editar" href="javascript:void(0);"  class="editCatalogo" data-id="' + data[i].ID_CATALOGO + '" data-tipo="' + data[i].TIPO + '" data-tip="' + data[i].TIP + '" data-nombre="' + data[i].NOMBRE + '" ><i class="fas fa-edit"></i></a>&nbsp' +
						'<a title="Eliminar" href="javascript:void(0);" style="color: red;" class="deleteCatalogo" data-id="' + data[i].ID_CATALOGO + '" data-nombre="' + data[i].NOMBRE + '" ><i class="fas fa-minus-square"></i></a>' +
						'</td>' +
						'</tr>';
				}
			} else {
				toastr.warning(data);
			}
			$('#listCatalogo').html(html);
		}
	});
}
//Save
$('#saveCatalogoForm').submit('click', function () {
	var nombre = $('#nombre').val().trim();
	var tipo = $('#tipo').val().trim();

	$.ajax({
		type: "POST",
		url: "administracion/saveCatalogo",
		dataType: "JSON",
		data: {
			nombre: nombre,
			tipo: tipo
		},
		success: function (data) {
			if (data == true) {
				$("#id").val("");
				$('#nombre').val("");
				$('#tipo').val("");

				toastr.success('Datos de catálogo guardado.');
				$('#addCatalogoModal').modal('hide');
				listCatalogo();
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});

//Edit
$('#listCatalogo').on('click', '.editCatalogo', function () {
	$('#editCatalogoModal').modal('show');

	$("#showId").val($(this).data('id'));
	$("#showNombre").val($(this).data('nombre'));
	$("#showTipo").val($(this).data('tip'));

});
$('#editCatalogoForm').on('submit', function () {

	var id = $("#showId").val().trim();
	var nombre = $("#showNombre").val().trim();
	var tipo = $("#showTipo").val().trim();

	$.ajax({
		type: "POST",
		url: "administracion/updateCatalogo",
		dataType: "JSON",
		data: {
			id: id,
			nombre: nombre,
			tipo: tipo
		},
		success: function (data) {
			$("#showId").val("");
			$('#showNombre').val("");
			$('#showTipo').val("");
			if (data == true) {
				toastr.success('Datos de catálogo actualizado.');
				$('#editCatalogoModal').modal('hide');
				listCatalogo();
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});

//Delete
$('#listCatalogo').on('click', '.deleteCatalogo', function () {
	var id = $(this).data('id');
	var nombre = $(this).data('nombre');
	$('#deleteCatalogoModal').modal('show');
	$('#deleteCatalogoId').val(id);
	$('#deleteCatalogoNombre').text(nombre);
});
$('#deleteCatalogoForm').on('submit', function () {
	var id = $('#deleteCatalogoId').val();
	$.ajax({
		type: "POST",
		url: "administracion/deleteCatalogo",
		dataType: "JSON",
		data: { id: id },
		success: function (data) {
			if (data == true) {
				$('#deleteCatalogoId').val("");
				$('#deleteCatalogoModal').modal('hide');
				listCatalogo();
				toastr.success('Catálogo eliminado.');
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});
