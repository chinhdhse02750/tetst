if(window.location.search.substring(1)){
    let sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;
    if(sURLVariables){
        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');
            let filterKey = decodeURIComponent(sParameterName[0]),
                filterValue = sParameterName[1],
                checkboxFilter = $("input[name = "+"'"+filterKey+"'"+"][value = "+filterValue+"]"),
                nameFilter = checkboxFilter.data('name');
            $(checkboxFilter).prop('checked', true);
            if(filterKey !== 'area'
                && !$(checkboxFilter).hasClass('check-all')
                && filterKey !== 'order_by'
                && filterKey !== 'search'
                && filterKey !== 'page'
            ){
                let filterBtn = '<div class="mix__filter-button button__filter-selected" id="' + filterKey + '">' + nameFilter +
                    '                        <a href="javascript:void(0)" class="mix__filter-erase xClose" id="remove_' + filterKey + '" data-filter-key="' + filterKey + '" data-filter-id="' + filterValue + '">\n' +
                    '                            <svg id="xClose" xmlns="http://www.w3.org/2000/svg" width="8.985" height="8.985" viewBox="0 0 8.985 8.985">\n' +
                    '                                <path d="M.422.422a.5.5,0,0,0,0,.707L8.407,9.113a.5.5,0,0,0,.707-.707L1.128.422a.5.5,0,0,0-.707,0Z" transform="translate(-0.275 -0.275)" fill-rule="evenodd"/>\n' +
                    '                                <path d="M9.113.422a.5.5,0,0,1,0,.707L1.128,9.113a.5.5,0,1,1-.707-.707L8.406.422a.5.5,0,0,1,.707,0Z" transform="translate(-0.275 -0.275)" fill-rule="evenodd"/>\n' +
                    '                            </svg>\n' +
                    '                        </a>\n' +
                    '                    </div>';

                $('#filter-selected').append(filterBtn);
            }

            if(filterKey === 'search'){
                addSearchInput();
            }
            if(filterKey === 'order_by'){
                addSortOrder();
            }

        }
    }
    //remove display search condition
    $(".xClose").on('click', function(){
        let value = $(this).data("filterId");
        let name = $(this).data("filterKey");
        $("input[name = "+"'"+name+"'"+"][value = "+value+"]").prop('checked', false);
        $(this).parent().remove();
        $("#filter_form").submit();
    });
} else {
    $(".check-all").prop('checked', true);
}

$('#selectOrderBy').on('change', function () {
    addSortOrder();
    $("#filter_form").submit();
});

$('#filter_form').find('input').on('change', function () {
    $("#filter_form").submit();
});

unCheckAll('#checkAllHeight', '.check_height');
unCheckAll('#checkAllAge', '.check_age');
unCheckAll('#checkAllCup', '.check_cup');
unCheckAll('#checkAllDatingType', '.dating_type');
unCheckAll('#checkAllRank', '.rank');
unCheckAll('#checkAllMaleSmoking', '.smoking');
unCheckAll('#checkAllArea', '.prefecture');

// uncheck all filter
function unCheckAll( checkAll, targetChecker) {
    $(targetChecker).on('click', function(event) {
        $(checkAll).each(function() {
            this.checked = false;
        });
    });
    $(checkAll).on('click', function(event) {
        $(targetChecker).each(function() {
            this.checked = false;
        });
    });
}

// add input sort order to filter form submit
function addSortOrder(){
    let sortInput = $("#selectOrderBy")
    $("#filter_form").submit( function() {
        $(sortInput).appendTo("#filter_form");
        return true;
    });
}

//add search input to filter form submit
function addSearchInput(){
    let search = $("#search-input")
    $("#filter_form").submit( function() {
        $(search).appendTo("#filter_form");
        return true;
    });
}

// show list checkbox in dropdown
function showDropdown( dropdownId, checkbox) {
    if($(checkbox).is(":checked")){
        if (checkbox === '.prefecture'){
            let checkboxInput = $(checkbox).toArray();
            for(let i=0; i<$(checkboxInput).length; i++){
                if($(checkboxInput[i]).is(':checked')){
                    let groupCheckbox = $(checkboxInput[i]).parent().parent().attr('id');
                    $('.'+groupCheckbox).addClass('show');
                }
            }
        } else {
            $(dropdownId).addClass('show');
        }
    }
}

showDropdown('#filterItemArea', '.prefecture');
showDropdown('#filterItemAge', '.check_age');
showDropdown('#filterItemBustCup', '.check_cup');
showDropdown('#filterItemHeight', '.check_height');
showDropdown('#filterItemDating', '.dating_type');
showDropdown('#filterItemRank', '.rank');
showDropdown('#filterItemSmoking', '.smoking');
showDropdown('#filterItemAlcohol', '.alcohol');

$('.area-filter').on('click', function () {
    let areaId = $(this).attr('id');
    let inputFilter = $('input[value='+areaId+']');
    
    let url = encodeURIComponent(inputFilter.attr('name'));
    window.location.href = '/' + '?' +  url + '=' + areaId;

    $('input.prefecture').prop('checked', false);
    $('#checkAllArea').prop('checked', false);
    $("#filter_form").submit( function() {
        $(inputFilter).appendTo("#filter_form");
        return true;
    });
    $("#filter_form").submit();
})
