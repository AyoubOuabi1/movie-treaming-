//import './bootstrap';
//import carousel from "bootstrap/js/src/carousel";
loadTopMovies(1);

function openMovie(id){
    window.open("http://localhost:8000/movie/"+id);
}
//movie section
function loadTopMovies(page) {
    const topMoviesContainer = document.getElementById('topMovies');
    if(topMoviesContainer){
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
    }else{
        console.log(topMoviesContainer)
    }
    // Clear the container element's contents

}

function findMovie(){
    const topMoviesContainer = document.getElementById('topMovies');
    // Clear the container element's contents
    topMoviesContainer.innerHTML = '';
    if($("#searchInput").val()!==""){
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
    }else {
        loadTopMovies(1);
    }

}
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
///////////////////////Favorite Function////////////////////////
function addToFav(id){
    // Clear the container element's contents


    $.ajax({
        url: "http://localhost:8000/api/favorite",
        type: 'post',
        data:{
            'movie_id': id,
        },
        dataType: "json",
        success: function(data) {

            Swal.fire(
                'Good job!',
                'Movie has been added!',
                'success'
            )
            $("#btnConatiner").html(" ")
            const btn=createButton('btn-danger',"Remove from Favorites")
            btn.onclick = () => removeFromFav(id);
            $("#btnConatiner").append(btn);

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            // Handle any errors that occur while making the request
        }
    });
}
function removeFromFav(id){
    // Clear the container element's contents


    $.ajax({
        url: "http://localhost:8000/api/favorite/"+id,
        type: 'delete',
        data:{
            'movie_id': id,
        },
        dataType: "json",
        success: function(data) {
            $("#btnConatiner").html(" ")
            Swal.fire(
                'Good job!',
                'Movie has been Removed from Favorite!',
                'success'
            )
            const btn=createButton('btn-success',"Add into Favorites")
            btn.onclick = () => addToFav(id);
            $("#btnConatiner").append(btn);


        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            // Handle any errors that occur while making the request
        }
    });
}
function createButton(btnClass,txt,id){
    const favBtn = document.createElement('Button');
    favBtn.classList.add('btn');
    favBtn.classList.add(btnClass);
    favBtn.classList.add('col-8');
    favBtn.classList.add('mt-3');
    favBtn.textContent = txt;
    return favBtn
}

///////////////////////Review Function////////////////////////

function giveRate(id){

    // Clear the container element's contents
     $.ajax({

        url: "http://localhost:8000/api/rating",
         type: 'post',
         data:{
            'movie_id': id,
             'stars':$('.rate:checked').val()

         },
        dataType: "json",
        success: function(data) {
            Swal.fire(
                'Good job!',
                'Your review has been added!',
                'success'
            )
            setInterval('location.reload()', 2000);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            // Handle any errors that occur while making the request
        }
    });
}
function updateRate(id){

    // Clear the container element's contents
    $.ajax({

        url: "http://localhost:8000/api/update-rating",
        type: 'put',
        data:{
            'movie_id': id,
            'stars':$('.rate:checked').val()

        },
        dataType: "json",
        success: function(data) {
            console.log(data)
            Swal.fire(
                'Good job!',
                'Your review has been updated!',
                'success'
            )
            setInterval('location.reload()', 2000);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            // Handle any errors that occur while making the request
        }
    });
}

function deleteRate(id){

    // Clear the container element's contents
    $.ajax({

        url: "http://localhost:8000/api/delete-rating/"+id,
        type: "delete",
        dataType: "json",
        success: function(data) {
            Swal.fire(
                'Good job!',
                'Your review has been deleted!',
                'success'
            )
            setInterval('location.reload()', 2000);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            // Handle any errors that occur while making the request
        }
    });
}


///////////////////////Review Button////////////////////////
$("#giveRateBtn").click(function(e){
    console.log($('.rate:checked').val());
    giveRate(e.target.dataset.id)
})
$("#updateRateBtn").click(function(e){
    console.log($('.rate:checked').val());
    updateRate(e.target.dataset.id)
})
$("#removeRateBtn").click(function(e){
    console.log($('.rate:checked').val());
    deleteRate(e.target.dataset.id)
})
///////////////////////favorite Button //////////////////
$("#addToFavBtn").click(function(e){
    console.log($('.rate:checked').val());
    addToFav(e.target.dataset.id)
})
$("#removeFromFav").click(function(e){
    console.log($('.rate:checked').val());
    removeFromFav(e.target.dataset.id)
})
///////////////////////pagination Button //////////////////
document.getElementById("click1").addEventListener('click', function(){
    loadTopMovies(1);

})
document.getElementById("click2").addEventListener('click', function(){
    loadTopMovies(2);
})
document.getElementById("searchInput").addEventListener('keyup',function (e) {
    findMovie();
})
