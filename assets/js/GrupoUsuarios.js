$(document).ready(function () {
	//******************************USER**********************************
	listGrupo();
	listGrupoPermisos();
	/*list User  */
	$(document).ready(function () {
		$('#tituloPagina').text("Grupo de Usuarios");
		$('#tableListGrupos').DataTable({
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

//--------------------Rol----------------------
function listGrupo() {
	$.ajax({
		type: 'ajax',
		url: 'administracion/showGrupo',
		async: false,
		dataType: 'json',
		success: function (data) {
			var html = '';
			var su = '';
			var html2 = '<option value="">--Seleccione--</option>';
			var i;
			if (data != true) {
				for (i = 0; i < data.length; i++) {
					if (data[i].ROL_ID != 1 && data[i].ROL_ID != 2 && data[i].ROL_ID != 3) {
						su = '<a title="Eliminar" href="javascript:void(0);" style="color: red;" class="deleteRol" data-id="' + data[i].ROL_ID + '" data-nombre="' + data[i].ROL_NOMBRE + '" ><i class="fas fa-minus-square"></i></a>';
					} else { su = ''; }
					html += '<tr id="' + data[i].ROL_ID + '">' +
						'<td>' + data[i].ROL_NOMBRE + '</td>' +
						'<td>' + data[i].NUM_USUARIOS + '</td>' +
						'<td>' +
						'<a title="Mostrar" href="javascript:void(0);" style="color: green;" class="showRol" data-id="' + data[i].ROL_ID + '" data-nombre="' + data[i].ROL_NOMBRE + '"><i class="fas fa-eye"></i></a>&nbsp' +
						'<a title="Editar" href="javascript:void(0);" class="editRol" data-id="' + data[i].ROL_ID + '" data-nombre="' + data[i].ROL_NOMBRE + '" ><i class="fas fa-edit"></i></a>&nbsp' +
						su +
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

				toastr.success('Grupo de usuarios actualizado.');
				$('#editGrupoModal').modal('hide');
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
				listGrupo();
				toastr.success('Grupo de usuarios eliminado con exito.');
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
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
