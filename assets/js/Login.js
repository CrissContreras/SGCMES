$(document).ready(function () {
    var es_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
    var es_firefox = navigator.userAgent.toLowerCase().indexOf('firefox') > -1;

    if(es_chrome == false && es_firefox == false){
        alert('La aplicación no funciona en este navegador.');
        window.open('', '_self', ''); window.close();
    }


});