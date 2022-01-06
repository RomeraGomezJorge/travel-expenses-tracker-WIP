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
    let diffDays = 1;

    if ($('#travel_departureDate').val() === ''){
        return false;
    }

    if ($('#travel_arrivalDate').val() === ''){
        return false;
    }

    if ($("#travel_tripDestinations").val().length != 1 ){
        return false;
    }

    if( $('#travel_arrivalDate').val() !== $('#travel_departureDate').val()){
        const departureDate = new Date($('#travel_departureDate').val());
        const arrivalDate = new Date($('#travel_arrivalDate').val());
        const diffTime = Math.abs(arrivalDate - departureDate);
        diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

    }

    const locationCost = $("#travel_tripDestinations").select2().find(":selected").data("cost");

    let travelCost = diffDays * locationCost;

    $('#travel_expenses').val(travelCost);
}
