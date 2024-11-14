CONFIG = {
    SCAN_INTERVAL: 300,
    DEFAULT_CAMERA: 'environment',
    SUPPORTED_FORMATS: ['QR_CODE'] // Si la librería lo soporta
};

// Configuración centralizada
const CONFIG = {
    SCAN_INTERVAL: 300,
    SCAN_TIMEOUT: 30000, // 30 segundos máximo de escaneo
    DEFAULT_CAMERA: 'environment',
    CAMERA_CONSTRAINTS: {        // Añadir configuración de la cámara
        width: { ideal: 1280 },
        height: { ideal: 720 },
        facingMode: 'environment'
    },
    UI: {
        SCANNING_TEXT: 'Escaneando...',
        SUCCESS_TEXT: 'QR escaneado con éxito',  // Añadir mensajes de éxito
        ERROR_MESSAGES: {
            NO_CAMERA: 'No se encontraron cámaras disponibles',
            PERMISSION_DENIED: 'Acceso a la cámara denegado',
            TIMEOUT: 'Tiempo de escaneo agotado',  // Añadir mensaje de timeout
            UNSUPPORTED: 'Tu navegador no soporta el escáner de QR'
        }
    },
    SUPPORTED_FORMATS: ['QR_CODE'],  // Especificar formatos soportados
    DEBUG: false                     // Modo debug para desarrollo
};

// Gestión de estado mejorada
const scannerState = {
    isScanning: false,
    selectedCamera: null,
    stream: null,
    scanTimeout: null
};

// Validación de QR mejorada
const procesarQR = (contenido) => {
    // Validar contenido
    if (!contenido) return false;
    
    // Sanitizar y validar URLs si es necesario
    if (contenido.startsWith('http')) {
        const url = new URL(contenido);
        // Validar dominio permitido, etc.
    }
    
    return true;
};

// Callback mejorado
qrcode.callback = (respuesta) => {
    if (respuesta && procesarQR(respuesta)) {
        clearTimeout(scannerState.scanTimeout);
        mostrarNotificacion('QR escaneado con éxito');
        activarSonido();
        guardarEnHistorial(respuesta);
        show(respuesta);
        cerrarCamara();
    }
};

const validateConfig = (config) => {
    // Validar intervalos
    if (config.SCAN_INTERVAL < 100 || config.SCAN_INTERVAL > 1000) {
        console.warn('SCAN_INTERVAL fuera de rango recomendado (100-1000ms)');
    }
    
    // Validar timeout
    if (config.SCAN_TIMEOUT < 5000 || config.SCAN_TIMEOUT > 60000) {
        console.warn('SCAN_TIMEOUT fuera de rango recomendado (5s-60s)');
    }
    
    return config;
};

// Uso
const CONFIG = validateConfig({
    // ... configuración actual ...
});



// Funciones auxiliares que debes implementar
function mostrarNotificacion(mensaje) {
    // Tu código para mostrar notificaciones
}

function activarSonido() {
    // Tu código para reproducir sonido
}

function show(respuesta) {
    // Tu código para mostrar el resultado
}

function cerrarCamara() {
    // Tu código para cerrar la cámara
}

function guardarEnHistorial(respuesta) {
    // Tu código para guardar el historial
}

// Agregar función de inicio
const iniciarEscaner = async () => {
    try {
        const stream = await navigator.mediaDevices.getUserMedia({
            video: CONFIG.CAMERA_CONSTRAINTS
        });
        scannerState.stream = stream;
        // Iniciar el proceso de escaneo
    } catch (error) {
        mostrarNotificacion(CONFIG.UI.ERROR_MESSAGES.PERMISSION_DENIED);
    }
};

// Agregar indicadores visuales
const actualizarUI = (estado) => {
    const overlay = document.getElementById('scanner-overlay');
    overlay.className = `scanner-overlay ${estado}`;
    // Actualizar mensajes y estados visuales
};

// Agregar manejo de errores
const manejarError = (error) => {
    console.error('Error en el escáner:', error);
    mostrarNotificacion(CONFIG.UI.ERROR_MESSAGES[error.type] || 'Error desconocido');
    cerrarCamara();
};

