const cors = require('cors');
const express = require('express');
const app = express();

app.use(cors({
    origin: 'http://localhost:8000'  // Asegúrate de que esta URL sea tu frontend
}));

app.use(express.json());  // Para poder leer el cuerpo de las solicitudes como JSON

app.post('/exportar', (req, res) => {
    console.log(req.body);  // Verifica que el cuerpo de la solicitud esté llegando correctamente

    // Lógica para procesar el SVG y devolver una URL o archivo
    res.json({ url: 'ruta/del/archivo.png' });  // Simula la respuesta del servidor
});

app.listen(8004, () => {
    console.log('Servidor escuchando en el puerto 8004');
});
