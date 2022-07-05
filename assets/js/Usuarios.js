$(document).ready(function () {
	listUsuarios();
	comboRol();
	comboEspecialidad();
	comboHorarioMedico();

	$('#tituloPagina').text("Usuarios");
	$('#divEspecialidad').hide(true);

	$('#tableListUsuarios').DataTable({
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

	$("#showUserModal").on("hidden.bs.modal", function () {
		window.location.href = $('#baseUrl').val();
	});

});
//-----------Usuario----------------
//List
function listUsuarios() {
	$.ajax({
		type: 'ajax',
		url: 'administracion/showUsuario',
		async: false,
		dataType: 'json',
		success: function (data) {
			var html = '';
			var i;
			var st = '';
			var ad = '';
			if (data != true) {
				for (i = 0; i < data.length; i++) {
					if (data[i].ID_USUARIO != 1) {
						ad = '<a title="Editar" href="javascript:void(0);"  class="editUser" data-id="' + data[i].ID_USUARIO + '" data-nombre="' + data[i].NOMBRE + '" data-apellido="' + data[i].APELLIDO + '" data-tipo_identificacion="' + data[i].TIPO_IDENTIFICACION + '" data-identificacion="' + data[i].IDENTIFICACION + '" data-nombre_usuario="' + data[i].NOMBRE_USUARIO + '" data-correo="' + data[i].CORREO + '" data-telefono="' + data[i].TELEFONO + '" data-direccion="' + data[i].DIRECCION + '" data-ciudad_residencia="' + data[i].CIUDAD_RESIDENCIA + '" data-fecha_nacimiento="' + data[i].FECHA_NACIMIENTO + '" data-genero="' + data[i].GENERO + '" data-id_rol="' + data[i].ID_ROL + '" data-id_especialidad="' + data[i].ID_ESPECIALIDAD + '" ><i class="fas fa-edit"></i></a>&nbsp' +
							'<a title="Eliminar" href="javascript:void(0);" style="color: red;" class="deleteUser" data-id="' + data[i].ID_USUARIO + '" data-nombre="' + data[i].NOMBRE +' '+data[i].APELLIDO +'" ><i class="fas fa-minus-square"></i></a>';
						if(data[i].ID_ROL == 2){
						    ad += '&nbsp<a title="Horarios" href="javascript:void(0);"  class="editrel_horario_medico" data-id="' + data[i].ID_USUARIO + '" data-nombre="' + data[i].NOMBRE + '" data-apellido="' + data[i].APELLIDO + '" data-horario_medico="' + data[i].ID_HORARIO_MEDICO +'"><i class="fas fa-clock"></i></a>&nbsp';	
						}	
					}
					if (data[i].ESTADO == 'A') {
						st = '<td><span class="badge badge-pill badge-success"><strong>Activo</strong></span></td>'
					} else {
						st = '<td><span class="badge badge-pill badge-danger"><strong>Inactivo</strong></span></td>';
						ad = '';
					}
					html += '<tr>' +
						'<td>' + data[i].ID_USUARIO + '</td>' +
						'<td>' + data[i].NOMBRE + '</td>' +
						'<td>' + data[i].APELLIDO + '</td>' +
						'<td>' + data[i].IDENTIFICACION + '</td>' +
						'<td>' + data[i].NOMBRE_USUARIO + '</td>' +
						'<td>' + data[i].CORREO + '</td>' +
						'<td>' + data[i].ROL_NOMBRE + '</td>' +
						st +
						'<td>' +
						'<a title="Mostrar" href="javascript:void(0);"  style="color: green;" class="showUser" data-id="' + data[i].ID_USUARIO + '" data-nombre="' + data[i].NOMBRE + '" data-apellido="' + data[i].APELLIDO + '" data-tipo_identificacion="' + data[i].TIPO_IDENTIFICACION + '" data-identificacion="' + data[i].IDENTIFICACION + '" data-nombre_usuario="' + data[i].NOMBRE_USUARIO + '" data-correo="' + data[i].CORREO + '" data-telefono="' + data[i].TELEFONO + '" data-direccion="' + data[i].DIRECCION + '" data-ciudad_residencia="' + data[i].CIUDAD_RESIDENCIA + '" data-fecha_nacimiento="' + data[i].FECHA_NACIMIENTO + '" data-genero="' + data[i].GENERO + '" data-id_rol="' + data[i].ID_ROL + '" data-id_especialidad="' + data[i].ID_ESPECIALIDAD + '" ><i class="fas fa-eye"></i></a>&nbsp' +
						ad +
						'</td>' +
						'</tr>';
				}
			} else {
				toastr.warning(data);
			}
			$('#listUsuarios').html(html);
		}
	});
}



function comboRol() {
	$.ajax({
		type: 'ajax',
		url: 'administracion/comboRol',
		async: false,
		dataType: 'json',
		success: function (data) {
			var html = '';
			if (data != true) {
				for (i = 0; i < data.length; i++) {
					html += '<option value="' + data[i].ID_ROL + '">' + data[i].NOMBRE + '</option>';
				}
			} else {
				toastr.warning(data);
			}
			$('#editid_rol, #showid_rol, #id_Rol').html(html);
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
				for (i = 0; i < data.length; i++) {
					html += '<option value="' + data[i].ID_ESPECIALIDAD + '">' + data[i].NOMBRE + '</option>';
				}
			} else {
				toastr.warning(data);
			}
			$('#editid_especialidad, #showid_especialidad, #id_especialidad').html(html);
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
var $id_roleditprin = $("#editid_rol").val();
var $id_rolshowprin = $("#showid_rol").val();

if ($id_rolshowprin == '2') {
	$("#divShowEspecialidad").show();
} else {
	$('#divShowEspecialidad').hide();
}

if ($id_roleditprin == '2') {
	$("#divEditEspecialidad").show();
} else {
	$('#divEditEspecialidad').hide();
}
function fn_validarRol(deque) {
	if (deque == 'm') {
		var $id_roledit = $("#editid_rol option:selected").val();
		var $id_rolshow = $("#showid_rol option:selected").val();
		if ($id_roledit == '2') {
			$("#divEditEspecialidad").show();
		} else {
			$('#divEditEspecialidad').hide();
		}
		if ($id_rolshow == '2') {
			$("#divShowEspecialidad").show();
		} else {
			$('#divShowEspecialidad').hide();
		}
	}
	if (deque == 'n') {
		var $id_rol = $("#id_Rol option:selected").val();
		if ($id_rol == '2') {
			$('#divEspecialidad').show();
		} else {
			$('#divEspecialidad').hide();
		}
	}

}
//Save
$('#saveUserForm').submit('click', function () {
	var $nombre = $('#nombre').val().trim();
	var $apellido = $('#apellido').val().trim();
	var $tipo_identificacion = $('input[name=tipoIdentificacion]:checked', '#saveUserForm').val();
	var $identificacion = $('#identificacion').val().trim();
	var $nombre_usuario = $('#nombre_usuario').val().trim();
	var $contrasena = $('#contrasena').val().trim();
	var $correo = $('#correo').val().trim();
	var $telefono = $('#telefono').val().trim();
	var $direccion = $('#direccion').val().trim();
	var $ciudad_residencia = $('#ciudad_residencia').val().trim();
	var $fecha_nacimiento = $('#fecha_nacimiento').val().trim();
	var $genero = $('#genero').val().trim();
	var $id_rol = $('#id_Rol').val().trim();
	var $id_especialidad = $('#id_especialidad').val();
	$.ajax({
		type: "POST",
		url: "administracion/saveUsuario",
		dataType: "JSON",
		data: {
			nombre: $nombre,
			apellido: $apellido,
			tipo_identificacion: $tipo_identificacion,
			identificacion: $identificacion,
			nombre_usuario: $nombre_usuario,
			contrasena: $contrasena,
			correo: $correo,
			telefono: $telefono,
			direccion: $direccion,
			ciudad_residencia: $ciudad_residencia,
			fecha_nacimiento: $fecha_nacimiento,
			genero: $genero,
			id_rol: $id_rol,
			id_especialidad: $id_especialidad
		},
		success: function (data) {
			if (data == true) {
				$('#nombre').val(""),
					$('#apellido').val(""),
					$('#tipo_identificacion').val(""),
					$('#identificacion').val(""),
					$('#nombre_usuario').val(""),
					$('#contrasena').val(""),
					$('#correo').val(""),
					$('#telefono').val(""),
					$('#direccion').val(""),
					$('#ciudad_residencia').val(""),
					$('#fecha_nacimiento').val(""),
					$('#genero').val(""),
					$('#id_rol').val(""),
					$('#id_especialidad').val("")

				toastr.success('Datos de usuario guardado.');
				$('#addUserModal').modal('hide');
				window.location.href = $('#baseUrl').val();
				//listUsuarios();
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});

$('#listUsuarios').on('click', '.showUser', function () {
	$('#showUserModal').modal('show');
	$("#showIdUsuario").val($(this).data('id'));
	$("#shownombre").val($(this).data('nombre'));
	$('#showapellido').val($(this).data('apellido'));
	$('#showtipo_identificacion').val($(this).data('tipo_identificacion'));
	$('#showidentificacion').val($(this).data('identificacion'));
	$('#shownombre_usuario').val($(this).data('nombre_usuario'));
	$('#showcontrasena').val("*********");
	$('#showcorreo').val($(this).data('correo'));
	$('#showtelefono').val($(this).data('telefono'));
	$('#showdireccion').val($(this).data('direccion'));
	$('#showciudad_residencia').val($(this).data('ciudad_residencia'));
	$('#showfecha_nacimiento').val($(this).data('fecha_nacimiento'));
	$('#showgenero').val($(this).data('genero'));
	$('#showid_rol').val($(this).data('id_rol'));
	var str = $(this).data('id_especialidad');
	if (str.toString().length == 1) { var substr = str.toString(); } else { var substr = str.split(','); }
	$('#showid_especialidad option').each(function (index) {
		for (var i = 0; i < substr.length; i++) {
			if (substr[i] == $(this).val()) {
				$(this).attr('selected', 'selected');
			}
		}
	});
	fn_validarRol('m');
});


$('#listUsuarios').on('click', '.editUser', function () {
	$('#editUserModal').modal('show');
	$("#editIdUsuario").val($(this).data('id'));
	$("#editnombre").val($(this).data('nombre'));
	$('#editapellido').val($(this).data('apellido'));
	$('#edittipo_identificacion').val($(this).data('tipo_identificacion'));
	$('#editidentificacion').val($(this).data('identificacion'));
	$('#editnombre_usuario').val($(this).data('nombre_usuario'));
	$('#editcontrasena').val("");
	$('#editcorreo').val($(this).data('correo'));
	$('#edittelefono').val($(this).data('telefono'));
	$('#editdireccion').val($(this).data('direccion'));
	$('#editciudad_residencia').val($(this).data('ciudad_residencia'));
	$('#editfecha_nacimiento').val($(this).data('fecha_nacimiento'));
	$('#editgenero').val($(this).data('genero'));
	$('#editid_rol').val($(this).data('id_rol'));
	var str = $(this).data('id_especialidad');
	if (str.toString().length == 1) { var substr = str.toString(); } else { var substr = str.split(','); }
	$('#editid_especialidad option').each(function (index) {
		for (var i = 0; i < substr.length; i++) {
			if (substr[i] == $(this).val()) {
				$(this).attr('selected', 'selected');
			}
		}
	});
	fn_validarRol('m');


});
$('#editUserForm').on('submit', function () {
	if ($("#editcontrasena").val() != "") {
		$.ajax({
			type: "POST",
			url: "administracion/updateUsusario",
			dataType: "JSON",
			data: {
				id: $('#editIdUsuario').val().trim(),
				nombre: $('#editnombre').val().trim(),
				apellido: $('#editapellido').val().trim(),
				tipo_identificacion: $('input[name=edittipo_identificacion]:checked', '#editUserForm').val(),
				identificacion: $('#editidentificacion').val().trim(),
				nombre_usuario: $('#editnombre_usuario').val().trim(),
				contrasena: $('#editcontrasena').val().trim(),
				correo: $('#editcorreo').val().trim(),
				telefono: $('#edittelefono').val().trim(),
				direccion: $('#editdireccion').val().trim(),
				ciudad_residencia: $('#editciudad_residencia').val().trim(),
				fecha_nacimiento: $('#editfecha_nacimiento').val().trim(),
				genero: $('#editgenero').val().trim(),
				id_rol: $('#editid_rol').val().trim(),
				id_especialidad: $('#editid_especialidad').val().trim()
			},
			success: function (data) {
				$('#editnombre').val(""),
					$('#editapellido').val(""),
					$('#edittipo_identificacion').val(""),
					$('#editidentificacion').val(""),
					$('#editnombre_usuario').val(""),
					$('#editcontrasena').val(""),
					$('#editcorreo').val(""),
					$('#edittelefono').val(""),
					$('#editdireccion').val(""),
					$('#editciudad_residencia').val(""),
					$('#editfecha_nacimiento').val(""),
					$('#editgenero').val(""),
					$('#editid_rol').val(""),
					$('#editid_especialidad').val("")

				if (data == true) {
					toastr.success('Datos de usuario actualizado.');
					$('#editUserModal').modal('hide');
					window.location.href = $('#baseUrl').val();
				} else {
					toastr.warning(data);
				}
			}
		});
		return false;
	} else {
		$.ajax({
			type: "POST",
			url: "administracion/updateUsusario",
			dataType: "JSON",
			data: {
				id: $('#editIdUsuario').val().trim(),
				nombre: $('#editnombre').val().trim(),
				apellido: $('#editapellido').val().trim(),
				tipo_identificacion: $('input[name=edittipo_identificacion]:checked', '#editUserForm').val(),
				identificacion: $('#editidentificacion').val().trim(),
				nombre_usuario: $('#editnombre_usuario').val().trim(),
				correo: $('#editcorreo').val().trim(),
				telefono: $('#edittelefono').val().trim(),
				direccion: $('#editdireccion').val().trim(),
				ciudad_residencia: $('#editciudad_residencia').val().trim(),
				fecha_nacimiento: $('#editfecha_nacimiento').val().trim(),
				genero: $('#editgenero').val().trim(),
				id_rol: $('#editid_rol').val().trim(),
				id_especialidad: $('#editid_especialidad').val()
			},
			success: function (data) {
				$('#editnombre').val(""),
					$('#editapellido').val(""),
					$('#edittipo_identificacion').val(""),
					$('#editidentificacion').val(""),
					$('#editnombre_usuario').val(""),
					$('#editcontrasena').val(""),
					$('#editcorreo').val(""),
					$('#edittelefono').val(""),
					$('#editdireccion').val(""),
					$('#editciudad_residencia').val(""),
					$('#editfecha_nacimiento').val(""),
					$('#editgenero').val(""),
					$('#editid_rol').val(""),
					$('#editid_especialidad').val("")
				if (data == true) {
					toastr.success('Datos de usuario actualizado.');
					$('#editUserModal').modal('hide');
					window.location.href = $('#baseUrl').val();
				} else {
					toastr.warning(data);
				}
			}
		});
		return false;
	}
});

//Delete
$('#listUsuarios').on('click', '.deleteUser', function () {
	var userId = $(this).data('id');
	var userNombre = $(this).data('nombre');
	$('#deleteUserModal').modal('show');
	$('#deleteUserId').val(userId);
	$('#deleteUserNombre').text(userNombre);
});
$('#deleteUserForm').on('submit', function () {
	var userId = $('#deleteUserId').val().trim();
	$.ajax({
		type: "POST",
		url: "administracion/deleteUsuario",
		dataType: "JSON",
		data: { id: userId },
		success: function (data) {
			if (data == true) {
				$("#" + userId).remove();
				$('#deleteUserId').val("");
				$('#deleteUserModal').modal('hide');
				listUsuarios();
				toastr.success('Datos de usuario eliminado con exito.');
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});

//horario del medico
$('#listUsuarios').on('click', '.editrel_horario_medico', function () {
	$('#editrel_horario_medicoModal').modal('show');
	$("#IdUsuarioHorario").val($(this).data('id'));
	$("#nombremedico").val($(this).data('nombre'));
	$('#apellidomedico').val($(this).data('apellido')); 
	var str = $(this).data('horario_medico');
	alert(str);
	if (str.toString().length == 1) { var substr = str.toString(); } else { var substr = str.split(','); }
	$('#editrel_horario_medico option').each(function (index) {
		for (var i = 0; i < substr.length; i++) {
			if (substr[i] == $(this).val()) {
				$(this).attr('selected', 'selected');
			}
		}
	});

});

$('#saverel_horario_medicoForm').submit('click', function () {
	var $id_usuario = $('#IdUsuarioHorario').val();
	var $id_horario = $('#editrel_horario_medico').val();
	$.ajax({
		type: "POST",
		url: "administracion/saveHorarioUsuario",
		dataType: "JSON",
		data: {
			id_usuario: $id_usuario,
			id_horario: $id_horario
		},
		success: function (data) {
			if (data == true) {
				$('#IdUsuarioHorario').val(""),
				$('#editrel_horario_medico').val(""),
				
				toastr.success('Datos del horario de médico guardados.');
				$('#editrel_horario_medicoModal').modal('hide');
				window.location.href = $('#baseUrl').val();
				//listUsuarios();
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});