$(document).ready(function () {

	function limpiarNumero(obj) {
		obj.value = obj.value.replace(/\D/g, '');
	}
});

$('#registro_nuevo_paciente').submit('click', function () {
	var nombre = $('#nombre').val().trim();
	var apellido = $('#apellido').val().trim();
	var identificacion = $('#identificacion').val().trim();
	var nombre_usuario = $('#nombre_usuario').val().trim();
	var contrasena = $('#contrasena').val().trim();
	var correo = $('#correo').val().trim();
	var telefono = $('#telefono').val().trim();
	var direccion = $('#direccion').val().trim();
	var ciudad_residencia = $('#ciudad_residencia').val();
	var fecha_nacimiento = $('#fecha_nacimiento').val().trim();
	var genero = $('#genero').val();
	var tipo_identificacion = $('input[name=tipoIdentificacion]:checked', '#registro_nuevo_paciente').val();

	alert(tipo_identificacion);

	$.ajax({
		type: "POST",
		url: "registro/registro_nuevo_paciente",
		dataType: "JSON",
		data: {
			nombre: nombre,
			apellido: apellido,
			identificacion: identificacion,
			nombre_usuario: nombre_usuario,
			contrasena: contrasena,
			correo: correo,
			telefono: telefono,
			direccion: direccion,
			ciudad_residencia: ciudad_residencia,
			fecha_nacimiento: fecha_nacimiento,
			genero: genero,
			tipo_identificacion: tipo_identificacion,
		},
		success: function (data) {
			if (data == true) {
				$("#nombre").val("");
				$('#apellido').val("");
				$('#identificacion').val("");
				$('#nombre_usuario').val("");
				$('#contrasena').val("");
				$('#correo').val("");
				$('#telefono').val("");
				$('#direccion').val("");
				$('#fecha_nacimiento').val("");

				toastr.success('Datos de paciente guardado.');
			} else {
				toastr.warning(data);
			}
		}
	});
	return false;
});
