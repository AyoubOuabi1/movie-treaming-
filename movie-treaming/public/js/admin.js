loadTopMovies(1)
//------------------------------Movies Section----------------------------------//
function loadTopMovies(page) {
    const movieBody = document.getElementById('movieBody');
    if(movieBody){
        movieBody.innerHTML = '';
        $.ajax({
            url: "http://localhost:8000/api/movies?page=" + page,
            dataType: "json",
            success: function(data) {
                console.log(data);

                // Loop through each movie object in the response data
                data.data.forEach(function(movie) {
                    // Create a new HTML template literal for this movie
                    // Create the HTML elements for this movie

                    movieBody.appendChild(printMovies(movie));
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                // Handle any errors that occur while making the request
            }
        });
    }else{
        console.log(movieBody)
    }
    // Clear the container element's contents

}
function printMovies(movie){
    const tr = document.createElement('tr');
    const td1 = document.createElement('td');
    const img = document.createElement('img');
    img.classList.add('rounded-circle', 'me-2');
    img.width = '50';
    img.height = '50';
    img.src = movie.cover_image;
    td1.appendChild(img);
    td1.appendChild(document.createTextNode(movie.name));
    tr.appendChild(td1);
    const td2 = document.createElement('td');
    td2.appendChild(document.createTextNode(movie.realased_date));
    tr.appendChild(td2);
    const td3 = document.createElement('td');
    td3.appendChild(document.createTextNode(movie.totalView));
    tr.appendChild(td3);
    const td4 = document.createElement('td');
    td4.appendChild(document.createTextNode(movie.created_at));
    tr.appendChild(td4);
    const td5 = document.createElement('td');
    tr.appendChild(td5);
    return tr;
}

//------------------------------End Movies Section----------------------------------//
//------------------------------Actors Section----------------------------------//
function getActorsForMovies() {
    const actorBody = document.getElementById('actors_body_M');
    if(actorBody){
        actorBody.innerHTML = '';
        $.ajax({
            url: "http://localhost:8000/api/movies?page=" + page,
            dataType: "json",
            success: function(data) {
                console.log(data);

                // Loop through each movie object in the response data
                data.data.forEach(function(movie) {
                    // Create a new HTML template literal for this movie
                    // Create the HTML elements for this movie

                    actorBody.appendChild(printMovies(movie));
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                // Handle any errors that occur while making the request
            }
        });
    }else{
        console.log(actorBody)
    }
    // Clear the container element's contents

}

function printActor(actor){

}
