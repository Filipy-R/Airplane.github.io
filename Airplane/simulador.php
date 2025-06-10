<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador de Examen Teórico de Aviación | FlightAir</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
    
        body {
            background: linear-gradient(135deg, #e4ebf5 0%, #f7fafd 100%);
            min-height: 100vh;
        }
        .sim-header {
            background: #2980b9;
            color: #fff;
            border-radius: 12px;
            padding: 32px 24px 18px 24px;
            margin-bottom: 32px;
            box-shadow: 0 4px 24px rgba(44,62,80,0.10);
            text-align: center;
        }
        .sim-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 24px rgba(44,62,80,0.09);
            padding: 32px 24px;
            max-width: 520px;
            margin: 0 auto;
            transition: box-shadow 0.2s;
        }
        .sim-card img {
            width: 70px;
            height: 70px;
            object-fit: contain;
            margin-bottom: 18px;
        }
        .sim-option {
            transition: background 0.2s, color 0.2s;
            cursor: pointer;
            border-radius: 8px;
            padding: 12px 18px;
            margin-bottom: 12px;
            border: 1.5px solid #e4ebf5;
            font-size: 1.08em;
        }
        .sim-option.correct {
            background: #d4f8e8;
            color: #218838;
            border-color: #34c759;
            font-weight: 600;
        }
        .sim-option.incorrect {
            background: #ffeaea;
            color: #c82333;
            border-color: #ff4d4f;
            font-weight: 600;
        }
        .sim-option.disabled {
            pointer-events: none;
            opacity: 0.7;
        }
        .sim-progress {
            margin-bottom: 18px;
            color: #2980b9;
            font-weight: 600;
        }
        .sim-btn {
            margin-top: 18px;
        }
        .sim-result {
            text-align: center;
            padding: 32px 0 0 0;
        }
        @media (max-width: 600px) {
            .sim-card {
                padding: 16px 4vw;
            }
            .sim-header {
                
                padding: 18px 4vw 10px 4vw;
            }
        }
        .containerpy-4{
            margin-top: 150px;
            padding: 0 16px;
            max-width: 1200px;
        }
    </style>
