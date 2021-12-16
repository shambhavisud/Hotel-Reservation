$(function () {
    $("#checkIn").datepicker({minDate:0, dateFormat: "dd-mm-yy"});
    $("#checkOut").datepicker({minDate:0, dateFormat: "dd-mm-yy"});
});

$(function(){
    $("#checkIn").change(function(){
        var date = new Date();
        date = $("#checkIn").datepicker("getDate");
        var day = date.getDate() + 1;
        date.setDate(day);
        $("#checkOut").datepicker("option","minDate",date);
    });
});