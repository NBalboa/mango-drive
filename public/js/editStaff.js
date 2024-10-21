$(document).ready(function () {
    $("#editStaff").on("submit", function (e) {
        e.preventDefault();
        $("#spinner").show();
        const first_name = $("#first_name");
        const last_name = $("#last_name");
        const middle_name = $("#middle_name");
        const barangay = $("#barangay");
        const city = $("#city");
        const province = $("#province");

        const button = $("#submitStaff");
        const elements = [
            first_name,
            last_name,
            middle_name,
            barangay,
            city,
            province,
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
            method: "PUT",
            data: $(this).serialize(),
            success: function (res) {
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
