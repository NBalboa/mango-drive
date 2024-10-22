$(document).ready(function () {
    bsCustomFileInput.init();

    const preview = $("#preview");

    $("#image").on("change", function (e) {
        const file = e.target.files[0];
        const image = $("#imagePreview");
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                image.attr("src", e.target.result);
            };

            reader.readAsDataURL(file);
        }

        preview.css("display", "block");
    });
});
