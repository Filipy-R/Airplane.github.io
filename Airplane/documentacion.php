<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requisitos para el Curso de Piloto | FlightAir</title>
    <link rel="stylesheet" href="../WebSite/Includes/Style/curso.css">
    <style>
        .req-banner {
            width: 100%;
            max-width: 900px;
            margin: 0 auto 36px auto;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(44,62,80,0.10);
        }
        .req-banner img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
        }
       .requisitos-main {
            max-width: 1100px;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 24px rgba(44,62,80,0.07);
            padding: 32px 18px 40px 18px;
        }

        .req-banner {
            margin-top: 200px;
        }
        .requisitos-main h1 {
            color: #2980b9;
            text-align: center;
            margin-bottom: 18px;
            font-size: 2.1em;
        }
        .requisitos-main h2 {
            color: #1c5d8c;
            margin-top: 32px;
            margin-bottom: 10px;
            font-size: 1.18em;
        }
        .requisitos-main ul, .requisitos-main ol {
            margin: 0 0 0 22px;
            color: #4a4647;
            font-size: 1.08em;
        }
        .requisitos-main li {
            margin-bottom: 8px;
        }
        .requisitos-main .destacado {
            background: #f1f6fa;
            border-left: 5px solid #2980b9;
            padding: 14px 18px;
            border-radius: 8px;
            margin: 24px 0;
            color: #1c5d8c;
            font-weight: 500;
        }
        .requisitos-main .faq-link {
            color: #2980b9;
            text-decoration: underline;
            font-weight: 500;
        }
        @media (max-width: 900px) {
            .req-banner, .requisitos-main {
                max-width: 98vw;
            }
            .req-banner img {
                height: 120px;
            }
        }
        @media (max-width: 600px) {
            .requisitos-main {
                padding: 12px 2vw 24px 2vw;
            }
            .req-banner img {
                height: 70px;
            }
        }
    </style>
</head>
<body>
    <?php include("../WebSite/Includes/header.html"); ?>

    <main>
        <div class="req-banner">
            <img src="https://images.unsplash.com/photo-1464037866556-6812c9d1c72e?auto=format&fit=crop&w=1200&q=80" alt="Requisitos para ser piloto">
        </div>
        <section class="requisitos-main">
            <h1>Requisitos para Acceder al Curso de Piloto</h1>
            <p style="text-align:center; font-size:1.15em; color:#4a4647;">
                Convertirse en piloto profesional es un sueño alcanzable para quienes tienen pasión, disciplina y compromiso. Aquí te mostramos todo lo que necesitas para iniciar tu formación en España y dar el primer paso hacia una carrera en la aviación.
            </p>

            <div class="destacado">
                <span>✈️</span> <strong>¡Recuerda!</strong> No solo se trata de cumplir requisitos, sino de tener vocación, responsabilidad y ganas de superarte cada día.
            </div>

            <h2>Requisitos Generales</h2>
            <ul>
                <li><strong>Edad mínima:</strong> 18 años al obtener la licencia (puedes comenzar la formación desde los 16).</li>
                <li><strong>Estudios:</strong> Educación secundaria obligatoria finalizada.</li>
                <li><strong>Certificado médico Clase 1:</strong> Es imprescindible superar un examen médico aeronáutico oficial.</li>
                <li><strong>Inglés:</strong> Nivel avanzado (C2) o compromiso de alcanzarlo durante la formación.</li>
                <li><strong>Pasión y compromiso:</strong> La aviación requiere dedicación y responsabilidad.</li>
            </ul>

            <h2>Requisitos Médicos</h2>
            <ul>
                <li>Visión y audición correctas (se permiten gafas/lentes si se cumplen los mínimos).</li>
                <li>Buena salud física y mental.</li>
                <li>No padecer enfermedades incompatibles con el vuelo.</li>
                <li>Superar el reconocimiento médico en un centro autorizado.</li>
            </ul>

            <h2>Documentación Necesaria</h2>
            <ul>
                <li>DNI o pasaporte en vigor.</li>
                <li>Certificado médico aeronáutico Clase 1.</li>
                <li>Título de estudios (ESO o equivalente).</li>
                <li>Fotografías tamaño carnet.</li>
                <li>Formulario de inscripción en la escuela de pilotos.</li>
            </ul>

            <h2>¿Cómo es el proceso de admisión?</h2>
            <ol>
                <li>Solicita información y realiza una entrevista personal o virtual.</li>
                <li>Entrega la documentación requerida.</li>
                <li>Realiza y aprueba el reconocimiento médico.</li>
                <li>Formaliza la matrícula y comienza tu formación.</li>
            </ol>

            <div class="destacado">
                <span>📚</span> <strong>Consejo:</strong> Si tienes dudas sobre tu aptitud médica, consulta antes con un centro autorizado. ¡No te quedes con la duda!
            </div>

            <h2>Preguntas Frecuentes</h2>
            <ul>
                <li><strong>¿Puedo empezar antes de los 18?</strong> Sí, pero la licencia se otorga a partir de esa edad.</li>
                <li><strong>¿Qué nivel de inglés necesito?</strong> Avanzado, pero puedes formarte durante el curso.</li>
                <li><strong>¿El reconocimiento médico es difícil?</strong> Es riguroso, pero la mayoría de los jóvenes sanos lo superan sin problemas.</li>
                <li><strong>¿Puedo estudiar y trabajar a la vez?</strong> Sí, pero la formación requiere tiempo y dedicación.</li>
            </ul>
            <p style="text-align:center; margin-top:24px;">
                ¿Tienes más dudas? Consulta nuestra <a class="faq-link" href="faq.php">sección de preguntas frecuentes</a> o <a class="faq-link" href="contacto.php">contáctanos</a>.
            </p>
        </section>
    </main>

    <?php include("../WebSite/Includes/footer.html"); ?>
</body>
</html>