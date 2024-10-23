$(document).ready(function () {
    const preview = $("#preview");
    const button = $("#updateSubmitProduct");
    const name = $("#name");
    const description = $("#description");
    const price = $("#price");
    const category = $("#category");
    const quantity = $("#quantity");
    const image = $("#image");
    const supplier = $("#supplier");
    const elements = [
        name,
        description,
        price,
        category,
        quantity,
        image,
        supplier,
    ];

    let Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
    });

    $("#editProduct").on("submit", async function (e) {
        e.preventDefault();

        $(elements).each(function () {
            const element = $(this);
            if (element.hasClass("is-invalid")) {
                element.removeClass("is-invalid");
                const parent = element.parent();
                parent.children().last().remove();
            }
        });

        button.hide();

        button.parent().append(
            `
            <div class="spinner-border float-right" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            `
        );

        const formData = new FormData(e.target);

        try {
            const res = await $.ajax({
                url: $(this).attr("action"),
                type: "POST",
                processData: false,
                contentType: false,
                data: formData,
            });

            $(elements).each(function () {
                const element = $(this);
                element.val("");
            });
            Toast.fire({
                icon: "success",
                title: res.success,
            });

            $(this)[0].reset();
        } catch (err) {
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
                    title: err.responseJSON.message,
                });

                console.log(err);
            }
        } finally {
            button.show();
            button.parent().children().last().remove();
            preview.css("display", "none");
        }
    });
});
