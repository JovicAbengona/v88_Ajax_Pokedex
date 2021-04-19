<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Village88 Training | Web Fundamentals | CSS | Bootstrap">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <style>
            #pokemon_list{
                overflow: auto;
                height: 85vh;
            }
            #pokemon_list img:hover{
                border: 2px solid black;
                border-radius: 4px;
                cursor: pointer;
            }

            #pokedex{
                height: 85vh;
            }

            #pokedex .pokemon_img{
                background-color: white;
                height: 43vh;
                width: auto;
            }
        </style>
        <title>Ajax | Pokédex</title>
    </head>
    <body class="d-flex flex-column h-100">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand text-danger" href="<?= base_url(); ?>">Pokémon</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4 text-danger">The Original Pokémons</h1>
                <p class="lead">Village88 | Pokédex</p>
            </div>
        </div>
        <div class="container mb-3">
            <div class="row">
                <div id="pokemon_list" class="row col-lg-8">
                    <!-- Pokémon List -->
                </div>
                <div id="pokedex" class="row col-lg-4">
                    <div class="card shadow-sm bg-danger text-light">
                        <div class="card-body">
                            <h3 class="card-title text-center">Pokémon</h3>
                            <img src="https://i.pinimg.com/originals/30/be/cc/30beccd5eb33ceb5cdf1aa097e3e875c.jpg" class="card-img-top">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="container footer mt-auto text-danger text-center mt-5">
            <p>© 2021 Village88 | All Rights Reserved</p>
        </footer>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                var pokemon_list = "";
                var get_pokemon = "";

                for(var index=1; index<=151; index++){
                    /* 
                        Did some reading and it turns out get is asynchronous by default which means it is not guaranteed that
                        the data being fetch is going to be returned in order (i.e. pokemon #1, pokemon #2, pokemon #3).

                        I was able to 'solve' it using $.ajax instead of $.get but for this assignment, I'll stick with $.get.
                    */
                    

                    // $.ajax({
                    //     async: false,
                    //     type: 'GET',
                    //     url: "https://pokeapi.co/api/v2/pokemon/" + index,
                    //     success: function(pokemon) {
                    //         pokemon_list += "<div class='col-lg-2 mb-3'><div class='card shadow-sm'>";
                    //         pokemon_list += "<img id="+ pokemon.id +" src='"+ pokemon.sprites.front_default +"' class=''card-img-top' alt='"+ pokemon.name +"'>";
                    //         pokemon_list += "</div></div>";

                    //         $("#pokemon_list").html(pokemon_list);
                    //     }
                    // }, "json");

                    $.get("https://pokeapi.co/api/v2/pokemon/" + index, function(pokemon){
                        pokemon_list += "<div class='col-lg-2 mb-3'><div class='card shadow-sm'>";
                        pokemon_list += "<img id="+ pokemon.id +" src='"+ pokemon.sprites.front_default +"' class='card-img-top' alt='"+ pokemon.name +"'>";
                        pokemon_list += "</div></div>";

                        $("#pokemon_list").html(pokemon_list);
                    }, "json")
                }

                $(document).on("click", "img", function(){
                    $id = $(this).attr("id");

                    $.get("https://pokeapi.co/api/v2/pokemon/" + $id, function(pokemon){
                        get_pokemon += '<div class="card shadow-sm bg-danger text-light"><div class="card-body">';
                        get_pokemon += '<h3 class="card-title text-center">'+ pokemon.name.toUpperCase() +'</h3>';
                        get_pokemon += '<img src="'+ pokemon.sprites.front_default +'" class="pokemon_img card-img-top mt-3 mb-3">';
                        get_pokemon += '<h5 class="card-title mt-3">Types</h5>';
                        get_pokemon += '<ul>';
                        $.each(pokemon.types, function(index, value){
                            get_pokemon += '<li>'+ value.type.name +'</li>';
                        });
                        get_pokemon += '</ul>';
                        get_pokemon += '<h5 class="card-title">Height: <span class="font-weight-normal">'+ pokemon.height +'</span></h5>';
                        get_pokemon += '<h5 class="card-title">Weight: <span class="font-weight-normal">'+ pokemon.weight +'</span></h5>';
                        get_pokemon += '</div></div>';

                        $("#pokedex").html(get_pokemon);

                        get_pokemon = "";
                    }, "json")
                });
            });
        </script>
    </body>
</html>