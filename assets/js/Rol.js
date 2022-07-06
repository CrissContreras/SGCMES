$(document).ready(function () {
	listRol();
	$(document).ready(function () {
		$('#tituloPagina').text("Rol");

		$('#tablelistRol').DataTable({
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
//List
function listRol() {
	$.ajax({
		type: 'ajax',
		url: 'administracion/showRol',
		async: false,
		dataType: 'json',
		success: function (data) {
			var html = '';
			if (data != true) {
				for (var i = 0; i < data.length; i++) {
					html += '<tr>' +
						'<td>' + data[i].ID_ROL + '</td>' +
						'<td>' + data[i].NOMBRE + '</td>' +
						//'<td>' + data[i].DESCRIPCION + '</td>' +
						'<td>' +
						'<a title="Editar" href="javascript:void(0);"  class="editRol" data-id="' + data[i].ID_ROL + '" data-nombre="' + data[i].NOMBRE + '" data-descripcion="' + data[i].DESCRIPCION + '" ><i class="fas fa-edit"></i></a>&nbsp' +
						//'<a title="Eliminar" href="javascript:void(0);" style="color: red;" class="deleteCatalogo" data-id="' + data[i].ID_ROL + '" data-nombre="' + data[i].NOMBRE + '" ><i class="fas fa-minus-square"></i></a>' +
						'</td>' +
						'</tr>';
				}
			} else {
				toastr.warning(data);
			}
			$('#listRol').html(html);
		}
	});
}
//Save
$('#saveRolForm').submit('click', function () {
	var nombre = $('#nombre').val().trim();
	var descripcion = 10;

	$.ajax({
		type: "POST",
		url: "administracion/saveRol",
		dataType: "JSON",
		data: {
			nombre: nombre,
			descripcion: descripcion
		},
		success: function (data) {
			if (data == true) {
				$("#id").val("");
				$('#nombre').val("");
				$('#descripcion').val("");

				toastr.success('Datos del rol guardado.');
				$('#addRolModal').modal('hide');
				listRol();
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});

//Edit
$('#listRol').on('click', '.editRol', function () {
	$('#editRolModal').modal('show');

	$("#showId").val($(this).data('id'));
	$("#showNombre").val($(this).data('nombre'));
	$("#showDescripcion").val($(this).data('descripcion'));

});
$('#editRolForm').on('submit', function () {

	var id = $("#showId").val().trim();
	var nombre = $("#showNombre").val().trim();
	var descripcion = $("#showDescripcion").val();

	$.ajax({
		type: "POST",
		url: "administracion/updateRol",
		dataType: "JSON",
		data: {
			id: id,
			nombre: nombre,
			descripcion: descripcion
		},
		success: function (data) {
			$("#showId").val("");
			$('#showNombre').val("");
			$('#showDescripcion').val("");
			if (data == true) {
				toastr.success('Datos del Rol actualizado.');
				$('#editRolModal').modal('hide');
				listRol();
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});

//Delete
$('#listRol').on('click', '.deleteRol', function () {
	var id = $(this).data('id');
	var nombre = $(this).data('nombre');
	$('#deleteRolModal').modal('show');
	$('#deleteRolId').val(id);
	$('#deleteRolNombre').text(nombre);
});
$('#deleteRolForm').on('submit', function () {
	var id = $('#deleteRolId').val();
	$.ajax({
		type: "POST",
		url: "administracion/deleteRol",
		dataType: "JSON",
		data: { id: id },
		success: function (data) {
			if (data == true) {
				$('#deleteRolId').val("");
				$('#deleteRolModal').modal('hide');
				listRol();
				toastr.success('Rol eliminado.');
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});
