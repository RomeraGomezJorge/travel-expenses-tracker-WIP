$(document).ready(function () {

    $('#create-document-category-modal').on('show.bs.modal', function (event) {

        const urlToGetFormHtml = $(event.relatedTarget).data("document_category_modal_url");

        const modalSelector = '#create-document-category-modal';

        renderFormToHandleDataInModal(event, modalSelector, urlToGetFormHtml);
    });

});
