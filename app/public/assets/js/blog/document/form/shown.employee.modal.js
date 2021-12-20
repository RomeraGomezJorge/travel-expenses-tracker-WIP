$(document).ready(function () {

    $('#create-employee-modal').on('show.bs.modal', function (event) {

        const urlToGetFormHtml = $(event.relatedTarget).data("employee_modal_url");

        const modalSelector = '#create-employee-modal';

        renderFormToHandleDataInModal(event, modalSelector, urlToGetFormHtml);
    });

});
