$(document).ready(function () {
    const barangay_url =
        "https://raw.githubusercontent.com/isaacdarcilla/philippine-addresses/refs/heads/main/barangay.json";

    const city_url =
        "https://raw.githubusercontent.com/isaacdarcilla/philippine-addresses/refs/heads/main/city.json";

    const province_url =
        "https://raw.githubusercontent.com/isaacdarcilla/philippine-addresses/refs/heads/main/province.json";

    const default_code = "0973";

    const select_province = $("#province");
    const select_city = $("#city");
    const select_barangay = $("#barangay");
    $.ajax({
        url: province_url,
        type: "GET",
        success: function (res) {
            const provinces = JSON.parse(res);
            provinces.forEach((province) => {
                if (province.province_code === default_code) {
                    select_province.append(
                        `<option value="${province.province_name}" data-code="${province.province_code}" selected>${province.province_name}</option>`
                    );
                } else {
                    select_province.append(
                        `<option value="${province.province_name}" data-code=${province.province_code}>${province.province_name}</option>`
                    );
                }
            });
        },
    });

    $.ajax({
        url: city_url,
        type: "GET",
        success: function (res) {
            const cities = JSON.parse(res);
            cities.forEach((city) => {
                if (city.province_code === default_code) {
                    select_city.append(
                        `
                        <option value="${city.city_name}" data-code="${city.city_code}">${city.city_name}</option>
                        `
                    );
                }
            });
        },
    });

    $(select_province).on("change", function () {
        const province_code = $(this).find("option:selected").data("code");
        $(select_city).empty();

        $.ajax({
            url: city_url,
            type: "GET",
            success: function (res) {
                const cities = JSON.parse(res);

                select_city.prepend(
                    `<option value="" selected>Choose City</option>`
                );

                cities.forEach((city) => {
                    if (city.province_code === province_code) {
                        select_city.append(
                            `
                        <option value="${city.city_name}" data-code="${city.city_code}">${city.city_name}</option>
                        `
                        );
                    }
                });
            },
        });
    });

    $(select_city).on("change", function () {
        const city_code = $(this).find("option:selected").data("code");
        $(select_barangay).empty();

        $.ajax({
            url: barangay_url,
            type: "GET",
            success: function (res) {
                const barangays = JSON.parse(res);

                select_barangay.prepend(
                    `<option value="" selected>Choose Barangay</option>`
                );

                barangays.forEach((barangay) => {
                    if (barangay.city_code === city_code) {
                        select_barangay.append(
                            `
                        <option value="${barangay.brgy_name}">${barangay.brgy_name}</option>
                        `
                        );
                    }
                });
            },
        });
    });
});
