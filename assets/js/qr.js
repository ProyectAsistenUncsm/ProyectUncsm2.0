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
const encenderCamara = async (tipoDeCamara = "environment") => {
  const permisoConcedido = await solicitarPermisoCamara();
  
  if (!permisoConcedido) {
    return;
  }

  if (navigator.mediaDevices && navigator.mediaDevices.enumerateDevices) {
    try {
      const devices = await navigator.mediaDevices.enumerateDevices();
      const videoDevices = devices.filter(device => device.kind === "videoinput");

      if (videoDevices.length === 0) {
        mostrarMensajeError("No se encontraron cámaras disponibles.");
        return;
      }

      // Usamos las etiquetas para encontrar la cámara correcta
      const selectedDevice = videoDevices.find(device =>
        tipoDeCamara === "environment" ? device.label.toLowerCase().includes("back") : device.label.toLowerCase().includes("front")
      ) || videoDevices[0]; // Si no se encuentra, usamos la primera cámara disponible.

      // Iniciamos el stream con el dispositivo seleccionado
      iniciarStream(selectedDevice.deviceId);
    } catch (error) {
      mostrarMensajeError("Error al intentar acceder a los dispositivos de cámara.", error);
    }
  } else {
    mostrarMensajeError("El navegador no soporta acceso a la cámara.");
  }
};

// Recomiendo usar un objeto para manejar el estado
const scannerState = {
  isScanning: false,
  selectedCamera: null,
  stream: null
};
// Iniciar el stream de la cámara
const iniciarStream = async (deviceId) => {
  try {
    const stream = await navigator.mediaDevices.getUserMedia({
      video: { deviceId: { exact: deviceId } }
    });

    scannerState.stream = stream; // Guardamos el stream en el estado
    scannerState.isScanning = true;

    btnScanQR.hidden = true;
    canvasElement.hidden = false;
    video.setAttribute("playsinline", true); // Requerido para iOS Safari
    video.srcObject = stream;
    video.play();

    tick();
    scan();
  } catch (error) {
    mostrarMensajeError("Error al iniciar el stream de la cámara.", error);
  }
};

// Apagar la cámara y detener el stream
const cerrarCamara = () => {
  if (scannerState.stream) {
    scannerState.stream.getTracks().forEach(track => track.stop());
    scannerState.stream = null; // Liberamos el stream
  }
  canvasElement.hidden = true;
  btnScanQR.hidden = false;
  scannerState.isScanning = false;
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
  if (!scanning) return;

  try {
    qrcode.decode(); // Intentamos decodificar el código QR
  } catch (error) {
    // Mostramos un mensaje si ocurre un error específico
    console.warn("No se pudo leer el QR, intentando nuevamente...", error);
  } finally {
    // Intentamos nuevamente después de un breve intervalo
    setTimeout(scan, 300);
  }
}

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

// Función para solicitar permiso de cámara
const solicitarPermisoCamara = async () => {
  try {
    const result = await Swal.fire({
      title: '¿Permitir acceso a la cámara?',
      text: 'Necesitamos acceder a tu cámara para escanear códigos QR',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Permitir',
      cancelButtonText: 'Denegar'
    });

    if (result.isConfirmed) {
      return true;
    } else {
      Swal.fire({
        title: 'Acceso denegado',
        text: 'No podrás escanear códigos QR sin acceso a la cámara',
        icon: 'info'
      });
      return false;
    }
  } catch (error) {
    mostrarMensajeError("Error al solicitar permiso de cámara", error);
    return false;
  }
};

// Evento para mostrar la cámara al cargar la página
window.addEventListener('load', () => {
  if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    encenderCamara("environment");
  } else {
    mostrarMensajeError("Tu navegador no soporta el acceso a la cámara. Por favor, actualiza tu navegador o usa uno diferente.");
  }
});





