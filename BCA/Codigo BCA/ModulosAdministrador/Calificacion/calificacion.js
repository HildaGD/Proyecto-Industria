$(function(){
	$('#id-alumno').on('change', function(){
		var alumno = $('#id-alumno').val();
		//var zona = $('#combobox').val();
		var url = '../../ModulosAdministrador/reportes/calificacionExcel.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'alumno='+alumno,
	});
	return false;
	});
	
	/*$('#combobox').on('change', function(){
		var desde = $('#bd-desde').val();
		var zona = $('#combobox').val();
		var url = '../reportes/reporte_diario.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'desde='+desde+'&zona='+zona,
	});
	return false;
    });*/
    
});    	

    function reporteCalificacion(){
		var alumno = $('#id-alumno').val();
		//var zona = $('#combobox').val();
        window.open('../../ModulosAdministrador/reportes/calificacionExcel.php?alumnos='+alumno);
    }
	
