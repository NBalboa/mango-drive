$(document).ready(function () {
    $("#createCashier").on("submit", function (e) {
        e.preventDefault();
        $("#spinner").show();
        const first_name = $("#first_name");
        const last_name = $("#last_name");
        const middle_name = $("#middle_name");
        const email = $("#email");
        const phone = $("#phone");
        const button = $(submitCashier);
        const elements = [first_name, last_name, middle_name, email, phone];
        button.hide();

        button.parent().append(
            `
            <div class="spinner-border float-right" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            `
        );

        $(elements).each(function () {
            const element = $(this);
            if (element.hasClass("is-invalid")) {
                element.removeClass("is-invalid");
                const parent = element.parent();
                parent.children().last().remove();
            }
        });

        $.ajax({
            url: $(this).attr("action"),
            method: "POST",
            data: $(this).serialize(),
            success: function (res) {
                $(elements).each(function () {
                    const element = $(this);
                    element.val("");
                });
                alert(res.success);
            },
            error: function (res) {
                if (res.status === 422) {
                    const errors = res.responseJSON.errors;
                    for (const key in errors) {
                        const value = errors[key];

                        const element = $(`#${key}`);
                        element.addClass("is-invalid");
                        element
                            .parent()
                            .append(
                                `<span class="error invalid-feedback">${value}</span>`
                            );
                    }
                }
            },
            complete: function () {
                button.show();
                button.parent().children().last().remove();
            },
        });
    });
});
