
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
            url: route('loadMovies'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + getCookie('jwt_token'));
            },
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
            url: route('findMovieApi', $("#movieTable_filter").val()),
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + getCookie('jwt_token'));
            },
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
                url: route('delete-movie',id),
                type: "delete",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + getCookie('jwt_token'));
                },
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


//------------------------------Categories Section----------------------------------//
function loadCategories() {
    const categoryBody = document.getElementById('categoryBody');
    categoryBody.innerHTML = '';
    $.ajax({
        url: route('load-categories'),
        type:"get",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer ' + getCookie('jwt_token'));
        },
        success: function(data) {
            console.log(data);
            for (let i=0; i<data.length; i++) {
                categoryBody.appendChild(printCategory(data[i]))

            }

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });



}

function findCategory() {
    const categoryBody = document.getElementById('categoryBody');
    categoryBody.innerHTML = '';
    if($("#categoryTable_filter").val()!==""){
        $.ajax({
            url: route('find-category',$("#categoryTable_filter").val()),
            type:"get",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + getCookie('jwt_token'));
            },
            success: function(data) {
                console.log(data);
                for (let i=0; i<data.length; i++) {
                    categoryBody.appendChild(printCategory(data[i]))

                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }else {
        loadCategories();
    }


    // Clear the container element's contents

}

function updateCategory(id) {

    $.ajax({
            url: route('update-category',id),
            type:"put",
            data:{'name':$("#newName").val()},
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + getCookie('jwt_token'));
            },
            success: function(data) {
                console.log(data);
                Swal.fire(
                    'Good job!',
                    'Category has been  updated successfully',
                    'success'
                )
                loadCategories()
                $("#updateModal").modal('hide');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });



    // Clear the container element's contents

}
function insertCategory() {

    $.ajax({
        url: route('add-category'),
        type:"post",
        data:{'name':$("#categoryName").val()},
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer ' + getCookie('jwt_token'));
        },
        success: function(data) {
            console.log(data);
            Swal.fire(
                'Good job!',
                'Category has been  Added successfully',
                'success'
            )
            loadCategories()
            hideNewCategoryContainer()
            $("#updateModal").modal('hide');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            if (jqXHR.status === 422) {
                 const errors = jqXHR.errors;
                const firstError = Object.values(errors)[0][0];
                Swal.fire(
                    'Error',
                    'Please check the category name must be less than 255 characters',
                 );
            } else if (jqXHR.status === 409) {
                 const message = jqXHR.error;
                Swal.fire(
                    'Error',
                    'This category already exists',
                    'error this category already exists'
                );
            } else {
                // Handle other errors
                console.log(textStatus, errorThrown);
                Swal.fire(
                    'Error',
                    'An error occurred while adding the category. Please try again later.',
                 );
            }
        }
    });



    // Clear the container element's contents

}
function deleteCategory(id){
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
                url: route('delete-category',id),
                type: "delete",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + getCookie('jwt_token'));
                },
                success: function(data) {
                    console.log(data);
                    loadCategories();
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'the Category has been deleted.',
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
function printCategory(category){
    const tr = document.createElement('tr');
    const td1 = document.createElement('td');
    const updateBtn = document.createElement('button');
    const deleteBtn = document.createElement('button');
    updateBtn.classList.add('btn', 'btn-primary');
    updateBtn.textContent='update'
    updateBtn.onclick =()=>openModal(category)
    deleteBtn.classList.add('btn', 'btn-danger');
    deleteBtn.textContent='delete'
    deleteBtn.onclick = () => deleteCategory(category.id)
    td1.appendChild(document.createTextNode(category.id));
    tr.appendChild(td1);
    const td2 = document.createElement('td');
    td2.appendChild(document.createTextNode(category.name));
    tr.appendChild(td2);
    const td3 = document.createElement('td');
    td3.appendChild(document.createTextNode(category.created_at.substring(0,10)));
    tr.appendChild(td3);
    const td6= document.createElement('td');
    td6.appendChild(updateBtn);
    tr.appendChild(td6);
    const td7= document.createElement('td');
    td7.appendChild(deleteBtn);
    tr.appendChild(td7);
    return tr;
}
function showNewCategoryContainer(){
    $("#newMovieContainer").removeClass('d-none')
}
function hideNewCategoryContainer(){
    $("#newMovieContainer").addClass('d-none')
    $("#categoryName").val('');
}

function  openModal(category){
    $("#updateModal").modal('show');
    $("#newName").val(category.name);
    $("#modalfooter").html(`
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Close</button>
         <button type="button" class="btn btn-primary" onclick="updateCategory(${category.id})">Save changes</button>
    `)
}
function closeModal() {
    $("#updateModal").modal('hide');
}
//------------------------------End Categories Section----------------------------------//
//------------------------------start Actor Section----------------------------------//
function loadActors() {
    const actorBody = document.getElementById('actorBody');
    actorBody.innerHTML = '';
    $.ajax({
        url: route('loadactors'),
        type:"get",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer ' + getCookie('jwt_token'));
        },
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
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + getCookie('jwt_token'));
            },
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
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + getCookie('jwt_token'));
                },
                success: function(data) {
                    console.log(data);
                    loadActors();
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
//------------------------------start  User Section----------------------------------//
function loadUsers() {
    const userBody = document.getElementById('userBody');
    userBody.innerHTML = '';
    $.ajax({
        url: route('get-users',$("#role").val()),
        type:"get",
        data:{
            'name':$('#userTable_filter').val()
        },

        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer ' + getCookie('jwt_token'));
        },
        success: function(data) {
            console.log(data);
            for (let i=0; i<data.length; i++) {
                userBody.appendChild(printUser(data[i]))

            }

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR,textStatus, errorThrown);
        }
    });



}


