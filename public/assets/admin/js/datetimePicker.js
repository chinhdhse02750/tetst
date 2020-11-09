$(document).ready(function () {
    let formatDatetime = 'Y-m-d';

    $('#expired').datetimepicker({
        format: formatDatetime,
        timepicker: false,
        minDate: 0
    });

    $('#birthday').datetimepicker({
        format: formatDatetime,
        timepicker: false,
        maxDate: 0
    });

    $('#date-from').datetimepicker({
        format: formatDatetime,
        onShow: function (ct) {
            this.setOptions({
                maxDate: $('#date-to').val() ? $('#date-to').val() : false
            })
        },
        timepicker: false
    });
    $('#date-to').datetimepicker({
        format: formatDatetime,
        onShow: function (ct) {
            this.setOptions({
                minDate: $('#date-from').val() ? $('#date-from').val() : false
            })
        },
        timepicker: false
    });
});
