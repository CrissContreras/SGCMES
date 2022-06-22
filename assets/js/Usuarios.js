$(document).ready(function () {
	listUsuarios();
	
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
						ad = '<a title="Editar" href="javascript:void(0);"  class="editUser" data-id="' + data[i].USUA_ID + '" data-foto="' + data[i].USUA_FOTO + '" data-nombre="' + data[i].USUA_NOMBRE + '" data-nick="' + data[i].USUA_NICK + '" data-mail="' + data[i].USUA_MAIL + '" data-estado="' + data[i].USUA_ESTADO + '" data-rol="' + data[i].ROL_ID + '" disabled><i class="fas fa-edit"></i></a>&nbsp' +
						'<a title="Editar" href="javascript:void(0);"  class="editUser" data-id="' + data[i].USUA_ID + '" data-foto="' + data[i].USUA_FOTO + '" data-nombre="' + data[i].USUA_NOMBRE + '" data-nick="' + data[i].USUA_NICK + '" data-mail="' + data[i].USUA_MAIL + '" data-estado="' + data[i].USUA_ESTADO + '" data-rol="' + data[i].ROL_ID + '" disabled><i class="fas fa-edit"></i></a>&nbsp';
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

//Save
$('#saveUserForm').submit('click', function () {
	var nombre = $('#nombreUsuario').val().trim();
	var nick = $('#nickUsuario').val().trim();
	var mail = $('#mailUsuario').val().trim();
	var estado = $('#estadoUsuario').val().trim();
	var rol = $('#rolUsuario').val().trim();
	var pass = $('#passUsuario').val().trim();
	var userimg64 = (document.getElementById("imgfoto").toDataURL()).replace(/^data:image\/(png|jpg|jpeg);base64,/, "");

	$.ajax({
		type: "POST",
		url: "administracion/saveUsuario",
		dataType: "JSON",
		data: {
			nombre: nombre,
			nick: nick,
			mail: mail,
			estado: estado,
			rol: rol,
			pass: pass,
			foto: userimg64
		},
		success: function (data) {
			if (data == true) {
				$("#nombreUsuario").val("");
				$('#nickUsuario').val("");
				$('#mailUsuario').val("");
				$('#estadoUsuario').val("");
				$('#rolUsuario').val("");
				$('#passUsuario').val("");
				$('#fotoUsuario').val("");

				toastr.success('Datos de usuario guardado.');
				$('#addUserModal').modal('hide');
				listUsuarios();
				listGrupo();
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
	$("#showimgfoto").attr('src', 'data:image/png;base64,' + $(this).data('foto'));
	$("#shownombreUsuario").val($(this).data('nombre'));
	$("#shownickUsuario").val($(this).data('nick'));
	$("#showmailUsuario").val($(this).data('mail'));
	$("#showrolUsuario").val($(this).data('rol'));
	$("#showestadoUsuario").val($(this).data('estado'));
	$("#showpassUsuario").val("**********");

});
$('#listUsuarios').on('click', '.editUser', function () {
	$('#editUserModal').modal('show');

	var canvas = document.getElementById("editimgfoto");
	var ctx = canvas.getContext("2d");
	var image = new Image();
	image.onload = function () {
		ctx.drawImage(image, 0, 0);
	};
	image.src = 'data:image/png;base64,' + $(this).data('foto');

	$("#editIdUsuario").val($(this).data('id'));
	$("#editnombreUsuario").val($(this).data('nombre'));
	$("#editnickUsuario").val($(this).data('nick'));
	$("#editmailUsuario").val($(this).data('mail'));
	$("#editrolUsuario").val($(this).data('rol'));
	$("#editestadoUsuario").val($(this).data('estado'));
	$("#editpassUsuario").val("");

});
$('#editUserForm').on('submit', function () {

	var foto = (document.getElementById("editimgfoto").toDataURL()).replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
	var id = $("#editIdUsuario").val().trim();
	var nombre = $("#editnombreUsuario").val().trim();
	var nick = $("#editnickUsuario").val().trim();
	var mail = $("#editmailUsuario").val().trim();
	var rol = $("#editrolUsuario").val().trim();
	var estado = $("#editestadoUsuario").val().trim();
	var pass = $("#editpassUsuario").val().trim();

	if ($("#editpassUsuario").val() != "") {
		$.ajax({
			type: "POST",
			url: "administracion/updateUsusario",
			dataType: "JSON",
			data: {
				id: id,
				nombre: nombre,
				nick: nick,
				mail: mail,
				estado: estado,
				rol: rol,
				pass: pass,
				foto: foto
			},
			success: function (data) {
				$("#nombreUsuario").val("");
				$('#nickUsuario').val("");
				$('#mailUsuario').val("");
				$('#estadoUsuario').val("");
				$('#rolUsuario').val("");
				$('#passUsuario').val("");
				$('#fotoUsuario').val("");
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
				id: id,
				nombre: nombre,
				nick: nick,
				mail: mail,
				estado: estado,
				rol: rol,
				foto: foto
			},
			success: function (data) {
				$("#nombreUsuario").val("");
				$('#nickUsuario').val("");
				$('#mailUsuario').val("");
				$('#estadoUsuario').val("");
				$('#rolUsuario').val("");
				$('#passUsuario').val("");
				$('#fotoUsuario').val("");
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

function listGrupoPermisos() {
	$.ajax({
		type: 'ajax',
		url: 'administracion/showGrupoPermisos',
		async: false,
		dataType: 'json',
		success: function (data) {
			var html = '';
			if (data != true) {
				for (i = 0; i < data.length; i++) {
					html += '<tr>' +
						'<td class="text-left">' + data[i].URL_NOMBRE + '</td>' +
						'<td><input type="checkbox" value="' + data[i].URL_ID + '" class="chck1"></td>' +
						'</tr>';
				}
				html += '<tr>' +
					'<td class="text-left">TODOS</td>' +
					'<td><input type="checkbox" value="1" id="chckVall" class="chck1"></td>' +
					'</tr>';
			} else {
				toastr.warning(data);
			}
			$('#listGrupoPermiso').html(html);
			//$('#listGrupoPermisoEdit').html(html);
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