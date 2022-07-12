$(document).ready(function () {
	listCitaMedica();
	comboPaciente();
	comboEspecialidad();
	comboHorarioMedico();

	$('#tituloPagina').text("Cita Medica");
	$('#tableListCitaMedica').DataTable({
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
	$("#editUserModal").on("hidden.bs.modal", function () {
		window.location.href = $('#baseUrl').val();
	});

	$("#editrel_horario_medicoModal").on("hidden.bs.modal", function () {
		window.location.href = $('#baseUrl').val();
	});

});
//-----------Cita Medica----------------
//List
function listCitaMedica() {
	$.ajax({
		type: 'ajax',
		url: 'administracion/showCitaMedica',
		async: false,
		dataType: 'json',
		success: function (data) {
			var html = '';
			var i;
			var st = '';
			var ad = '';
			if (data != true) {
				for (i = 0; i < data.length; i++) {
					//if (data[i].ID_USUARIO != 1) {
						//ad = '<a title="Editar" href="javascript:void(0);"  class="editCitaMedica" data-id="' + data[i].ID_CITA_MEDICA  + '" data-id_paciente="' + data[i].ID_USUARIO_PACIENTE + '" data-id_medico="' + data[i].ID_USUARIO_MEDICO + '" data-id_especialidad="' + data[i].ID_ESPECIALIDAD + '" data-id_horario="' + data[i].ID_HORARIO + '" data-estado="' + data[i].ESTADO + '" ><i class="fas fa-edit"></i></a>&nbsp' +
						//	'<a title="Eliminar" href="javascript:void(0);" style="color: red;" class="deleteUser" data-id="' + data[i].ID_CITA_MEDICA + '" data-paciente="' + data[i].ID_USUARIO_PACIENTE+'" ><i class="fas fa-minus-square"></i></a>';
						if(data[i].ESTADO == 'A')
						  ad = '<a title="Eliminar" href="javascript:void(0);" style="color: red;" class="deleteCitaMedica" data-id="' + data[i].ID_CITA_MEDICA + '" data-paciente="' + data[i].ID_USUARIO_PACIENTE+'" ><i class="fas fa-minus-square"></i></a>';
							
					//}
					/*if (data[i].ESTADO == 'A') {
						st = '<td><span class="badge badge-pill badge-success"><strong>Activo</strong></span></td>'
					} else {
						st = '<td><span class="badge badge-pill badge-danger"><strong>Inactivo</strong></span></td>';
						ad = '';
					}*/
					html += '<tr>' +
						'<td>' + data[i].ID_CITA_MEDICA + '</td>' +
						'<td>' + data[i].PACIENTE + '</td>' +
						'<td>' + data[i].MEDICO + '</td>' +
						'<td>' + data[i].ESPECIALIDAD + '</td>' +
						'<td>' + data[i].HORARIO  + '</td>' +
						'<td>' + data[i].ESTADONOMBRE + '</td>' +
						st +
						'<td>' +
						ad +
						'</td>' +
						'</tr>';
				}
			} else {
				toastr.warning(data);
			}
			$('#listCitaMedica').html(html);
		}
	});
}



function comboPaciente() {
	$.ajax({
		type: 'ajax',
		url: 'administracion/comboPaciente',
		async: false,
		dataType: 'json',
		success: function (data) {
			var html = '';
			if (data != true) {
				html += "<option value=''>Seleccione</option>";
				for (i = 0; i < data.length; i++) {
					html += '<option value="' + data[i].ID_USUARIO + '">' + data[i].NOMBRE + '</option>';
				}
			} else {
				toastr.warning(data);
			}
			$('#id_paciente, #editid_paciente').html(html);
		}
	});
}

function comboEspecialidad() {
	$.ajax({
		type: 'ajax',
		url: 'administracion/comboEspecialidad',
		async: false,
		dataType: 'json',
		success: function (data) {
			var html = '';
			if (data != true) {
				html += "<option value=''>Seleccione</option>";
				for (i = 0; i < data.length; i++) {
					html += '<option value="' + data[i].ID_ESPECIALIDAD + '">' + data[i].NOMBRE + '</option>';
				}
			} else {
				toastr.warning(data);
			}
			$('#editid_especialidad, #id_especialidad').html(html);
		}
	});
}

function comboMedico() {
	var id_especialidad = $('#id_especialidad').val();
	$.ajax({
		type: "POST",
		url: 'administracion/comboMedico',
		async: false,
		dataType: 'json',
		data:{"id_especialidad":id_especialidad},
		success: function (data) {
			var html = '';
			if (data != true) {
				if(data.length > 0){
					html += "<option value=''>Seleccione</option>";
					for (i = 0; i < data.length; i++) {
						html += '<option value="' + data[i].ID_USUARIO + '">' + data[i].NOMBRE + '</option>';
					}
				}else{
					html += '<option value="" > Sin Medicos para la especialidad</option>';
				}
				
			} else {
				toastr.warning(data);
			}
			$('#editid_medico, #id_medico').html(html);
		}
	});
}
function comboHorario() {
	var id_medico = $('#id_medico').val();
	$.ajax({
		type: "POST",
		url: 'administracion/comboHorarioCita',
		async: false,
		dataType: 'json',
		data:{"id_medico":id_medico},
		success: function (data) {
			var html = '';
			if (data != true) {
				if(data.length > 0){
					html += "<option value=''>Seleccione</option>";
					for (i = 0; i < data.length; i++) {
						html += '<option value="' + data[i].ID_HORARIO+ '">' + data[i].FECHAHORA + '</option>';
					}
				}else{
					html += '<option value="" > Sin hoarios para el médico</option>';
				}
				
			} else {
				toastr.warning(data);
			}
			$('#editid_horario, #id_horario').html(html);
		}
	});
}
function comboHorarioMedico() {
	$.ajax({
		type: 'ajax',
		url: 'administracion/comboHorario',
		async: false,
		dataType: 'json',
		success: function (data) {
			var html = '';
			if (data != true) {
				for (i = 0; i < data.length; i++) {
					html += '<option value="' + data[i].ID_HORARIO + '">' + data[i].FECHAHORA + '</option>';
				}
			} else {
				toastr.warning(data);
			}
			$('#editrel_horario_medico').html(html);
		}
	});
}
$('#saveCitaMedicaForm').submit('click', function () {
	var paciente = $('#id_paciente').val();
	alert(paciente);
	var especialidad = $('#id_especialidad').val();
	var medico = $('#id_medico').val();
	var horario = $('#id_horario').val();
	$.ajax({
		type: "POST",
		url: "administracion/saveCitaMedica",
		dataType: "JSON",
		data: {
			paciente: paciente,
			especialidad: especialidad,
			medico: medico,
			horario: horario
		},
		success: function (data) {
			if (data == true) {
				$('#id_paciente').val(""),
					$('#id_especialidad').val(""),
					$('#id_medico').val(""),
					$('#id_horario').val("")
					
				toastr.success('Datos de la cita medica guardado.');
				$('#addCitaMedicaModal').modal('hide');
				window.location.href = $('#baseUrl').val();
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});

//crear
$('#listCitaMedica').on('click', '.showCitaMedica', function () {
	$('#showCitaMedicaModal').modal('show');

});


$('#listCitaMedica').on('click', '.editCitaMedica', function () {
	$('#editCitaMedicaModal').modal('show');
	$("#editIdCitaMedica").val($(this).data('id'));
	$("#editid_paciente").val($(this).data('paciente'));
	$('#editid_especialidad').val($(this).data('especialidad'));
	$('#editid_medico').val($(this).data('medico'));
	$('#editid_horario').val($(this).data('horario'));

});
$('#editCitaMedicaForm').on('submit', function () {
	var id = $("#editIdCitaMedica").val().trim();
	var paciente = $("#editid_paciente").val().trim();
	var especialidad = $("#editid_especialidad").val().trim();
	var medico = $("#editid_medico").val().trim();
	var horario = $("#editid_horario").val().trim();

	$.ajax({
		type: "POST",
		url: "administracion/updateCitaMedica",
		dataType: "JSON",
		data: {
			id: id,
			paciente: paciente,
			especialidad: especialidad,
			medico: medico,
			horario: horario
		},
		success: function (data) {
			$("#editIdCitaMedica").val("");
			$("#editid_paciente").val("");
			$('#editid_especialidad').val("");
			$('#editid_medico').val("");
			$('#editid_horario').val("");
			if (data == true) {
				toastr.success('Datos de la Cita Medica actualizado.');
				$('#editCitaMedicaModal').modal('hide');
				listRol();
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
	
});

//Delete
$('#listCitaMedica').on('click', '.deleteCitaMedica', function () {
	var citaMedicaId = $(this).data('id');
	var fechahora = $(this).data('fechahora');
	$('#deleteCitaMedicaModal').modal('show');
	$('#deleteCitaMedicaId').val(citaMedicaId);
	$('#deleteFechahora').text(fechahora);
});
$('#deleteCitaMedicaForm').on('submit', function () {
	var citaMedicaId = $('#deleteCitaMedicaId').val().trim();
	$.ajax({
		type: "POST",
		url: "administracion/deleteCitaMedica",
		dataType: "JSON",
		data: { id: citaMedicaId },
		success: function (data) {
			if (data == true) {
				$("#" + citaMedicaId).remove();
				$('#deleteCitaMedicaId').val("");
				$('#deleteCitaMedicaModal').modal('hide');
				listCitaMedica();
				toastr.success('Datos de usuario eliminado con exito.');
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});

