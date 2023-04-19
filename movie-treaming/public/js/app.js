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


function openMovie(id){
    window.open(route('movieDetail',id));
}
 //movie section

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
 ///////////////////////Favorite Function////////////////////////
function addToFav(id){


    $.ajax({
        url:route('add-favorite',getId()),
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
            console.log(data)
            $("#btnConatiner").html(" ")
            const btn=createButton('btn-danger',"Remove from Favorites")
            btn.onclick = () => removeFromFav(id);
            $("#btnConatiner").append(btn);

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR,textStatus, errorThrown);
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


 function getId() {
     var d;
     $.ajax({
         url: route('getId'),
         type: "GET",
         async: false,
         success: function(data) {
                 d=data
         },
         error: function(xhr, status, error) {
             console.log("Error: " + error);
         }
     });
     return d;
 }
