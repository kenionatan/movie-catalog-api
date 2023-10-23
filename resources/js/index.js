$(function () {
    $.ajax({
        url: '/api/movie/get',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            $('.movie-content').html(JSON.stringify(data));
        }
    });
});