$(document).ready(function () {
    const supplier_input = $("#supplier");

    $("#createSupplier").on("submit", async function (e) {
        e.preventDefault();
        const name = $("supplier_name");
        const button = $("submitSupplier");
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

        try {
            const res = await $.ajax({
                url: $(this).attr("action"),
                method: "POST",
                data: $(this).serialize(),
            });

            $(elements).each(function () {
                const element = $(this);
                element.val("");
            });
            Toast.fire({
                icon: "success",
                title: res.success,
            });
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
                    title: "Something went wrong",
                });

                console.log(err);
            }
        } finally {
            button.show();
            button.parent().children().last().remove();
            showAllSupplier();
        }
    });
    async function showAllSupplier() {
        try {
            const res = await $.ajax({
                url: "/admin/suppliers",
                method: "GET",
                dataType: "json",
            });

            const suppliers = res.suppliers;

            supplier_input.empty();
            supplier_input.append(
                ` <option selected value="">
                        Choose Category
                    </option>`
            );

            suppliers.forEach((supplier) => {
                supplier_input.append(
                    ` <option value="${supplier.id}">${supplier.name}</option>`
                );
            });
        } catch (err) {
            console.log(err);
        }
    }
});
