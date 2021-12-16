$(function () {
    var city = $('#postCity').attr("value");
    if (city == "Mumbai") {
        $('#city option:eq(1)').prop("selected", true);
    } else if (city == "Chennai") {
        $('#city option:eq(2)').prop("selected", true);
    } else if (city == "Noida") {
        $('#city option:eq(3)').prop("selected", true);
    } else if (city == "Kolkata") {
        $('#city option:eq(4)').prop("selected", true);
    }

    var roomType = $('#postRoomType').attr("value");
    if (roomType == 1) {
        $('#roomType option:eq(1)').prop("selected", true);
    } else if (roomType == 2) {
        $('#roomType option:eq(2)').prop("selected", true);
    } else if (roomType == 3) {
        $('#roomType option:eq(3)').prop("selected", true);
    } else if (roomType == 4) {
        $('#roomType option:eq(4)').prop("selected", true);
    }

    // When select box value changes
    $('#city').change(function () {
        search(false);
    });

    $('#CountOfGuests').change(function () {
        search(false);
    });

    $('#roomType').change(function () {
        search(false);
    });

    // When the slider change get min max values and search for rooms
    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 10000,
        values: [0, 10000],
        slide: function (event, ui) {
            $("#min").val(ui.values[0] + ' ₹');
            $("#max").val(ui.values[1] + ' ₹');
            search(true);
        }
    });
    $("#min").val($("#slider-range").slider("values", 0) + ' ₹');
    $("#max").val($("#slider-range").slider("values", 1) + ' ₹');
});

function goToRoom(name) {
    var checkIn = $('#checkIn').val();
    var checkOut = $('#checkOut').val();
    if ($("#checkIn").val() !== "" && $("#checkOut").val() !== "") { // if check in and check out are not blank
        window.location.href = "room.php?name=" + name + "&checkIn=" + checkIn + "&checkOut=" + checkOut;
    } else {
        alert("You need to assign check in and check out values to continue.");
    }
}

function search(slider) {
    var city = document.getElementById("city").value;
    var roomType = document.getElementById("roomType").value;
    var CountOfGuests = document.getElementById("CountOfGuests").value;
    var minWithEuro = document.getElementById("min").value;
    var minWithoutEuro = minWithEuro.split(" ");
    var min = minWithoutEuro[0];

    var maxWithEuro = document.getElementById("max").value;
    var maxWithoutEuro = maxWithEuro.split(" ");
    var max = maxWithoutEuro[0];
    var obj = { "city": city, "roomType": roomType, "CountOfGuests": CountOfGuests, "min": min, "max": max };
    var myJSON = JSON.stringify(obj);
    $.ajax({
        url: "php/getResults.php",
        dataType: "html",
        type: 'POST',
        data: myJSON,
        success: function (data) {
            if(slider) {
                $("#result").html(data);
            } else {
                $("#result").hide().html(data).fadeIn("slow");
            }
        }
    });
}