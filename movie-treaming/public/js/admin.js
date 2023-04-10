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
function findMovie(){
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
            confirmButton: 'btn btn-success mr-3',
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
        //getActors();

    }
}
/*function getActors() {
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
}*/
//------------------------------End Actors Section----------------------------------//

//------------------------------Categories Section----------------------------------//


//------------------------------End Categories Section----------------------------------//
//------------------------------start Actor Section----------------------------------//
function loadActors() {
    const actorBody = document.getElementById('actorBody');
    actorBody.innerHTML = '';
    $.ajax({
        url: "http://localhost:8000/api/actors",
        type:"get",
        dataType: "json",
        success: function(data) {
            console.log(data);
            for (let i=0; i<data.length; i++) {
                actorBody.appendChild(printActor(data[i]))

            }

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });



}

function findActor() {
    const actorBody = document.getElementById('actorBody');
    actorBody.innerHTML = '';
    if($("#actoreTable_filter").val()!==""){
        $.ajax({
            url: route('find-actor',$("#actoreTable_filter").val()),
            type:"get",
            dataType: "json",
            success: function(data) {
                console.log(data);
                for (let i=0; i<data.length; i++) {
                    actorBody.appendChild(printActor(data[i]))

                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }else {
        loadActors();
    }


    // Clear the container element's contents

}
function deleteActor(id){
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ',
            cancelButton: 'btn btn-danger mr-3'
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
                url: route('delete-actor',id),
                type: "delete",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    loadTopMovies();
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'the actor has been deleted.',
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
function printActor(actor){
    const tr = document.createElement('tr');
    const td1 = document.createElement('td');
    const img = document.createElement('img');
    const updateBtn = document.createElement('button');
    const deleteBtn = document.createElement('button');
    updateBtn.classList.add('btn', 'btn-primary');
    updateBtn.textContent='update'
    updateBtn.onclick =function (){
        location.href=route('update-actor', actor.id)
    }
    deleteBtn.classList.add('btn', 'btn-danger');
    deleteBtn.textContent='delete'
    deleteBtn.onclick = () => deleteActor(actor.id)
    img.classList.add('rounded-circle', 'me-2');
    img.width = '50';
    img.height = '50';
    img.src = actor.actor_image;
    td1.appendChild(img);
    td1.appendChild(document.createTextNode(actor.full_name));
    tr.appendChild(td1);
    const td2 = document.createElement('td');
    td2.appendChild(document.createTextNode(actor.born_in));
    tr.appendChild(td2);
    const td3 = document.createElement('td');
    td3.appendChild(document.createTextNode(actor.nationality));
    tr.appendChild(td3);
    const td4 = document.createElement('td');
    td4.appendChild(document.createTextNode(actor.role));
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

//------------------------------end  Actor Section----------------------------------//
