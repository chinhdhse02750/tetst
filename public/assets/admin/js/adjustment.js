$(document).ready(function () {
    $(document).on('change', '#amount', function (e) {
        $('#amount-box').val($(this).val());
    });
    $(document).on('change', '#content', function (e) {
        $('#content-box').val($(this).val());
    });

    $("[data-method]").append((function () {
        return !$(this).find("form").length > 0 ? "\n<form action='" + $(this).attr("href") + "' method='POST' name='update_point_send' " +
            "style='display:none'>\n<input type='hidden' name='_method' value='" + $(this).attr("data-method") + "'>\n" +
            "<input type='hidden' name='_token' value='" + $('meta[name="csrf-token"]').attr("content") + "'>\n" +
            "<input type='hidden' name='amount' id='amount-box' value='" + $('#amount').val() + "'>\n" +
            "<input type='hidden' name='user_id' value='" + $('#user_id').val() + "'>\n" +
            "<input type='hidden' name='content' id='content-box'  value='" + $('#content').val() + "'>\n" + "</form>\n" : ""
    })).attr("href", "#").attr("style", "cursor:pointer;").attr("onclick", '$(this).find("form").submit();'), $("form").submit((function () {
        return $(this).find('input[type="submit"]').attr("disabled", !0), $(this).find('button[type="submit"]').attr("disabled", !0), !0
    })), $("body").on("submit", "form[name=update_point_send]", (function (t) {
        t.preventDefault();
        var e = this, n = $('a[data-method="post"]'),
            r = n.attr("data-trans-button-cancel") ? n.attr("data-trans-button-cancel") : "Cancel",
            i = n.attr("data-trans-button-confirm") ? n.attr("data-trans-button-confirm") : "OK",
            o = n.attr("data-trans-title") ? n.attr("data-trans-title") : "Give points. is this good??";
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
    })), $('[data-toggle="tooltip"]').tooltip();
});
