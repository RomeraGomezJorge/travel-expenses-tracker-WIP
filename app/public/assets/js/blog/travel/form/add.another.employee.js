$(document).ready(function () {

    $('.add-another-collection-widget').click(function (e) {
        var list = jQuery(jQuery(this).attr('data-list-selector'));
        // Try to find the counter of the list or use the length of the list
        var counter = list.data('widget-counter') || list.children().length;

        // grab the prototype template
        var newWidget = list.attr('data-prototype');
        // replace the "__name__" used in the id and name of the prototype
        // with a number that's unique to your emails
        // end name attribute looks like name="contact[emails][2]"
        newWidget = newWidget.replace(/__name__/g, counter);

        // Increase the counter
        counter++;
        // And store it, the length cannot be used if deleting widgets is allowed
        list.data('widget-counter', counter);

        // create a new list element and add it to the list
        var newElem = jQuery(list.attr('data-widget-tags')).html(newWidget);
        newElem.appendTo(list);

        //Add some styles
        newElem.find('[id^="travel_travellersNames_"]').addClass('row col-12').find('.form-group').addClass('mr-2 col-4');

        //Add remove button
        newElem.find('[id^="travel_travellersNames_"]').append(
            '<div class="col-2">'+
            '  <button  type="button" class="remove_button btn btn-danger btn-border font-weight-bold mt-4">' +
            '     <i class="fas fa-times-circle "></i> ' +
            '  </button>'+
            '</div>');

        //Apply select2 in new fields
        $('select[name*="employee"]').select2({ placeholder: '- ' + Translator.trans('Required') + ' -'});
        $('select[name*="replacement"] ').select2({placeholder: '- ' + Translator.trans('Optional') + ' -'});

        //force focus on the new travellers name
        counter--;
        $('#travel_travellersNames_'+counter+'_employee').select2('open');
    });


    //Once remove button is clicked
    $('body').on('click', '.remove_button', function (e) {
        e.preventDefault();
        $(this).parent().parent().remove();//Remove field html
    });

});