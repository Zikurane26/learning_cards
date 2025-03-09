<?php 
    include_once $_SERVER['DOCUMENT_ROOT'].'/learningcards/database/security/add_card.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/learningcards/style/css/add_card.css">
    <title>Add cards</title>
</head>
<body>
    <div class="card-container">
        <h1>Generador de Texto con Google Gemini</h1>
        <form action="" method="POST">
            <input type="text" name="word" id="inputText" placeholder="Escribe una palabra..." required>
            <input type="hidden" name="description" id="generatedContent">
            <button type="button" id="generateButton">Generar</button>
            <p id="responseText"></p>
            <div class="form-buttons">
                <input type="submit" value="Agregar" name="btn_add" class="submit-button">
                <a href="dashboard.php" class="cancel-button">Cancelar</a>
            </div>
        </form>
    </div>

    <script type="importmap">
        {
          "imports": {
            "@google/generative-ai": "https://esm.run/@google/generative-ai"
          }
        }
    </script>
    <script type="module">
        import { GoogleGenerativeAI } from "@google/generative-ai";

        // Reemplaza 'YOUR_API_KEY' con tu clave de API real
        const API_KEY = 'AIzaSyAWaalFETBcwLw287UIMO2-DwrhAARQVNo';
        const genAI = new GoogleGenerativeAI(API_KEY);

        document.getElementById('inputText').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                generateContent();
            }
        });
        document.getElementById('generateButton').addEventListener('click', async () => {
            generateContent();
        });


        async function generateContent() {
            const inputText = document.getElementById('inputText').value;
            const model = genAI.getGenerativeModel({ model: "gemini-1.5-pro-latest", systemInstruction: "Put the word on tittle with how pronunciation this word on that language. Tell me the mean of the word and 2 examples of use of the word. And . Make the same but in french, the word, pronunciation, mean and examples." });
            const prompt = inputText;

            // Pantalla de carga mientras se genera el contenido
            document.getElementById('responseText').innerHTML = 'Generating content...';

            try {
                console.log('Generando contenido con el modelo:', model);
                //console.log(model.generateContent(prompt));
                //Mostrar en consola el proceso de generación de contenido palabra por palabra
                //console.log('Generando contenido con el modelo:', result.response);
                const result = await model.generateContent(prompt);
                const response = await result.response;
                
                // Convertir el texto a HTML, aplicar negrita, reemplazar saltos de línea por <br>, las palabras que empiezan por ## aplicar <h2>, reemplazar los asteriscos individuales por puntos intermedios
                const formattedText = await response.text().replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>').replace(/\n/g, '<br>').replace(/##\s(.*?)<br>/g, '<h3>$1</h3>').replace(/\*/g, '•');
                // Mostrar el texto formateado en el elemento 'responseText'
                document.getElementById('responseText').innerHTML = formattedText;
                var hola = document.getElementById('responseText').innerHTML;
                // Guardar el contenido generado en un campo oculto
                document.getElementById('generatedContent').value = formattedText;
                
            } catch (error) {
                console.error('Error al generar contenido:', error);
            }
        };
    </script>
<?php 
    include_once $_SERVER['DOCUMENT_ROOT'].'/learningcards/function/description.php';
?>
</body>
</body>
</html>