loadTopMovies()
$(document).ready(function() {
    $('.directorId').select2({
        placeholder: 'Select an director'

    });
    $('.categoryId').select2({
        placeholder: 'Select an Category'
    });
   // $('.categoryId').val(['2', '3']).trigger('change');

    $('.actorId').select2({
        placeholder: 'Select an Actor'
    });
});

function  printselected(){
    console.log($('.directorId').val());
    console.log($('.categoryId').val());
    console.log($('.actorId').val());
}

function openModal(){
    console
    $('#exampleModal').modal('show')
}
//------------------------------Movies Section----------------------------------//
function loadTopMovies( ) {
    const movieBody = document.getElementById('movieBody');
    if(movieBody){
        movieBody.innerHTML = '';
        $.ajax({
            url: "http://localhost:8000/api/movies",
            dataType: "json",
            success: function(data) {
                console.log(data);

                // Loop through each movie object in the response data
                data.forEach(function(movie) {
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
    const updateBtn = document.createElement('button');
    const deleteBtn = document.createElement('button');
    updateBtn.classList.add('btn', 'btn-primary');
    updateBtn.textContent='update'
    updateBtn.onclick =function (){
        location.href=route('findMovie', movie.id)
    }
    deleteBtn.classList.add('btn', 'btn-danger');
    deleteBtn.textContent='delete'
    deleteBtn.onclick = () => deleteMovie(movie.id)
    img.classList.add('rounded-circle', 'me-2');
    img.width = '50';
    img.height = '50';
    img.src = movie.poster_image;
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
    td4.appendChild(document.createTextNode(movie.created_at.substring(0,10)));
    tr.appendChild(td4);
    const td5 = document.createElement('td');
    tr.appendChild(td5);
    const td6= document.createElement('td');
    td6.appendChild(updateBtn);
    tr.appendChild(td6);
    const td7= document.createElement('td');
    td7.appendChild(deleteBtn);
    tr.appendChild(td7);
    return tr;
}
function getMovie(){
    const movieBody = document.getElementById('movieBody');
    // Clear the container element's contents
    console.log($("#movieTable_filter").val());
    if($("#movieTable_filter").val()!==""){
        $.ajax({
            url: "http://localhost:8000/api/movie/" + $("#movieTable_filter").val(),
            dataType: "json",
            success: function(data) {
                movieBody.innerHTML = '';

                data.forEach(function(movie) {

                    movieBody.appendChild(printMovies(movie));
                });

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }else {
        console.log("null")
        loadTopMovies()
    }

}

function deleteMovie(id){
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "http://localhost:8000/api/movie/" +id,
                type: "delete",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    loadTopMovies();
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR,textStatus, errorThrown);
                }
            })

        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
            )
        }
    })

}
/*data:{
    name:$("#movieName").val(),
        realased_date:$("#realased_date").val(),
        type:"movie",
        description:$("#description").val(),
        duration:$("#duration").val(),
        poster_image:$("#poster_image").val(),
        trailer_video:$("#trailer_video").val(),
        languages:$("#languages").val(),
        directorId:$("#directorId").val(),
        categoryIds:getcategoryIdsChecked(),
        actorsIds:getactorsIdsChecked()
},*/

function insertMovie() {

    console.log($("#server_link").val()+"////"+$("#realased_date").val() +"////"+ $("#description").val()+"////"+$("#duration").val() +"////"+
        $("#poster_image").val()+"////"+ $("#trailer_video").val()+"////"+$("#languages").val() +"////"+ getcategoryIdsChecked()+"////");
    $.ajax({
        url: "http://localhost:8000/api/movie",
        type:"post",
        data:{
            'name':$("#name").val(),
            'realased_date':$("#realased_date").val(),
            'server_link':$("#server_link").val(),
            'type':"movie",
            'description':$("#description").val(),
            'duration':$("#duration").val(),
            'poster_image':$("#poster_image").val(),
            'cover_image':$("#cover_image").val(),
            'trailer_video':$("#trailer_video").val(),
            'languages':$("#languages").val(),
            'directorId':$("#directorId").val(),
            'categoryIds':getcategoryIdsChecked(),
            'actorsIds':getactorsIdsChecked()
        },
         dataType: "json",

        success: function(data) {
            console.log(data);
            Swal.fire(
                'Good job!',
                'Movie has been added!',
                'success'
            )

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR,textStatus, errorThrown);
        }
    });

    // Clear the container element's contents

}
function findMoviee() {
   // const url = "{{ route('findMovie', ':id') }}".replace(':id', id);
    //const url = route('findMovie', id)
    const url =route('findMovieApi',40)
    let actor_arr=[]
    let category_arr=[]
    $.ajax({
        url: url,
        type: "get",
        dataType: "json",
        success: function(data) {


            data.categories.forEach(function (moviee) {
                //actor_arr.push(moviee.categoryId)
                category_arr.push(moviee.id)
            })
            console.log(category_arr)
            $('.categoryId').val(category_arr).trigger('change');
            //$('.actorId').val(category_arr).trigger('change');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR,textStatus, errorThrown);
        }
    });
}
function getMovieDataForInsert(){
    let formData = new FormData();
    formData.append('name',$("#movieName").val());
    formData.append('realased_date',$("#realased_date").val());
    formData.append('server_link',$("#server_link").val());
    formData.append('type',"movie");
    formData.append('description',$("#description").val());
    formData.append('duration',$("#duration").val());
    formData.append('poster_image',$("#poster_image").val());
    formData.append('trailer_video',$("#trailer_video").val());
    formData.append('languages',$("#languages").val());
    formData.append('directorId',$("#directorId").val());
    formData.append('categoryIds',getcategoryIdsChecked());
    formData.append('actorsIds',getactorsIdsChecked());
    return formData;
}
function getactorsIdsChecked(){

    return $('.actorsIds:checked').map(function () {
        return this.value;
    }).get();

}
function getcategoryIdsChecked(){

    return $('.categoryIds:checked').map(function () {
        return this.value;
    }).get();

}
//------------------------------Movies update Section----------------------------------//


