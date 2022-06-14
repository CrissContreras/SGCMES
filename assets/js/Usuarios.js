$(document).ready(function () {
	//******************************USER**********************************
	listGrupo();
	listUsuarios();
	listGrupoPermisos();
	/*list User  */
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
function cargarFoto(srcUrl) {
	var imgCargar = new Image();
	imgCargar.src = 'data:image/png;base64,' + srcUrl;
	var c = document.getElementById("imgfoto");
	var ctx = c.getContext("2d");
	imgCargar.onload = function () {
		ctx.drawImage(imgCargar, 0, 0, 210, 170);
	}
};
//-----------Usuario----------------
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
			if (data != true) {
				for (i = 0; i < data.length; i++) {
					if (data[i].USUA_ESTADO == 1) {
						st = '<td><span class="badge badge-pill badge-success"><strong>Activo</strong></span></td>'
					} else {
						st = '<td><span class="badge badge-pill badge-danger"><strong>Inactivo</strong></span></td>'
					}
					html += '<tr id="' + data[i].ROL_ID + '">' +
						'<td><img onerror="imgError(this);" src="data:image/png;base64,' + data[i].USUA_FOTO + '" style="width: 40px; height: 36px;" alt="Foto"/></td>' +
						'<td>' + data[i].USUA_NOMBRE + '</td>' +
						'<td>' + data[i].USUA_NICK + '</td>' +
						'<td>' + data[i].USUA_MAIL + '</td>' +
						'<td>' + data[i].ROL_NOMBRE + '</td>' +
						'<td>' + data[i].USUA_FECHA_REG + '</td>' +
						st +
						'<td>' +
						'<a title="Mostrar" href="javascript:void(0);" style="color: green;" class="showUser" data-foto="' + data[i].USUA_FOTO + '" data-nombre="' + data[i].USUA_NOMBRE + '" data-nick="' + data[i].USUA_NICK + '" data-mail="' + data[i].USUA_MAIL + '" data-estado="' + data[i].USUA_ESTADO + '" data-rol="' + data[i].ROL_ID + '"><i class="fas fa-eye"></i></a>&nbsp' +
						'<a title="Editar" href="javascript:void(0);"  class="editUser" data-id="' + data[i].USUA_ID + '" data-foto="' + data[i].USUA_FOTO + '" data-nombre="' + data[i].USUA_NOMBRE + '" data-nick="' + data[i].USUA_NICK + '" data-mail="' + data[i].USUA_MAIL + '" data-estado="' + data[i].USUA_ESTADO + '" data-rol="' + data[i].ROL_ID + '"><i class="fas fa-edit"></i></a>&nbsp' +
						'<a title="Eliminar" href="javascript:void(0);" style="color: red;" class="deleteUser" data-id="' + data[i].USUA_ID + '" data-nombre="' + data[i].USUA_NOMBRE + '" ><i class="fas fa-minus-square"></i></a>' +
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
/*save*/
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

/*show edit*/
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

/*Edit*/
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

// show delete user
$('#listUsuarios').on('click', '.deleteUser', function () {
	var userId = $(this).data('id');
	var userNombre = $(this).data('nombre');
	$('#deleteUserModal').modal('show');
	$('#deleteUserId').val(userId);
	$('#deleteUserNombre').text(userNombre);
});
// delete user 
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
function generarNick() {
	var nombre = (($('#nombreUsuario').val()).trim()).toLowerCase();
	var nick = document.getElementById('nickUsuario');
	var nuevoNombre = '';

	for (i = 0; i < nombre.length; i++) {
		if (nombre.charAt(i) == ' ') {
			nuevoNombre += nombre.charAt(i + 1);
			i = nombre.length;
		}
		nuevoNombre += nombre.charAt(i);
	}

	nick.value = "1" + nuevoNombre;
}

$(function () {
	$('#editfotoUsuario').change(function (e) {
		addImage(e);
	});

	function addImage(e) {
		var file = e.target.files[0],
			imageType = /image.jpe/;

		if (!file.type.match(imageType))
			return;

		var reader = new FileReader();
		reader.onload = fileOnload;
		reader.readAsDataURL(file);
	}

	function fileOnload(e) {
		var result = e.target.result;
		$('#editimgfoto').attr("src", result);
	}
});

function cargarImgDefault() {
	var image = new Image();
	image.src = window.location.protocol + "//" + window.location.host + "/assets/images/0.jpg";
	image.onload = function (ev) {
		var canvas = document.getElementById('imgfoto');
		var ctx = canvas.getContext('2d');
		ctx.drawImage(image, 0, 0, 210, 170);
	}
	//alert(imgCargar.src);
}

let fileInput = document.getElementById('fotoUsuario');
fileInput.addEventListener('change', function (ev) {
	if (ev.target.files) {
		let file = ev.target.files[0];
		var reader = new FileReader();
		reader.readAsDataURL(file);
		reader.onloadend = function (e) {
			var image = new Image();
			image.src = e.target.result;
			image.onload = function (ev) {
				var canvas = document.getElementById('imgfoto');
				var ctx = canvas.getContext('2d');
				ctx.drawImage(image, 0, 0, 210, 170);
			}
		}
	}
});

let fileInput2 = document.getElementById('editfotoUsuario');
fileInput2.addEventListener('change', function (ev) {
	if (ev.target.files) {
		let file = ev.target.files[0];
		var reader = new FileReader();
		reader.readAsDataURL(file);
		reader.onloadend = function (e) {
			var image = new Image();
			image.src = e.target.result;
			image.onload = function (ev) {
				var canvas = document.getElementById('editimgfoto');
				var ctx = canvas.getContext('2d');
				ctx.drawImage(image, 0, 0, 210, 170);
			}
		}
	}
});

$(function () {

	$(document).on('change', ':file', function () {
		var input = $(this),
			numFiles = input.get(0).files ? input.get(0).files.length : 1,
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [numFiles, label]);

	});

	$(document).ready(function () {
		$(':file').on('fileselect', function (event, numFiles, label) {

			var input = $(this).parents('.input-group').find(':text'),
				log = numFiles > 1 ? numFiles + ' archivos' : label;

			if (input.length) {
				input.val(log);
			} else {
				if (log)
					toastr.warning(log);
			}

		});
	});

});
$(document).ready(
	function checked_all() {
		$('#chckVall').change(function () {
			var checkboxes = $(".chck1");
			if ($(this).is(':checked')) {
				checkboxes.prop('checked', true);
			} else {
				checkboxes.prop('checked', false);
			}
		});
	});
