function addFilter(e) {
    e.preventDefault();
    const filters = document.getElementById('filters');
    const filterRows = document.getElementById('filter-rows');
    const totalRows = document.getElementById('filter-rows').childElementCount + 1;
    const filterRowTemplate = "<div class=\"form-group\">" +
        filters.innerHTML.replace('filters[0][field]',  "filters["+totalRows+"][field]")
            .replace('filters[0][operator]',  "filters["+totalRows+"][operator]")
            .replace('filters[0][value]',  "filters["+totalRows+"][value]")
            .replace(/data-index="0"/g, 'data-index="' + totalRows + '"') +
        "   <div class=\"clearfix\"></div>" +
        "   <button type=\"button\" onclick=\"removeFilter(this)\" class=\"remove_button btn btn-focus ml-2 mb-3\">" +
        "      <i class=\"fas fa-times-circle text-danger\"></i>  " +
        "     " + Translator.trans('Remove Filter') +
        "   </button>" +
        "</div>";

    filterRows.insertAdjacentHTML('beforeend', filterRowTemplate);

    $('[name="filters['+totalRows+'][field]"]').change();

    ensureThatEntityFilterCanBeSelectedOnlyOnce();
}

 function removeFilter(selector){
     selector.parentNode.remove();

     ensureThatEntityFilterCanBeSelectedOnlyOnce();
 }