$(document).ready(function () {
    $('#search-news').on('click', function (e) {
        let data = $('#search-news-form').serialize();
        let url = $('#search-news-form').attr('action');

        if ($("#search-news-form")[0].checkValidity()) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'GET',
                url: url,
                data: data,
                processData: false,
                contentType: false,
                success: function (data) {
                    $('#search-news-append').html(data);
                    $('#search-news').prop("disabled", false);
                    createDeleteButton();
                },
            });
        }
    });

    let formatDatetime = 'Y-m-d H:i';
    $('#date-from-news').datetimepicker({
        format: formatDatetime,
        onShow: function (ct) {
            this.setOptions({
                maxDate: $('#date-to-news').val() ? $('#date-to-news').val() : false
            })
        },
    });
    $('#date-to-news').datetimepicker({
        format: formatDatetime,
        onShow: function (ct) {
            this.setOptions({
                minDate: $('#date-from-news').val() ? $('#date-from-news').val() : false
            })
        },
    });

    function createDeleteButton() {
        $("[data-method]").append((function () {
            let _method = '';
            if ($(this).attr('data-method') === 'delete') {
                _method = "<input type='hidden' name='_method' value='" + $(this).attr("data-method") + "'>";
            }

            return !$(this).find("form").length > 0 ? "\n<form action='" + $(this).attr("href") + "' method='POST' name='delete_item' style='display:none'>\n" + _method + "\n<input type='hidden' name='_token' value='" + $('meta[name="csrf-token"]').attr("content") + "'>\n</form>\n" : ""
        })).attr("href", "javascript:void(0)").attr("style", "cursor:pointer;").attr("onclick", '$(this).find("form").submit();'), $("form").submit((function () {})), $("body").on("submit", "form[name=delete_item]", (function (t) {
            t.preventDefault();
            var e = this, n = $('a[data-method="delete"]'), el = $(this),
              r = el.parent('a').attr("data-trans-button-cancel") ? el.parent('a').attr("data-trans-button-cancel") : "Cancel",
              i = el.parent('a').attr("data-trans-button-confirm") ? el.parent('a').attr("data-trans-button-confirm") : "Yes, delete",
              o = el.parent('a').attr("data-trans-title") ? el.parent('a').attr("data-trans-title") : "Are you sure you want to delete this item?";
            Swal.fire({
                title: o,
                showCancelButton: !0,
                confirmButtonText: i,
                cancelButtonText: r,
                icon: "warning"
            }).then((function (t) {
                t.value && e.submit()
            }))
        })).on("click", "a[name=confirm_item]", (function (t) {
            t.preventDefault();
            var e = $(this),
              n = e.attr("data-trans-title") ? e.attr("data-trans-title") : "Are you sure you want to do this?",
              r = e.attr("data-trans-button-cancel") ? e.attr("data-trans-button-cancel") : "Cancel",
              i = e.attr("data-trans-button-confirm") ? e.attr("data-trans-button-confirm") : "Continue";
            Swal.fire({
                title: n,
                showCancelButton: !0,
                confirmButtonText: i,
                cancelButtonText: r,
                icon: "info"
            }).then((function (t) {
                t.value && window.location.assign(e.attr("href"))
            }))
        })), $('[data-toggle="tooltip"]').tooltip()
    }
});
