$(document).ready(function () {
    $('select').select2({closeOnSelect: false,placeholder: '- '+ Translator.trans('Required')+ ' -'});

    $('#travel_departureDate').on('focusout',function () {
        calculateTravelCost();
    });

    $('#travel_arrivalDate').on('focusout',function () {
        calculateTravelCost();
    });

    $('#travel_tripDestinations').on('select2:close',function () {
        calculateTravelCost();
    });

});
function calculateTravelCost() {

    if ($('#travel_departureDate').val() === ''){
        return false;
    }

    if ($('#travel_arrivalDate').val() === ''){
        return false;
    }

    if ($("#travel_tripDestinations").val().length != 1 ){
        return false;
    }

    const departureDate = new Date($('#travel_departureDate').val());
    const arrivalDate = new Date($('#travel_arrivalDate').val());
    const diffTime = Math.abs(arrivalDate - departureDate);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

    const locationCost = $("#travel_tripDestinations").select2().find(":selected").data("cost");

    let travelCost = diffDays * locationCost;

    $('#travel_expenses').val(travelCost);
}
