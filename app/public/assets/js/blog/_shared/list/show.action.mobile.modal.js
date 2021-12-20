$(document).ready(function () {

    $('#mobile-actions-modal').on('show.bs.modal', function (event) {
        const modal_title = $(event.relatedTarget).data("modal_title");
        const edit_path = $(event.relatedTarget).data("edit_path");
        const formActionAttributeToDelete = $(event.relatedTarget).data("form_action_attribute_to_delete");
        const confirmationMessageToDelete = $(event.relatedTarget).data("confirmation_message_to_delete");

        /* Establece el titulo del modal*/
        $('#modal-title').html(modal_title);

        /* Establece la url que permite actualizar un registro*/
        $('#edit-mobile').attr('href', edit_path);

        $('#mobile-delete-button').attr('data-form_action_attribute_to_delete', formActionAttributeToDelete);
        $('#mobile-delete-button').attr('data-confirmation_message_to_delete', confirmationMessageToDelete);

    });

    $('#delete-confirmation-modal').on('show.bs.modal', function (event) {
        $('#mobile-actions-modal').modal('hide');
    });
});


