
//Funcion para radio button de Reservar

function mostrarDatos(dato){
        if(dato==="Soloida"){
            document.getElementById("boton_buscarSalida").style.display = "block";
            document.getElementById("boton_buscarLlegada").style.display = "none";
            document.getElementById("numero_pasajeros").style.display = "block";
            document.getElementById("fecha_salida").style.display = "block";
            document.getElementById("fecha_llegada").style.display = "none";
            document.getElementById("boton_buscarvuelo").style.display = "block";
    }
        if(dato==="IdaVuelta"){
            document.getElementById("boton_buscarSalida").style.display = "block";
            document.getElementById("boton_buscarLlegada").style.display = "block";
            document.getElementById("numero_pasajeros").style.display = "block";
            document.getElementById("fecha_salida").style.display = "block";
            document.getElementById("fecha_llegada").style.display = "block";
            document.getElementById("boton_buscarvuelo").style.display = "block";
        }
    }
    
    
    