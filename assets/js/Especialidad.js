$(document).ready(function () {
	listEspecialidad();
	$(document).ready(function () {
		$('#tituloPagina').text("Especialidad");

		$('#tablelistEspecialidad').DataTable({
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
function listEspecialidad() {
	$.ajax({
		type: 'ajax',
		url: 'administracion/showEspecialidad',
		async: false,
		dataType: 'json',
		success: function (data) {
			var html = '';
			if (data != true) {
				for (var i = 0; i < data.length; i++) {
					html += '<tr>' +
						'<td>' + data[i].ID_ESPECIALIDAD + '</td>' +
						'<td>' + data[i].NOMBRE + '</td>' +
						'<td>' + data[i].DESCRIPCION + '</td>' +
						'<td>' +
						'<a title="Editar" href="javascript:void(0);"  class="editEspecialidad" data-id="' + data[i].ID_ESPECIALIDAD + '" data-nombre="' + data[i].NOMBRE + '" data-descripcion="' + data[i].DESCRIPCION + '" ><i class="fas fa-edit"></i></a>&nbsp' +
						'<a title="Eliminar" href="javascript:void(0);" style="color: red;" class="deleteEspecialidad" data-id="' + data[i].ID_ESPECIALIDAD + '" data-nombre="' + data[i].NOMBRE + '" ><i class="fas fa-minus-square"></i></a>' +
						'</td>' +
						'</tr>';
				}
			} else {
				toastr.warning(data);
			}
			$('#listEspecialidad').html(html);
		}
	});
}
//Save 
$('#saveEspecialidadForm').submit('click', function () {
	var nombre = $('#nombre').val().trim();
	var descripcion = $('#descripcion').val().trim();
	$.ajax({
		type: "POST",
		url: "administracion/saveEspecialidad",
		dataType: "JSON",
		data: {
			nombre: nombre,
			descripcion: descripcion
		},
		success: function (data) {
			alert("aqui");
			if (data == true) {
				$("#id").val("");
				$('#nombre').val("");
				$('#descripcion').val("");

				toastr.success('Datos de la especialidad guardado.');
				$('#addEspecialidadModal').modal('hide');
				listEspecialidad();
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});

//Edit
$('#listEspecialidad').on('click', '.editEspecialidad', function () {
	$('#editEspecialidadModal').modal('show');

	$("#editIdEspecialidad").val($(this).data('id'));
	$("#editNombre").val($(this).data('nombre'));
	$("#editDescripcion").val($(this).data('descripcion'));

});
$('#editEspecialidadForm').on('submit', function () {

	var id = $("#editIdEspecialidad").val().trim();
	var nombre = $("#editNombre").val().trim();
	var descripcion = $("#editDescripcion").val().trim();

	$.ajax({
		type: "POST",
		url: "administracion/updateEspecialidad",
		dataType: "JSON",
		data: {
			id: id,
			nombre: nombre,
			descripcion: descripcion
		},
		success: function (data) {
			$("#editIdEspecialidad").val("");
			$('#editNombre').val("");
			$('#editDescripcion').val("");
			if (data == true) {
				toastr.success('Datos de la Especilidad actualizado.');
				$('#editEspecialidadModal').modal('hide');
				listEspecialidad();
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});

//Delete
$('#listEspecialidad').on('click', '.deleteEspecialidad', function () {
	var id = $(this).data('id');
	var nombre = $(this).data('nombre');
	$('#deleteEspecialidadModal').modal('show');
	$('#deleteEspecialidadId').val(id);
	$('#deleteEspecialidadNombre').text(nombre);
});
$('#deleteEspecialidadForm').on('submit', function () {
	var id = $('#deleteEspecialidadId').val();
	$.ajax({
		type: "POST",
		url: "administracion/deleteEspecialidad",
		dataType: "JSON",
		data: { id: id },
		success: function (data) {
			if (data == true) {
				$('#deleteEspecialidadId').val("");
				$('#deleteEspecialidadModal').modal('hide');
				listRol();
				toastr.success('Especialidad eliminado.');
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});
