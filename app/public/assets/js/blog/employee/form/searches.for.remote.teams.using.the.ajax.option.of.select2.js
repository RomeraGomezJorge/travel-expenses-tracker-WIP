$(document).ready(function () {
    const url = $("#ajax").data('url_to_search_learning_support_team');
    $("#ajax").select2({
        width: 'resolve',
        ajax: {
            url: url,
            dataType: 'json',
            multiple: true,
            delay: 500,
            data: function (params) {
                return {
                    name: params.term // search term
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {

                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        },
        language: "es",
        theme: 'bootstrap4',
        placeholder: Translator.trans('Search for a learning support team'),
        minimumInputLength: 2,
    });
});