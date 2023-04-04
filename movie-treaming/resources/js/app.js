//import './bootstrap';
//import carousel from "bootstrap/js/src/carousel";


loadTopMovies(1);

function openMovie(id){
    window.open("http://localhost:8000/movie/"+id);
}
function loadTopMovies(page) {
    const topMoviesContainer = document.getElementById('topMovies');
    // Clear the container element's contents
    topMoviesContainer.innerHTML = '';
    $.ajax({
        url: "http://localhost:8000/api/movies?page=" + page,
        dataType: "json",
        success: function(data) {
            console.log(data);

            // Loop through each movie object in the response data
            data.data.forEach(function(movie) {
                // Create a new HTML template literal for this movie
                // Create the HTML elements for this movie

                topMoviesContainer.appendChild(printMovies(movie));
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            // Handle any errors that occur while making the request
        }
    });
}
document.getElementById("searchInput").addEventListener('keyup',function (e) {
    findMovie();
})
function findMovie(){
    const topMoviesContainer = document.getElementById('topMovies');
    // Clear the container element's contents
    topMoviesContainer.innerHTML = '';
    $.ajax({
        url: "http://localhost:8000/api/movie/" + $("#searchInput").val(),
        dataType: "json",
        success: function(data) {
            topMoviesContainer.innerHTML = '';
            // Loop through each movie object in the response data
            data.forEach(function(movie) {
                // Create a new HTML template literal for this movie
                // Create the HTML elements for this movie

                topMoviesContainer.appendChild(printMovies(movie));
            });
            if($("#searchInput").val()=="") {
                loadTopMovies(1)
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            // Handle any errors that occur while making the request
        }
    });
}

document.getElementById("click1").addEventListener('click', function(){
    loadTopMovies(1);

})
document.getElementById("click2").addEventListener('click', function(){
    loadTopMovies(2);

})

function printMovies(movie){
    const movieContainer = document.createElement('div');
    movieContainer.classList.add('col-lg-3', 'col-md-3', 'col-6');

    const cardContainer = document.createElement('div');
    cardContainer.classList.add('card', 'mb-3');


    const imageElement = document.createElement('img');
    imageElement.classList.add('card-img-top');
    imageElement.src = movie.cover_image;
    imageElement.alt = '';

    const cardBodyElement = document.createElement('div');
    cardBodyElement.classList.add('card-body');

    const titleElement = document.createElement('h5');
    titleElement.classList.add('card-title');
    titleElement.textContent = movie.name;

    const descriptionElement = document.createElement('p');
    descriptionElement.classList.add('card-text');
    descriptionElement.textContent = `${movie.description.substring(0,70)}...`;

    const watchNowElement = document.createElement('a');
    watchNowElement.href = '#';
    watchNowElement.onclick = () => openMovie(movie.id);
    watchNowElement.classList.add('btn', 'btn-primary');
    watchNowElement.textContent = 'Watch Now';

    // Append the HTML elements to the appropriate parent elements
    cardContainer.appendChild(imageElement);
    cardBodyElement.appendChild(titleElement);
    cardBodyElement.appendChild(descriptionElement);
    cardBodyElement.appendChild(watchNowElement);
    cardContainer.appendChild(cardBodyElement);
    movieContainer.appendChild(cardContainer);
    return movieContainer;

}