</head>
<body>
    <?php include("../WebSite/Includes/header.html"); ?>
    <div class="containerpy-4">
        <div class="sim-header">
            <h1>Simulador de Examen Teórico de Aviación</h1>
            <p>Practica tus conocimientos de aviación con preguntas reales y aprende de tus errores. ¡Buena suerte!</p>
        </div>
        <div id="simulador-app"></div>
    </div>
    <script>
        // Preguntas del simulador (puedes conectar a una base de datos aquí)
        const preguntas = [
            {
                texto: "¿Cuál es la función principal del altímetro en una cabina de avión?",
                opciones: [
                    "Medir la velocidad del avión",
                    "Indicar la altitud sobre el nivel del mar",
                    "Mostrar la dirección del viento",
                    "Controlar la temperatura de la cabina"
                ],
                correcta: 1,
                imagen: "https://cdn-icons-png.flaticon.com/512/2933/2933887.png",
                alt: "Altímetro"
            },
            {
                texto: "¿Qué significa la sigla ATC en aviación?",
                opciones: [
                    "Air Traffic Control",
                    "Automatic Thrust Control",
                    "Aircraft Technical Certificate"
                ],
                correcta: 0,
                imagen: "https://cdn-icons-png.flaticon.com/512/3135/3135715.png",
                alt: "Torre de control"
            },
            {
                texto: "¿Cuál es la velocidad máxima aproximada de crucero de un Airbus A320?",
                opciones: [
                    "560 km/h",
                    "840 km/h",
                    "1.200 km/h"
                ],
                correcta: 1,
                imagen: "https://cdn-icons-png.flaticon.com/512/616/616494.png",
                alt: "Avión Airbus"
            },
            {
                texto: "¿Qué instrumento se utiliza para indicar el rumbo de la aeronave?",
                opciones: [
                    "Horizonte artificial",
                    "Brújula o indicador de rumbo",
                    "Altímetro"
                ],
                correcta: 1,
                imagen: "https://cdn-icons-png.flaticon.com/512/2933/2933886.png",
                alt: "Brújula de avión"
            },
            {
                texto: "¿Qué fenómeno meteorológico puede causar turbulencia severa?",
                opciones: [
                    "Niebla densa",
                    "Tormentas y cumulonimbos",
                    "Viento suave"
                ],
                correcta: 1,
                imagen: "https://cdn-icons-png.flaticon.com/512/414/414974.png",
                alt: "Nube tormenta"
            }
        ];

        // Estado del simulador
        let estado = {
            actual: 0,
            respuestas: [],
            terminado: false
        };

        // Render principal
        function renderSimulador() {
            const app = document.getElementById('simulador-app');
            app.innerHTML = "";

            if (estado.terminado) {
                let correctas = estado.respuestas.filter(r => r.correcta).length;
                app.innerHTML = `
                    <div class="sim-card sim-result animate__animated animate__fadeIn">
                        <h2>¡Examen finalizado!</h2>
                        <p>Respuestas correctas: <strong>${correctas}</strong> de <strong>${preguntas.length}</strong></p>
                        <button class="btn btn-primary sim-btn" onclick="reiniciarSimulador()">Reiniciar examen</button>
                    </div>
                `;
                return;
            }

            const pregunta = preguntas[estado.actual];
            const progreso = `<div class="sim-progress">Pregunta ${estado.actual + 1} de ${preguntas.length}</div>`;
            let opcionesHtml = "";

            // Si ya respondió, mostrar feedback
            const respuestaUsuario = estado.respuestas[estado.actual];

            pregunta.opciones.forEach((op, idx) => {
                let clase = "sim-option";
                if (respuestaUsuario) {
                    if (idx === pregunta.correcta) clase += " correct";
                    else if (idx === respuestaUsuario.seleccionada) clase += " incorrect";
                    clase += " disabled";
                }
                opcionesHtml += `
                    <div class="${clase}" onclick="seleccionarOpcion(${idx})">${op}</div>
                `;
            });

            let feedback = "";
            if (respuestaUsuario) {
                if (respuestaUsuario.seleccionada === pregunta.correcta) {
                    feedback = `<div class="text-success mt-2"><strong>¡Correcto!</strong></div>`;
                } else {
                    feedback = `<div class="text-danger mt-2"><strong>Incorrecto.</strong> La respuesta correcta es: <span class="fw-bold">${pregunta.opciones[pregunta.correcta]}</span></div>`;
                }
            }

            let btnSiguiente = "";
            if (respuestaUsuario) {
                if (estado.actual < preguntas.length - 1) {
                    btnSiguiente = `<button class="btn btn-success sim-btn" onclick="siguientePregunta()">Siguiente pregunta</button>
                                    <button class="btn btn-outline-secondary sim-btn" onclick="intentarOtraVez()">Intentar otra vez</button>`;
                } else {
                    btnSiguiente = `<button class="btn btn-primary sim-btn" onclick="finalizarExamen()">Ver resultados</button>
                                    <button class="btn btn-outline-secondary sim-btn" onclick="intentarOtraVez()">Intentar otra vez</button>`;
                }
            }

            app.innerHTML = `
                <div class="sim-card animate__animated animate__fadeIn">
                    ${progreso}
                    <img src="${pregunta.imagen}" alt="${pregunta.alt}">
                    <h4 class="mb-3">${pregunta.texto}</h4>
                    ${opcionesHtml}
                    ${feedback}
                    ${btnSiguiente}
                </div>
            `;
        }

        function seleccionarOpcion(idx) {
            const pregunta = preguntas[estado.actual];
            estado.respuestas[estado.actual] = {
                seleccionada: idx,
                correcta: idx === pregunta.correcta
            };
            renderSimulador();
        }

        function siguientePregunta() {
            estado.actual++;
            renderSimulador();
        }

        function intentarOtraVez() {
            estado.respuestas[estado.actual] = undefined;
            renderSimulador();
        }

        function finalizarExamen() {
            estado.terminado = true;
            renderSimulador();
        }

        function reiniciarSimulador() {
            estado = { actual: 0, respuestas: [], terminado: false };
            renderSimulador();
        }

        // Inicializar
        document.addEventListener("DOMContentLoaded", renderSimulador);
    </script>
</body>
</html>