import './bootstrap';
loadMovies();
function loadMovies() {
    $.ajax({
        url: "https://yts.torrentbay.to/api/v2/list_movies.json",
        dataType: "json",
        success: function(data) {
            console.log(data);
            // Do something with the data returned by the API
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            // Handle any errors that occur while making the request
        }
    });

}
