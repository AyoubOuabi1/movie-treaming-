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
/*data:{
    name:$("#movieName").val(),
        realased_date:$("#realased_date").val(),
        type:"movie",
        description:$("#description").val(),
        duration:$("#duration").val(),
        cover_image:$("#cover_image").val(),
        trailer_video:$("#trailer_video").val(),
        languages:$("#languages").val(),
        directorId:$("#directorId").val(),
        categoryIds:getcategoryIdsChecked(),
        actorsIds:getactorsIdsChecked()
},*/
function insertMovie() {

    console.log($("#server_link").val()+"////"+$("#realased_date").val() +"////"+ $("#description").val()+"////"+$("#duration").val() +"////"+
        $("#cover_image").val()+"////"+ $("#trailer_video").val()+"////"+$("#languages").val() +"////"+ getcategoryIdsChecked()+"////");
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


        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR,textStatus, errorThrown);
        }
    });

    // Clear the container element's contents

}
function getMovieDataForInsert(){
    let formData = new FormData();
    formData.append('name',$("#movieName").val());
    formData.append('realased_date',$("#realased_date").val());
    formData.append('server_link',$("#server_link").val());
    formData.append('type',"movie");
    formData.append('description',$("#description").val());
    formData.append('duration',$("#duration").val());
    formData.append('cover_image',$("#cover_image").val());
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
