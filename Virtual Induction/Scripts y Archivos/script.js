
function cambioImagen() {
	var id = document.getElementById("ids").innerHTML;
	var responseString;
	var	imgsrc;
	if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                responseString = this.responseText;
				document.getElementById("FechaInicio").value = dateSQLtoJS(GetDataValue(responseString,"fecha_inicio:"));
				document.getElementById("FechaFin").value = dateSQLtoJS(GetDataValue(responseString,"fecha_fin:"));
				document.getElementById("NombreActividad").value = GetDataValue(responseString,"nombre_actividad:");
				document.getElementById("Lugar").value = GetDataValue(responseString,"lugar:");
				document.getElementById("LinkMp3").value = GetDataValue(responseString,"link_mp3:");
				document.getElementById("LinkMapa").value = GetDataValue(responseString,"link_mapa:");
				imgsrc = GetDataValue(responseString,"link_imgActividad:");
				imgsrc = imgsrc.substring(0,imgsrc.length-1);
				document.getElementById("imgScan").src = imgsrc;
				
            }
        };
        xmlhttp.open("GET","SQLphp/ItemsData.php?actividad="+id,true);
        xmlhttp.send();
}

function getActividades() {
	var responseString;
	var	imgsrc;
	var j;
	if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                responseString = this.responseText;
				var actividades = responseString.split(";");
				for (i = 0; i < actividades.length-1; i++){
					j=i+1;
					document.getElementById("actividad"+j).innerHTML = "Actividad "+j+": "+actividades[i];
				}
            }
        }
        xmlhttp.open("GET","SQLphp/nombre_actividades.php",true);
        xmlhttp.send();
}

function Guardar() {
	var id = document.getElementById("ids").innerHTML;
	var responseString;
	if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                responseString = this.responseText;
				window.location.replace("http://estudiantes.is.escuelaing.edu.co/~2092964/actividad.php?actividad="+id);
            }
        };
		
		var fecha_inicio = document.getElementById("FechaInicio").value;
		var fecha_fin= document.getElementById("FechaFin").value;
		var nombre_actividad = document.getElementById("NombreActividad").value;
		var lugar = document.getElementById("Lugar").value;
		var linkmp3 = document.getElementById("LinkMp3").value;
		var linkmapa = document.getElementById("LinkMapa").value;
		
        xmlhttp.open("GET","SQLphp/Update.php?actividad="+id+"&fechainicio="+fecha_inicio+"&fechafin="+fecha_fin+"&lugar="+lugar+"&nombreactividad="+nombre_actividad+"&linkmp3="+linkmp3+"&linkmapa="+linkmapa,true);
		xmlhttp.send();
		alert("Se ha modificado exitosamente la imagen " + id);
		
}

function Salir() {
	var responseString;
	if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                responseString = this.responseText;
				location.reload();
            }
        };
        xmlhttp.open("GET","SQLphp/logout.php",true);
		xmlhttp.send();
}

function imgVecina(caracter){
	
	var numImg = parseInt(document.getElementById("ids").innerHTML);
	
	if(caracter == '+'){
		numImg=numImg+1;
	}
	else{
		numImg=numImg-1;
	}
	
	window.location.replace("http://estudiantes.is.escuelaing.edu.co/~2092964/actividad.php?actividad="+numImg);
	
	
}

function GetDataValue(str,index){
	var valor = str.substring(str.indexOf(index)+index.length);
    if(valor.includes("|")) valor = valor.substring(0,valor.indexOf("|"));
	return valor;
}

function dateJStoSQL(date){
	var items = date.split("T");
	date = items[0] + " " + items[1] + ":00";
	return date;
}

function dateSQLtoJS(date){
	var items = date.split(" ");
	date = items[0] + "T" + items[1].substring(0,5);
	return date;
}
