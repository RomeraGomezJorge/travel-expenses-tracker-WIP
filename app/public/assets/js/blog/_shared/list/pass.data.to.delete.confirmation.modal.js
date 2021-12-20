$('.delete').on('click', function (e) {

    e.preventDefault();

    const formActionAttributeToDelete =$(this).data('form_action_attribute_to_delete');

    const confirmationMessageToDelete = $(this).data('confirmation_message_to_delete');

    $('#delete-confirmation-form').attr('action', formActionAttributeToDelete);

    $('#message-to-delete-confirmation').html(confirmationMessageToDelete);

});
