$(document).ready(function () {
	listUsuarios();
	comboRol();
	$(document).ready(function () {
		$('#tituloPagina').text("Usuarios");

		$('#tableListUsuarios, #tableListGrupos').DataTable({
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
					if (data[i].ESTADO == 'A') {
						st = '<td><span class="badge badge-pill badge-success"><strong>Activo</strong></span></td>'
					} else {
						st = '<td><span class="badge badge-pill badge-danger"><strong>Inactivo</strong></span></td>'
					}
					if (data[i].ID_USUARIO != 1) {
						ad = '<a title="Editar" href="javascript:void(0);"  class="editUser" data-id="' + data[i].ID_USUARIO + '" data-nombre="' + data[i].NOMBRE + '" data-apellido="' + data[i].APELLIDO + '" data-tipo_identificacion="' + data[i].TIPO_IDENTIFICACION + '" data-identificacion="' + data[i].IDENTIFICACION + '" data-nombre_usuario="' + data[i].NOMBRE_USUARIO + '" data-correo="' + data[i].CORREO + '" data-telefono="' + data[i].TELEFONO + '" data-direccion="' + data[i].DIRECCION + '" data-ciudad_residencia="' + data[i].CIUDAD_RESIDENCIA + '" data-fecha_nacimiento="' + data[i].FECHA_NACIMIENTO + '" data-genero="' + data[i].GENERO + '" data-id_rol="' + data[i].ID_ROL + '" ><i class="fas fa-edit"></i></a>&nbsp' +
							'<a title="Eliminar" href="javascript:void(0);" style="color: red;" class="deleteUser" data-id="' + data[i].USUA_ID + '" data-nombre="' + data[i].USUA_NOMBRE + '" ><i class="fas fa-minus-square"></i></a>';
					}
					html += '<tr>' +
						'<td>' + data[i].ID_USUARIO + '</td>' +
						'<td>' + data[i].NOMBRE + '</td>' +
						'<td>' + data[i].APELLIDO + '</td>' +
						'<td>' + data[i].IDENTIFICACION + '</td>' +
						'<td>' + data[i].NOMBRE_USUARIO + '</td>' +
						'<td>' + data[i].CORREO + '</td>' +
						'<td>' + data[i].ID_ROL + '</td>' +
						st +
						'<td>' +
						'<a title="Mostrar" href="javascript:void(0);" style="color: green;" class="showUser" data-foto="' + data[i].USUA_FOTO + '" data-nombre="' + data[i].USUA_NOMBRE + '" data-nick="' + data[i].USUA_NICK + '" data-mail="' + data[i].USUA_MAIL + '" data-estado="' + data[i].USUA_ESTADO + '" data-rol="' + data[i].ROL_ID + '"><i class="fas fa-eye"></i></a>&nbsp' +
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
			$('#editid_rol, #id_Rol').html(html);
		}
	});
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
			id_rol: $id_rol			
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
					$('#id_rol').val("")

				toastr.success('Datos de usuario guardado.');
				$('#addUserModal').modal('hide');
				//listUsuarios();
				//listGrupo();
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});

//Edit
$('#listUsuarios').on('click', '.showUser', function () {
	$('#showUserModal').modal('show');

});
$('#listUsuarios').on('click', '.editUser', function () {
	$('#editUserModal').modal('show');

	$("#editIdUsuario").val($(this).data('id'));
	$("#editnombre").val($(this).data('nombre'));
	$('#editapellido').val($(this).data('apellido')),
		$('#edittipo_identificacion').val($(this).data('tipo_identificacion')),
		$('#editidentificacion').val($(this).data('identificacion')),
		$('#editnombre_usuario').val($(this).data('nombre_usuario')),
		$('#editcontrasena').val(""),
		$('#editcorreo').val($(this).data('correo')),
		$('#edittelefono').val($(this).data('telefono')),
		$('#editdireccion').val($(this).data('direccion')),
		$('#editciudad_residencia').val($(this).data('ciudad_residencia')),
		$('#editfecha_nacimiento').val($(this).data('fecha_nacimiento')),
		$('#editgenero').val($(this).data('genero')),
		$('#editid_rol').val($(this).data('id_rol'))


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
				tipo_identificacion:  $('input[name=edittipo_identificacion]:checked', '#editUserForm').val(),
				identificacion: $('#editidentificacion').val().trim(),
				nombre_usuario: $('#editnombre_usuario').val().trim(),
				contrasena: $('#editcontrasena').val().trim(),
				correo: $('#editcorreo').val().trim(),
				telefono: $('#edittelefono').val().trim(),
				direccion: $('#editdireccion').val().trim(),
				ciudad_residencia: $('#editciudad_residencia').val().trim(),
				fecha_nacimiento: $('#editfecha_nacimiento').val().trim(),
				genero: $('#editgenero').val().trim(),
				id_rol: $('#editid_rol').val().trim()
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
					$('#editid_rol').val("")

				if (data == true) {
					toastr.success('Datos de usuario actualizado.');
					$('#editUserModal').modal('hide');
					listUsuarios();
					listGrupo();
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
				tipo_identificacion: $('#edittipo_identificacion').val().trim(),
				identificacion: $('#editidentificacion').val().trim(),
				nombre_usuario: $('#editnombre_usuario').val().trim(),
				correo: $('#editcorreo').val().trim(),
				telefono: $('#edittelefono').val().trim(),
				direccion: $('#editdireccion').val().trim(),
				ciudad_residencia: $('#editciudad_residencia').val().trim(),
				fecha_nacimiento: $('#editfecha_nacimiento').val().trim(),
				genero: $('#editgenero').val().trim(),
				id_rol: $('#editid_rol').val().trim()
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
					$('#editid_rol').val("")
				if (data == true) {
					toastr.success('Datos de usuario actualizado.');
					$('#editUserModal').modal('hide');
					listUsuarios();
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
				listGrupo();
				toastr.success('Datos de usuario eliminado con exito.');
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});

//--------------------Rol----------------------
function listGrupo() {
	$.ajax({
		type: 'ajax',
		url: 'administracion/showGrupo',
		async: false,
		dataType: 'json',
		success: function (data) {
			var html = '';
			var html2 = '<option value="">-Seleccione Rol-</option>';
			var i;
			if (data != true) {
				for (i = 0; i < data.length; i++) {
					html += '<tr id="' + data[i].ROL_ID + '">' +
						'<td>' + data[i].ROL_NOMBRE + '</td>' +
						'<td>' + data[i].NUM_USUARIOS + '</td>' +
						'<td>' +
						'<a title="Mostrar" href="javascript:void(0);" style="color: green;" class="showRol" data-id="' + data[i].ROL_ID + '" data-nombre="' + data[i].ROL_NOMBRE + '"><i class="fas fa-eye"></i></a>&nbsp' +
						'<a title="Editar" href="javascript:void(0);" class="editRol" data-id="' + data[i].ROL_ID + '" data-nombre="' + data[i].ROL_NOMBRE + '" ><i class="fas fa-edit"></i></a>&nbsp' +
						'<a title="Eliminar" href="javascript:void(0);" style="color: red;" class="deleteRol" data-id="' + data[i].ROL_ID + '" data-nombre="' + data[i].ROL_NOMBRE + '" ><i class="fas fa-minus-square"></i></a>' +
						'</td>' +
						'</tr>';

					html2 += '<option value="' + data[i].ROL_ID + '">' + data[i].ROL_NOMBRE + '</option>';

				}
			} else {
				toastr.warning(data);
			}
			$('#rolUsuario, #showrolUsuario, #editrolUsuario').html(html2);
			$('#listGrupo').html(html);
		}
	});
}


/*save*/
$('#saveGrupoForm').submit('click', function () {
	var filas = $("#listGrupoPermiso").find("tr");
	var urls = "";

	for (i = 0; i < filas.length; i++) {
		if (i + 1 != filas.length) {
			var celdas = $(filas[i]).find("td");
			permisoChk = $($(celdas[1]).children("input")[0]).prop('checked');
			linkId = $($(celdas[1]).children("input")[0]).val();
			if (permisoChk == true) {
				urls += linkId + ",";
			}
		}
	}

	var nombre = $('#nombreRol').val().trim();
	$.ajax({
		type: "POST",
		url: "administracion/saveGrupoPermisos",
		dataType: "JSON",
		data: {
			nombre: nombre,
			urls: urls
		},
		success: function (data) {
			if (data == true) {
				$("#nombreRol").val("");

				toastr.success('Datos de rol guardado.');
				$('#addGrupoModal').modal('hide');
				listUsuarios();
				listGrupo();
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});

/*show*/
$('#listGrupo').on('click', '.showRol', function () {
	$('#showGrupoModal').modal('show');
	$("#nombreRolShow").val($(this).data('nombre'));

	var id = $(this).data('id');

	$.ajax({
		type: 'POST',
		url: 'administracion/showGrupoPermisosShow',
		async: false,
		dataType: 'json',
		data: {
			id: id
		},
		success: function (data) {
			var html = '';
			if (data != true) {
				for (i = 0; i < data.length; i++) {
					if (data[i].URL_ACT == 0) {
						act = '<td><input type="checkbox" value="' + data[i].URL_ID + '" class="chck1" disabled></td>'
					} else { act = '<td><input type="checkbox" value="' + data[i].URL_ID + '" class="chck1" checked disabled></td>' }
					html += '<tr>' +
						'<td class="text-left">' + data[i].URL_NOMBRE + '</td>' +
						act +
						'</tr>';

				}
			} else {
				toastr.warning(data);
			}
			$('#listGrupoPermisoShow').html(html);
		}
	});

});

/*edit*/
$('#listGrupo').on('click', '.editRol', function () {
	$('#editGrupoModal').modal('show');
	$("#nombreRolEdit").val($(this).data('nombre'));
	$("#editRolId").val($(this).data('id'));

	var id = $(this).data('id');

	$.ajax({
		type: 'POST',
		url: 'administracion/showGrupoPermisosShow',
		async: false,
		dataType: 'json',
		data: {
			id: id
		},
		success: function (data) {
			var html = '';
			if (data != true) {
				for (i = 0; i < data.length; i++) {
					if (data[i].URL_ACT == 0) {
						act = '<td><input type="checkbox" value="' + data[i].URL_ID + '" class="chck1" ></td>'
					} else { act = '<td><input type="checkbox" value="' + data[i].URL_ID + '" class="chck1" checked ></td>' }
					html += '<tr>' +
						'<td class="text-left">' + data[i].URL_NOMBRE + '</td>' +
						act +
						'</tr>';
				}
			} else {
				toastr.warning(data);
			}
			$('#listGrupoPermisoEdit').html(html);
		}
	});

});
$('#editGrupoForm').submit('click', function () {
	var filas = $("#listGrupoPermisoEdit").find("tr");
	var urls = "";

	for (i = 0; i < filas.length; i++) {
		var celdas = $(filas[i]).find("td");
		permisoChk = $($(celdas[1]).children("input")[0]).prop('checked');
		linkId = $($(celdas[1]).children("input")[0]).val();
		if (permisoChk == true) {
			urls += linkId + ",";
		}
	}

	var nombre = $('#nombreRolEdit').val().trim();
	var id = $('#editRolId').val();

	$.ajax({
		type: "POST",
		url: "administracion/editGrupoPermisos",
		dataType: "JSON",
		data: {
			nombre: nombre,
			id: id,
			urls: urls
		},
		success: function (data) {
			if (data == true) {
				$("#nombreRolEdit").val("");

				toastr.success('Datos de rol actualizado.');
				$('#editGrupoModal').modal('hide');
				listUsuarios();
				listGrupo();
				listMenu();
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});
// show delete rol
$('#listGrupo').on('click', '.deleteRol', function () {
	$('#deleteRolModal').modal('show');
	$('#deleteRolId').val($(this).data('id'));
	$('#deleteRolNombre').text($(this).data('nombre'));
});
// delete rol 
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
				$('#deleteRolNombre').val("");
				$('#deleteRolModal').modal('hide');
				listUsuarios();
				listGrupo();
				toastr.success('Datos de rol eliminado con exito.');
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});

//OPCION