//------------------------------End Movies Section----------------------------------//
//------------------------------Actors Section----------------------------------//

function getActorsForMovies() {
    const actorBody = document.getElementById('actors_body_M');
    console.log($("#actorSearch").val());
    actorBody.innerHTML = '';
    if($("#actorSearch").val()!==""){
        $.ajax({
            url: "http://localhost:8000/api/actor/"+$("#actorSearch").val(),
            type:"get",
            dataType: "json",
            success: function(data) {
                console.log(data);

                data.forEach(function(actor) {

                    actorBody.appendChild(printActor(actor));
                });


            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }else{
        getActors();

    }
}
function getActors() {
    const actorBody = document.getElementById('actors_body_M');
    actorBody.innerHTML = '';
    $.ajax({
        url: "http://localhost:8000/api/actors",
        type:"get",
        dataType: "json",
        success: function(data) {
            console.log(data);
            for (let i=0; i<data.length; i++) {
                actorBody.appendChild(printActor(data[i]))
                if (i===3){
                    break
                }
            }

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });

    // Clear the container element's contents

}
function printActor(actor){
    const tr = document.createElement('tr');
    const td1 = document.createElement('td');
    td1.appendChild(document.createTextNode(actor.full_name));
    tr.appendChild(td1);
    const td2 = document.createElement('td');
    const input = document.createElement('input');
    input.type = 'checkbox';
    input.id = 'actor_'+actor.id;
    input.name = 'actorsIds';
    input.classList='actorsIds';
    input.value = actor.id;
    td2.appendChild(input);
    tr.appendChild(td2);
    return tr;
}
//------------------------------End Actors Section----------------------------------//

//------------------------------Categories Section----------------------------------//
function getCategoriesForMovies() {
    const categoryBody = document.getElementById('cat_body_M');
    console.log($("#categorySearch").val());
    categoryBody.innerHTML = '';
    if($("#categorySearch").val()!==""){
        $.ajax({
            url: "http://localhost:8000/api/category/"+$("#categorySearch").val(),
            type:"get",
            dataType: "json",
            success: function(data) {
                console.log(data);
                data.forEach(function(category) {
                    categoryBody.appendChild(printcategories(category));

                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }else{
            getCategories();

    }



}
function getCategories() {
    const categoryBody = document.getElementById('cat_body_M');
    categoryBody.innerHTML = '';
    $.ajax({
        url: "http://localhost:8000/api/categories",
        type:"get",
        dataType: "json",
        success: function(data) {
             for (let i=0; i<data.length; i++) {
                categoryBody.appendChild(printcategories(data[i]))
                if (i===3){
                    break
                }
            }

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });

    // Clear the container element's contents

}
function printcategories(category){
    const tr = document.createElement('tr');
    const td1 = document.createElement('td');
    td1.appendChild(document.createTextNode(category.name));
    tr.appendChild(td1);
    const td2 = document.createElement('td');
    const input = document.createElement('input');
    input.type = 'checkbox';
    input.id = 'category_'+category.id;
    input.name = 'categoryIds';
    input.classList = 'categoryIds';
    input.value = category.id;
    td2.appendChild(input);
    tr.appendChild(td2);
    return tr;
}
//------------------------------End Categories Section----------------------------------//
