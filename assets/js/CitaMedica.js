$(document).ready(function () {
	listCitaMedica();
	comboPaciente();
	comboEspecialidad();

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
	var rolLogueado = $('#rolLogueado').val();

	$.ajax({
		type: 'ajax',
		url: '/gestionCitasMedicas/CitaMedica/showCitaMedica',
		async: false,
		dataType: 'json',
		success: function (data) {
			var html = '';
			var i;
			var st = '';
			var ad = '';
			if (data != true) {

				for (i = 0; i < data.length; i++) {
					ad = '';
					if (rolLogueado == '2' && data[i].ESTADO == 'A') {
						ad = '<a title="Datos de la cita" href="javascript:void(0);"  class="editDatosCitaMedica" data-id="' + data[i].ID_CITA_MEDICA + '" data-sintoma="' + data[i].SINTOMA + '" data-diagnostico="' + data[i].DIAGNOSTICO + '" data-receta="' + data[i].RECETA + '" ><i class="fas fa-edit"></i>Datos</a>&nbsp';
					}
					if (data[i].ESTADO == 'A') {

						ad = ad + '<a title="Eliminar" href="javascript:void(0);" style="color: red;" class="deleteCitaMedica" data-id="' + data[i].ID_CITA_MEDICA + '" data-paciente="' + data[i].ID_USUARIO_PACIENTE + '" data-fechahora="' + data[i].HORARIO + '" ><i class="fas fa-minus-square"></i>Eliminar&nbsp</a>';

					}
					if (data[i].ESTADO == 'T') {
						ad = '<a title="Datos de la cita" href="javascript:void(0);"  class="showDatosCitaMedica" data-sintoma="' + data[i].SINTOMA + '" data-diagnostico="' + data[i].DIAGNOSTICO + '" data-receta="' + data[i].RECETA + '" data-historial="' + data[i].HISTORIAL + '" ><i class="fas fa-show"></i>Datos</a>&nbsp';


					}
					if (data[i].ESTADO == 'A') {
						st = '<td><span class="badge badge-pill badge-success"><strong>Activo</strong></span></td>'
					} else if (data[i].ESTADO == 'I') {
						st = '<td><span class="badge badge-pill badge-danger"><strong>Inactivo</strong></span></td>';
						ad = '';
					} else if (data[i].ESTADO == 'T') {
						st = '<td><span class="badge badge-pill badge-success"><strong>Atendido</strong></span></td>';
						
					}
					html += '<tr>' +
						'<td>' + data[i].ID_CITA_MEDICA + '</td>' +
						'<td>' + data[i].PACIENTE + '</td>' +
						'<td>' + data[i].MEDICO + '</td>' +
						'<td>' + data[i].ESPECIALIDAD + '</td>' +
						'<td>' + data[i].HORARIO + '</td>' +
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
	var rolLogueado = $('#rolLogueado').val();
	$.ajax({
		type: 'ajax',
		url: '/gestionCitasMedicas/CitaMedica/comboPaciente',
		async: false,
		dataType: 'json',
		success: function (data) {
			var html = '';
			if (data != true) {
				if (rolLogueado != '3')
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
		url: '/gestionCitasMedicas/CitaMedica/comboEspecialidad',
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
		url: '/gestionCitasMedicas/CitaMedica/comboMedico',
		async: false,
		dataType: 'json',
		data: { "id_especialidad": id_especialidad },
		success: function (data) {
			var html = '';
			if (data != true) {
				if (data.length > 0) {
					html += "<option value=''>Seleccione</option>";
					for (i = 0; i < data.length; i++) {
						html += '<option value="' + data[i].ID_USUARIO + '">' + data[i].NOMBRE + '</option>';
					}
				} else {
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
		url: '/gestionCitasMedicas/CitaMedica/comboHorarioCita',
		async: false,
		dataType: 'json',
		data: { "id_medico": id_medico },
		success: function (data) {
			var html = '';
			if (data != true) {
				if (data.length > 0) {
					html += "<option value=''>Seleccione</option>";
					for (i = 0; i < data.length; i++) {
						html += '<option value="' + data[i].ID_HORARIO + '">' + data[i].FECHAHORA + '</option>';
					}
				} else {
					html += '<option value="" > Sin hoarios para el médico</option>';
				}

			} else {
				toastr.warning(data);
			}
			$('#editid_horario, #id_horario').html(html);
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
		url: "/gestionCitasMedicas/CitaMedica/saveCitaMedica",
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
		url: "/gestionCitasMedicas/CitaMedica/updateCitaMedica",
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

$('#listCitaMedica').on('click', '.editDatosCitaMedica', function () {
	$('#editDatosCitaMedicaModal').modal('show');
	$("#editDatosIdCitaMedica").val($(this).data('id'));
	$("#sintoma").val($(this).data('sintoma'));
	$('#diagnostico').val($(this).data('diagnostico'));
	$('#receta').val($(this).data('receta'));

});
$('#editDatosCitaMedicaForm').on('submit', function () {
	var id = $("#editDatosIdCitaMedica").val().trim();
	var sintoma = $("#sintoma").val();
	var diagnostico = $("#diagnostico").val();
	var receta = $("#receta").val();
	$.ajax({
		type: "POST",
		url: "/gestionCitasMedicas/CitaMedica/updateDatosCitaMedica",
		dataType: "JSON",
		data: {
			id: id,
			sintoma: sintoma,
			diagnostico: diagnostico,
			receta: receta

		},
		success: function (data) {
			$("#editDdatosIdCitaMedica").val("");
			$("#sintoma").val("");
			$('#diagnostico').val("");
			$('#receta').val("");
			if (data == true) {
				toastr.success('Datos de la Cita Medica actualizado.');
				$('#editDatosCitaMedicaModal').modal('hide');
				window.location.href = $('#baseUrl').val();
				listCitaMedica();
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;

});
$('#listCitaMedica').on('click', '.showDatosCitaMedica', function () {
	$('#showDatosCitaMedicaModal').modal('show');
	$("#showsintoma").val($(this).data('sintoma'));
	$('#showdiagnostico').val($(this).data('diagnostico'));
	$('#showreceta').val($(this).data('receta'));
	$('#showhistorial').val($(this).data('historial'));

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
		url: "/gestionCitasMedicas/CitaMedica/deleteCitaMedica",
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

