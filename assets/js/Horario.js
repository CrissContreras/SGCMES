$(document).ready(function () {
	listHorario();
	$(document).ready(function () {
		$('#tituloPagina').text("Horario");

		$('#tablelistHorario').DataTable({
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
function listHorario() {
	$.ajax({
		type: 'ajax',
		url: 'administracion/showHorario',
		async: false,
		dataType: 'json',
		success: function (data) {
			var html = '';
			if (data != true) {
				for (var i = 0; i < data.length; i++) {
					html += '<tr>' +
						'<td>' + data[i].ID_HORARIO + '</td>' +
						'<td>' + data[i].FECHAHORA + '</td>' +
						'<td>' + data[i].DESCRIPCION + '</td>' +
						'<td>' +
						'<a title="Editar" href="javascript:void(0);"  class="editHorario" data-id="' + data[i].ID_HORARIO + '" data-fechahora="' + data[i].FECHAHORA + '" data-descripcion="' + data[i].DESCRIPCION + '" ><i class="fas fa-edit"></i></a>&nbsp' +
						'<a title="Eliminar" href="javascript:void(0);" style="color: red;" class="deleteHorario" data-id="' + data[i].ID_HORARIO + '" data-fechahora="' + data[i].FECHAHORA + '" ><i class="fas fa-minus-square"></i></a>' +
						'</td>' +
						'</tr>';
				}
			} else {
				toastr.warning(data);
			}
			$('#listHorario').html(html);
		}
	});
}
//Save 
$('#saveHorarioForm').submit('click', function () {
	var fechahora = $('#fechahora').val().trim();
	var descripcion = $('#descripcion').val().trim();
	$.ajax({
		type: "POST",
		url: "administracion/saveHorario",
		dataType: "JSON",
		data: {
			fechahora: fechahora,
			descripcion: descripcion
		},
		success: function (data) {
			if (data == true) {
				$("#id").val("");
				$('#fechahora').val("");
				$('#descripcion').val("");

				toastr.success('Datos del horario guardado.');
				$('#addHorarioModal').modal('hide');
				listHorario();
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});

//Edit
$('#listHorario').on('click', '.editHorario', function () {
	$('#editHorarioModal').modal('show');

	$("#editIdHorario").val($(this).data('id'));
	//$("#editfechahora").val($(this).data('fechahora'));
	$("#editfechahora").val($(this).data('23/06/2022 23:00'));
	$("#editDescripcion").val($(this).data('descripcion'));

});
$('#editHorarioForm').on('submit', function () {

	var id = $("#editIdHorario").val().trim();
	var fechahora = $("#editfechahora").val().trim();
	var descripcion = $("#editDescripcion").val().trim();

	$.ajax({
		type: "POST",
		url: "administracion/updateHorario",
		dataType: "JSON",
		data: {
			id: id,
			fechahora: fechahora,
			descripcion: descripcion
		},
		success: function (data) {
			$("#editIdHorario").val("");
			$('#editfechahora').val("");
			$('#editDescripcion').val("");
			if (data == true) {
				toastr.success('Datos del horario actualizado.');
				$('#editHorarioModal').modal('hide');
				listHorario();
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});

//Delete
$('#listHorario').on('click', '.deleteHorario', function () {
	var id = $(this).data('id');
	var fechahora = $(this).data('fechahora');
	$('#deleteHorarioModal').modal('show');
	$('#deleteHorarioId').val(id);
	$('#deleteHorarioNombre').text(nombre);
});
$('#deleteHorarioForm').on('submit', function () {
	var id = $('#deleteHorarioId').val();
	$.ajax({
		type: "POST",
		url: "administracion/deleteHorario",
		dataType: "JSON",
		data: { id: id },
		success: function (data) {
			if (data == true) {
				$('#deleteHorarioId').val("");
				$('#deleteHorarioModal').modal('hide');
				listHorario();
				toastr.success('Horario eliminado.');
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});
