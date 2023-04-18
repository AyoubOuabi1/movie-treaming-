function getCookie(name) {
    var cookies = document.cookie.split('; ');
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].split('=');
        if (cookie[0] === name) {
            return cookie[1];
        }
    }
    return null;
}
$(window).scroll(function () {
    var scroll = $(window).scrollTop();
    if (scroll > 10) {
        $("nav").removeClass("bg-transparent")
        $("nav").css({
            background: "#1f2937",

            transition: ".3s"
        });
    } else {
        $("nav").addClass("bg-transparent");
     }
});
loadTopMovies();
function openMovie(id){
    window.open(route('movieDetail',id));
}
function changeHomeCoverBg(movie){
    $("#yearr").html(movie.realased_date)
    $("#duration").html(movie.duration+' min')
    $("#poster_slider").attr('src',movie.poster_image)
    document.getElementById('homeCoverContainer').style.background="url('"+movie.cover_image+"')";
    document.getElementById('homeCoverContainer').style.backgroundSize="100% 100%";
    document.getElementById('homeCoverContainer').style.backgroundRepeat="no-repeat";
    movie.categories.forEach(function(category) {
       document.getElementById('categories').innerHTML+=`<h6 class="rounded p-1" style="border: gold 1px solid"> ${category.name} </h6>`
    });
    $("#movieTtl").html(movie.name)
    $("#movieDesc").html(movie.description.substring(0,80)+"...")

}
//movie section
function loadTopMovies() {
    const topMoviesContainer = document.getElementById('topMovies');
    if(topMoviesContainer){
        topMoviesContainer.innerHTML = '';
        $.ajax({
            url: route('loadMovies'),
            type:'get',
            dataType: "json",
            success: function(data) {
                console.log(data);
                changeHomeCoverBg(data[0]);
                 data.forEach(function(movie) {

                    topMoviesContainer.appendChild(printMovies(movie));
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
             }
        });
    }else{
        console.log(topMoviesContainer)
    }

}

function findMovie(){
    const dropdownMenu=document.getElementById('searchReuslt')
    // Clear the container element's contents
    dropdownMenu.innerHTML = '';
    if($("#searchInput").val()!==""){
        $.ajax({
            url: route('find-Movie',$("#searchInput").val()),
            dataType: "json",
            success: function(data) {
                dropdownMenu.innerHTML = '';
                 data.forEach(function(movie) {

                    dropdownMenu.appendChild(printMovieForSearch(movie));
                });

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
             }
        });
    }else {
        console.log("null")
    }

}
function printMovieForSearch(movie){

    const a = document.createElement('a');
     a.classList.add('dropdown-item', 'd-flex', 'align-items-center');
    a.onclick = function() { openMovie(movie.id); };
    const div1 = document.createElement('div');
    div1.classList.add('dropdown-list-image', 'me-3');
    const img = document.createElement('img');
    img.classList.add('rounded-circle');
    img.height='30';
    img.width='30';
    img.src = movie.poster_image;
    div1.appendChild(img);
    const div2 = document.createElement('div');
    div2.classList.add('fw-bold');
    const div2_child1 = document.createElement('div');
    div2_child1.classList.add('text-truncate');
    const span = document.createElement('span');
    span.textContent = movie.name;
    div2_child1.appendChild(span);
    div2.appendChild(div2_child1);
    const p = document.createElement('p');
    p.classList.add('small', 'text-gray-500', 'mb-0');
    p.textContent = movie.description.substring(0, 30) + '...';
    div2.appendChild(p);
    a.appendChild(div1);
    a.appendChild(div2);
    return a;


}
function printMovies(movie){
    const movieContainer = document.createElement('div');
    movieContainer.classList.add('col-lg-2', 'col-md-3', 'col-6');
    const cardContainer = document.createElement('div');
    cardContainer.classList.add('card', 'mb-3','text-white');
    cardContainer.style.backgroundColor="#181F3B"
    const imageElement = document.createElement('img');
    imageElement.classList.add('card-img-top');
    imageElement.src = movie.poster_image;
    imageElement.alt = 'Movie poster';
    imageElement.height='200'

    const cardBodyElement = document.createElement('div');
    cardBodyElement.classList.add('card-body','d-flex','flex-column');
    cardBodyElement.style.height="150px"

    const titleElement = document.createElement('h5');
    titleElement.classList.add('card-title');
    titleElement.textContent = movie.name.substring(0,17);

    const watchNowElement = document.createElement('a');
    watchNowElement.href = '#';
    watchNowElement.onclick = () => openMovie(movie.id);
    watchNowElement.classList.add('btn', 'btn-primary','mt-auto');
    watchNowElement.textContent = 'Watch Now';
     // Append the HTML elements to the appropriate parent elements
    cardContainer.appendChild(imageElement);
    cardBodyElement.appendChild(titleElement);
     cardBodyElement.appendChild(watchNowElement);
    cardContainer.appendChild(cardBodyElement);
    movieContainer.appendChild(cardContainer);
    return movieContainer;

}
///////////////////////Favorite Function////////////////////////
function addToFav(id){


    $.ajax({
        url:route('add-favorite'),
        type: 'post',
        data:{
            'movie_id': id,
        },
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer ' + getCookie('jwt_token'));
        },
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
        url: route('delete-favorite',id),
        type: 'delete',
        data:{
            'movie_id': id,
        },
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer ' + getCookie('jwt_token'));
        },
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

     $.ajax({

        url: route('add-rate'),
        type: 'post',
        data:{
            'movie_id': id,
            'stars':$('.rate:checked').val()

        },
        dataType: "json",
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         beforeSend: function (xhr) {
             xhr.setRequestHeader('Authorization', 'Bearer ' + getCookie('jwt_token'));
         },
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
         }
    });
}
function updateRate(id){

     $.ajax({

        url: route('update-rate'),
        type: 'put',
        data:{
            'movie_id': id,
            'stars':$('.rate:checked').val()

        },
        dataType: "json",
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         beforeSend: function (xhr) {
             xhr.setRequestHeader('Authorization', 'Bearer ' + getCookie('jwt_token'));
         },
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
         }
    });
}

function deleteRate(id){

     $.ajax({

        url: route('delete-rate',id),
        type: "delete",
        dataType: "json",
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         beforeSend: function (xhr) {
             xhr.setRequestHeader('Authorization', 'Bearer ' + getCookie('jwt_token'));
         },
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
         }
    });
}




document.getElementById("searchInput").addEventListener('keyup',function (e) {
    findMovie();
})
