$(document).ready(function () {
    $("#createStaff").on("submit", function (e) {
        e.preventDefault();
        $("#spinner").show();
        const first_name = $("#first_name");
        const last_name = $("#last_name");
        const middle_name = $("#middle_name");
        const email = $("#email");
        const phone = $("#phone");
        const role = $("#role");
        const barangay = $("#barangay");
        const city = $("#city");
        const province = $("#province");
        const street = $("#street");

        const button = $("#submitStaff");
        const elements = [
            first_name,
            last_name,
            middle_name,
            email,
            phone,
            role,
            barangay,
            city,
            province,
            street,
        ];
        button.hide();

        button.parent().append(
            `
            <div class="spinner-border float-right" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            `
        );

        let Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
        });

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
                Toast.fire({
                    icon: "success",
                    title: res.success,
                });
            },
            error: function (err) {
                if (err.status === 422) {
                    const errors = err.responseJSON.errors;
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
                } else {
                    Toast.fire({
                        icon: "error",
                        title: "Something went wrong",
                    });

                    console.log(err);
                }
            },
            complete: function () {
                button.show();
                button.parent().children().last().remove();
            },
        });
    });
});
