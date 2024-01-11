
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barre de Progression en Cercle</title>

    <style>
        body {
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .progress-container {
            position: relative;
            width: 200px;
            height: 200px;

        }

        .outer-circle {
            fill: none;
            stroke: #ddd;
            stroke-width: 15;
        }

        .inner-circle {
            fill: none;
            stroke: #db36a4;
            stroke-width: 15;
            stroke-dasharray: 0;
            transition: stroke-dasharray 0.3s ease;
        }

        .percentage-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            font-size: 14px;
        }

        .button-container {
            position: absolute;
            top: 80%;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
        }

        .button-container button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #3498db;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="progress-container">
        <svg class="svg-container" viewBox="0 0 100 100">
            <circle class="outer-circle" cx="50" cy="50" r="45"></circle>
            <circle class="inner-circle" cx="50" cy="50" r="45"></circle>
        </svg>
        <div class="percentage-container"></div>
        {{-- <div class="button-container">
            <button onclick="markCourseCompleted()">Terminé</button>
        </div> --}}
    </div>

    <script>
        let completedCourses = 0;
        const totalCourses = 4; // Remplacez par le nombre total de cours dans le module

        function markCourseCompleted() {
            if (completedCourses < totalCourses) {
                completedCourses++;
                updateProgressBar();
            }
        }

        function updateProgressBar() {
            const innerCircle = document.querySelector('.inner-circle');
            const percentageContainer = document.querySelector('.percentage-container');
            const percentageCompleted = (completedCourses / totalCourses) * 100;
            const dashArrayValue = (percentageCompleted * 283) / 100; // 283 is the circumference of a circle with radius 45

            innerCircle.style.strokeDasharray = `${dashArrayValue} 283`;

            // Ajouter le pourcentage dans le conteneur
            percentageContainer.innerHTML = `${completedCourses}/${totalCourses} Cours (${Math.round(percentageCompleted)}%)`;

            if (completedCourses === totalCourses) {
                // alert('Félicitations ! Vous avez terminé tous les cours du module.');
            }
        }
    </script>

</body>
</html>

