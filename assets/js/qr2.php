<!DOCTYPE html>
<html>
<head>
    <title>Escáner QR</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="scanner-container">
        <video id="scanner-video"></video>
        <div id="scanner-overlay"></div>
        <div id="result"></div>
        <button onclick="iniciarEscaner()">Iniciar Escaneo</button>
    </div>

    <script src="qr-library.js"></script>
    <script src="qr2.js"></script>
    <script src="app.js"></script>
</body>
</html>
