$(document).ready(function () {
    $("input[data-bootstrap-switch]").each(function () {
        $(this).bootstrapSwitch({
            onText: "Yes",
            offText: "No",
            onSwitchChange: async function (e, state) {
                let id = $(e.target).attr("id");
                const _token = $(e.target).data("token");
                const loader = $("#loader");

                loader.css("display", "inline-block");
                $(e.target).parent().css("display", "none");
                let Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                });

                try {
                    const res = await $.ajax({
                        url: `/admin/products/availability/${id}`,
                        method: "PUT",
                        data: {
                            state: state,
                            _token: _token,
                        },
                    });

                    Toast.fire({
                        icon: "success",
                        title: res.success,
                    });

                    $(e.target).parent().css("display", "block");
                } catch (e) {
                    Toast.fire({
                        icon: "error",
                        title: "Something went wrong",
                    });

                    location.reload();
                } finally {
                    loader.css("display", "none");
                }
            },
        });
    });
});
