import './bootstrap';
import carousel from "bootstrap/js/src/carousel";
//loadMovies();
function loadMovies() {
    $.ajax({
        url: "https://ayoubouabi1.github.io/movie-treaming-/movie-treaming/data.js",
        dataType: "json",
        success: function(data) {
            getVideoByCategory(data);

            // Do something with the data returned by the API
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            // Handle any errors that occur while making the request
        }
    });

}


function getVideoByCategory(data){
    const moviesByCategory = {};


    data.forEach(movie => {
        if (moviesByCategory[movie.category]) {
            moviesByCategory[movie.category].push(movie);
        } else {
            moviesByCategory[movie.category] = [movie];
        }
    });
    console.log(moviesByCategory);
// Display movies by category in sections
     for (const category in moviesByCategory) {
         const movies = moviesByCategory[category];


         movies.forEach(movie => {
             document.getElementById('categorySection').innerHTML+=category;
             document.getElementById('movieSection').innerHTML+=`
                     <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card">
                        <img src="${movie.img}" alt="Movie Poster" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">${movie.title}</h5>
                            <p class="card-text">${movie.description.substring(0,30)}....</p>
                            <a href="#" class="btn btn-danger">Watch Now</a>
                        </div>
                    </div>

                </div>
       `
         });

    }
}

function loadMovie(movies) {

}
