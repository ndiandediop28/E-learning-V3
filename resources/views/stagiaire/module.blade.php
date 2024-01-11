@extends('stagiaire.leftmenu')
@section('content')

<div class=" mt-20 mb-4 ml-4"> <span class="text-2xl  bg-gray-700 text-white font-semibold py-2 px-4 rounded-3xl">Modules en {{ Auth::guard('stagiaire')->user()->domaine->nomDomaine  }} </span></div>

<div class=" flex container mx-auto justify-center bg-gray-700   rounded-3xl">

    <div class="container mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-2">
          <!--gregregr Carte du module 1 -->
            @if ($modules->count() == 0)
            <h1 class="text-2xl font-semibold text-white ">Aucun module</h1>
            @endif
          @foreach ($modules as $m)
       <a href="{{ route('stagiaires.courstagiaire', $m->id) }}">
        <div class="bg-white p-6 rounded-lg shadow-md h-full">
            <img src="{{ asset('images/'.$m->image) }}" alt="" srcset="" class="w-full h-32 object-cover">

                       @include('stagiaire.progressebar')

            <h2 class="text-xl font-semibold text-gray-800">{{ $m->nomModule }}</h2>
            <p class="text-gray-600">{{ Str::limit(htmlspecialchars_decode(strip_tags($m->description)), 80) }}</p>
        </div>
        </a>
          @endforeach


        </div>
      </div>

    </div>



    @endsection

    <style>

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

