$(document).ready(function () {
    $("#createCategory").on("submit", function (e) {
        e.preventDefault();

        const name = $("#category_name");
        const button = $("#submitCategory");

        button.hide();

        button.parent().append(
            `
            <div class="spinner-border float-right" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            `
        );

        const elements = [name];
        $(elements).each(function () {
            const element = $(this);
            if (element.hasClass("is-invalid")) {
                element.removeClass("is-invalid");
                const parent = element.parent();
                parent.children().last().remove();
            }
        });

        let Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
        });

        $.ajax({
            url: $(this).attr("action"),
            method: "PUT",
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
                getAllCategories();
            },
        });
    });

    function getAllCategories() {
        const category_input = $("#category");
        $.ajax({
            url: "/admin/categories",
            method: "GET",
            dataType: "json",
            success: function (res) {
                const categories = res.categories;

                category_input.empty();
                category_input.append(
                    ` <option selected value="">
                        Choose Category
                    </option>`
                );

                categories.forEach((category) => {
                    category_input.append(
                        ` <option value="${category.id}">${category.name}</option>`
                    );
                });
            },
            error: function (err) {
                console.log(err);
            },
        });
    }
});
