// Crear elemento de video
const video = document.createElement("video");

// Obtener el canvas donde se mostrará el QR
const canvasElement = document.getElementById("qr-canvas");
const canvas = canvasElement.getContext("2d");

// Div donde llegará nuestro canvas
const btnScanQR = document.getElementById("btn-scan-qr");

// Lectura desactivada
let scanning = false;

const mostrarMensajeError = (mensaje, error = null) => {
  console.error(mensaje, error);
  // Usar un sistema de notificaciones más moderno
  // Por ejemplo, toastify o sweet alert
  Swal.fire({
    icon: 'error',
    title: 'Error',
    text: mensaje
  });
};

// Función para encender la cámara
const encenderCamara = (tipoDeCamara = "environment") => {
  // Verificamos si el navegador soporta acceso a la cámara
  if (navigator.mediaDevices && navigator.mediaDevices.enumerateDevices) {
    navigator.mediaDevices.enumerateDevices()
      .then(devices => {
        // Filtramos los dispositivos de video
        const videoDevices = devices.filter(device => device.kind === "videoinput");

        // Si no se encuentran cámaras, mostramos un mensaje
        if (videoDevices.length === 0) {
          mostrarMensajeError("No se encontraron cámaras disponibles.");
          return;
        }

        // Buscamos la cámara deseada: puede ser 'user' para frontal o 'environment' para trasera
        const selectedDevice = videoDevices.find(device => device.facingMode === tipoDeCamara) || videoDevices[0]; // Si no se encuentra, usamos la primera cámara

        // Llamamos a la función para acceder a la cámara seleccionada
        iniciarStream(selectedDevice.deviceId);
      })
      .catch(error => {
        console.error("Error enumerando los dispositivos", error);
        mostrarMensajeError("Hubo un error al intentar obtener los dispositivos de la cámara.");
      });
  } else {
    console.error("El navegador no soporta el acceso a la cámara.");
    alert("Tu navegador no soporta el acceso a la cámara.");
  }
};

// Iniciar el stream de la cámara
const iniciarStream = (deviceId) => {
  if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({
      video: { deviceId: { exact: deviceId } } // Usamos el deviceId seleccionado
    })
      .then(function (stream) {
        scanning = true;
        btnScanQR.hidden = true;
        canvasElement.hidden = false;
        video.setAttribute("playsinline", true); // Requerido para iOS Safari
        video.srcObject = stream;
        video.play();
        tick();
        scan();
      })
      .catch(function (error) {
        console.error("Error accediendo al dispositivo de medios.", error);
        alert("No se pudo acceder a la cámara seleccionada. Asegúrate de que has permitido el acceso.");
      });
  } else {
    console.error("getUserMedia no es compatible con este navegador.");
    alert("Tu navegador no soporta el acceso a la cámara.");
  }
};

// Función para actualizar el canvas con la imagen del video
function tick() {
  if (video.readyState === video.HAVE_ENOUGH_DATA) {
    canvasElement.height = video.videoHeight;
    canvasElement.width = video.videoWidth;
    canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
  }

  if (scanning) {
    requestAnimationFrame(tick); // Continuamos el ciclo de actualización
  }
}

// Función para escanear el código QR
function scan() {
  try {
    qrcode.decode(); // Intentamos decodificar el código QR
  } catch (e) {
    setTimeout(scan, 300); // Intentamos de nuevo después de un breve retraso
  }
}

// Apagar la cámara y detener el stream
const cerrarCamara = () => {
  video.srcObject.getTracks().forEach((track) => {
    track.stop(); // Detenemos cada track del stream de la cámara
  });
  canvasElement.hidden = true; // Ocultamos el canvas
  btnScanQR.hidden = false; // Mostramos el botón de escaneo nuevamente
};

// Activar sonido cuando se escanea el código QR
const activarSonido = () => {
  const audio = document.getElementById('audioScaner');
  if (audio) {
    audio.play();
  }
}

// Función para extraer los últimos 9 caracteres
const obtenerUltimos9Caracteres = (texto) => {
  return texto.slice(-9);
};

// Modificamos el callback del QR
qrcode.callback = (respuesta) => {
  if (respuesta) {
    const ultimos9 = obtenerUltimos9Caracteres(respuesta);
    
    // Mostrar notificación con los últimos 9 caracteres
    Swal.fire({
      title: 'Código QR escaneado',
      text: `Últimos 9 caracteres: ${ultimos9}`,
      icon: 'success'
    });
    
    show(respuesta); // Mantiene la función original por si la necesitas
    activarSonido();
    cerrarCamara();
  }
};

// Evento para mostrar la cámara al cargar la página
window.addEventListener('load', () => {
  if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    // Acceso a la cámara permitido
    encenderCamara("environment"); // Para la cámara trasera (predeterminado)
    // Si deseas usar la cámara frontal, puedes cambiar el parámetro a "user":
    // encenderCamara("user"); 
  } else {
    // Manejo de error para navegadores que no soportan getUserMedia
    alert("Tu navegador no soporta el acceso a la cámara. Por favor, actualiza tu navegador o usa uno diferente.");
  }
});

// Recomiendo usar un objeto para manejar el estado
const scannerState = {
    isScanning: false,
    selectedCamera: null,
    stream: null
};


