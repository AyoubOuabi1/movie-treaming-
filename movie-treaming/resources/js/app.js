import './bootstrap';
import carousel from "bootstrap/js/src/carousel";


loadTopMovies(1);
function loadTopMovies(page) {
    document.getElementById("topMovies").innerHTML="";
    $.ajax({
        url: "http://localhost:8000/api/movies?page=" + page,
        dataType: "json",
        success: function(data) {
            // Loop through each movie object in the response data
            data.data.forEach(function(movie) {
                // Create a new HTML template literal for this movie
                var movieHtml = `
                    <div class="col-lg-3 col-md-3 col-6">
                        <div class="card mb-3">
                            <img src="${movie.cover_image}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">${movie.name}</h5>
                                <p class="card-text">${movie.description.substring(0,70)}...</p>
                                <a href="#" class="btn btn-primary">Watch Now</a>
                            </div>
                        </div>
                    </div>
                `;
                // Add the movie HTML to the topMovies container
                document.getElementById("topMovies").innerHTML += movieHtml;
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            // Handle any errors that occur while making the request
        }
    });
}


document.getElementById("click2").addEventListener('click', function(){
    loadTopMovies(2);

})

