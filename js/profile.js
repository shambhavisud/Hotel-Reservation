$(function () {
    var obj = {};
    var myJSON = JSON.stringify(obj);

    $.ajax({
        url: "php/getBookings.php",
        dataType: "html",
        type: 'POST',
        data: myJSON,
        success: function (data) {
            $("#result").html(data);
        }
    });

    $.ajax({
        url: "php/getReviews.php",
        dataType: "html",
        type: 'POST',
        data: myJSON,
        success: function (data) {
            $("#reviewResults").html(data);
        }
    });

    $.ajax({
        url: "php/getFavorites.php",
        dataType: "html",
        type: 'POST',
        data: myJSON,
        success: function (data) {
            $("#favoriteResults").html(data);
        }
    });

});

function goToRoom(name) {
    window.location.href = "room.php?name=" + name;
}