
$(document).ready(function () {
  reloj();
  /*$.ajax({
    type: 'ajax',
    url: '../template/perfil',
    async: false,
    dataType: 'json',
    success: function (data) {
      if (data != true) {
        for (i = 0; i < data.length; i++) {
          var canvas = document.getElementById("fotoPerfil");
          var ctx = canvas.getContext("2d");
          var image = new Image();
          image.onload = function () {
            ctx.drawImage(image, 0, 0);
          };
          image.src = 'data:image/png;base64,' + data[i].USUA_FOTO;

          $("#nombrePerfil").text(data[i].USUA_NOMBRE);
          $("#usuarioPerfil").text(data[i].USUA_NICK);
          $("#mailPerfil").text(data[i].USUA_MAIL);
          $("#rolPerfil").text(data[i].ROL_ID);
          $("#fechaPerfil").text(data[i].USUA_FECHA_REG);
          $("#rolPerfil").text(data[i].ROL_NOMBRE);
          if (data[i].USUA_ESTADO == 1) { $("#estadoPerfil").text("Activo"); } else { $("#estadoPerfil").text("Inactivo"); }
        }
      } else {
        toastr.warning(data);
      }
    }
  });*/
});

function reloj() {
  var udateTime = function () {
    let currentDate = new Date(),
      hours = currentDate.getHours(),
      minutes = currentDate.getMinutes(),
      seconds = currentDate.getSeconds();

    if (minutes < 10) {
      minutes = '0' + minutes
    }

    if (seconds < 10) {
      seconds = '0' + seconds
    }

    document.getElementById('hours').textContent = hours;
    document.getElementById('minutes').textContent = minutes;
    document.getElementById('seconds').textContent = seconds;

  };
  udateTime();
  setInterval(udateTime, 1000);
}