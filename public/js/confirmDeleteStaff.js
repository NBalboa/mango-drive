$(document).ready(function () {
    $("#confirmDelete").on("submit", async function (e) {
        e.preventDefault();

        const result = await Swal.fire({
            title: "Are you sure to delete this staff?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confrim",
        });

        if (result.isConfirmed) {
            this.submit();
        }
    });
});
