@extends('stagiaire.leftmenu')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function markCourseCompleted() {
        // Votre logique pour marquer le cours comme terminé

        // Ensuite, vous pourriez avoir une requête AJAX pour mettre à jour la barre de progression dans la vue de module
        // par exemple, en utilisant jQuery :
        $.ajax({
            url: '{{ route("update-progress") }}', // L'URL doit être adaptée à votre structure de routes Laravel
            method: 'POST',
            headers:{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                // Les données que vous souhaitez envoyer pour mettre à jour la progression
            },
            success: function(response) {
                // Gérer la réponse du serveur
                console.log(response);
            },
            error: function(error) {
                // Gérer les erreurs
                console.error(error);
            }
        });
    }



    
</script>



<div class=" mt-20 mb-4 ml-4"> <span class="text-2xl  bg-gray-700 text-white font-semibold py-2 px-4 rounded-3xl">Les cours du module {{ $modules->nomModule}} </span></div>

<div class=" flex container mx-auto justify-center bg-gray-700   rounded-3xl">

    <div class="container mx-auto p-4">


          <!--gregregr Carte du module 1 -->


          <table class="min-w-full">
            <thead>
              <tr>
                <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                 Cour
                </th>
                <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                ressources
                </th>
                <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                description
                 </th>
                 <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    envoie fichier
                    </th>

                    <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Progrssion
                        </th>
                <!-- Ajoutez plus d'en-têtes de colonnes si nécessaire -->



                {{-- -------------------------- --}}
              </tr>
            </thead>

            <tbody>
              @if ($cours->count() == 0)

              <td class="px-6 py-4 text-center text-3xl font-bold text-whith uppercase tracking-wider border-gray-300">
                Aucun cours disponible sur ce module pour le moment
              </td>

          @endif
              @foreach ($cours as $c)


              <tr>
                <td class="px-6 py-4 text-white whitespace-nowrap border-b border-gray-300">
                {{ $c->nomCours}}
                </td>
                <td class="px-6 py-4 text-white  whitespace-pre-line  border-b border-gray-300">
                    <a href="{{ $c->ressource }}" target="_blank">
                {{ $c->ressource }}

            </a>
                </td>
                <td class="px-6 py-4 text-white whitespace-pre-line  border-b border-gray-300">
                  {{ $c->description }}

                </td>

                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300">
                  <a class="bg-indigo-600 hover:bg-indigo-600  text-gray-400 hover:text-white font-bold py-2 px-4 rounded m-2" href="{{ route("stagiaires.gettache",$c->id) }}">
                    <i class="fas fa-upload ml-1"></i>

                  </a>

                  </td>

                  <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300">


                        <div class="percentage-container"></div>
                        <div class="button-container">
                            <button class="bg-indigo-600 hover:bg-indigo-600  text-gray-400 hover:text-white font-bold py-2 px-4 rounded m-2" onclick="markCourseCompleted()">Terminé</button>
                        </div>


                    {{-- <button class="bg-indigo-600 hover:bg-indigo-600  text-gray-400 hover:text-white font-bold py-2 px-4 rounded m-2">terminer</button> --}}

                    </td>
                <!-- Ajoutez plus de cellules pour chaque ligne de données -->
              </tr>
              @endforeach

              <!-- Ajoutez plus de lignes de données si nécessaire -->
            </tbody>
          </table>

        </div>
      </div>






@endsection