function deleteUser(id){
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
                url: route('delete-users',id),
                type: "delete",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + getCookie('jwt_token'));
                },
                success: function(data) {
                    console.log(data);
                    loadUsers();
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
function updateUserRole(id) {

    $.ajax({
        url: route('assignRole',id),
        type:"put",
        data:{'role':$("#user-role").val()},
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer ' + getCookie('jwt_token'));
        },
        success: function(data) {
            console.log(data);
            Swal.fire(
                'Good job!',
                'Role has been  updated successfully',
                'success'
            )
           loadUsers()
            $("#updateModal").modal('hide');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });



    // Clear the container element's contents

}
function  openUserModal(user){
    $("#updateModal").modal('show');
    $("#userName").val(user.name);
    $("#user-role").val($("#role").val())
    $("#modalfooter").html(`
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Close</button>
         <button type="button" class="btn btn-primary" onclick="updateUserRole(${user.id})">Save changes</button>
    `)
}
function printUser(user){
    const tr = document.createElement('tr');
    const td1 = document.createElement('td');
    const updateBtn = document.createElement('button');
    const deleteBtn = document.createElement('button');

    updateBtn.classList.add('btn', 'btn-primary');
    updateBtn.textContent='update permission'
    updateBtn.onclick =()=>openUserModal(user)

    deleteBtn.classList.add('btn', 'btn-danger');
    deleteBtn.textContent='delete user'
    deleteBtn.onclick =()=>deleteUser(user)

    td1.appendChild(document.createTextNode(user.name));
    tr.appendChild(td1);
    const td2 = document.createElement('td');
    td2.appendChild(document.createTextNode(user.email));
    tr.appendChild(td2);
    const td3 = document.createElement('td');
    td3.appendChild(document.createTextNode(user.created_at.substring(0,10)));
    tr.appendChild(td3);

    const td6= document.createElement('td');
    td6.appendChild(updateBtn);
    tr.appendChild(td6);

    const td7= document.createElement('td');
    td7.appendChild(deleteBtn);
    tr.appendChild(td7);
     return tr;
}
