$(document).ready(async function () {
    const barangay_url =
        "https://raw.githubusercontent.com/isaacdarcilla/philippine-addresses/refs/heads/main/barangay.json";

    const city_url =
        "https://raw.githubusercontent.com/isaacdarcilla/philippine-addresses/refs/heads/main/city.json";

    const province_url =
        "https://raw.githubusercontent.com/isaacdarcilla/philippine-addresses/refs/heads/main/province.json";

    const PROVINCES = await getDataToJSON(province_url);
    const CITIES = await getDataToJSON(city_url);
    const BARANGAYS = await getDataToJSON(barangay_url);

    const select_province = $("#province");
    const select_city = $("#city");
    const select_barangay = $("#barangay");

    showAllProvinces(PROVINCES, select_province);
    showAllCities(CITIES, select_city, select_province);
    showAllBarangays(BARANGAYS, select_barangay, select_city);

    $(select_province).on("change", function () {
        showAllCities(CITIES, select_city, select_province);
        showAllBarangays(BARANGAYS, select_barangay, select_city);
    });

    $(select_city).on("change", function () {
        showAllBarangays(BARANGAYS, select_barangay, select_city);
    });

    function showAllProvinces(datas, element) {
        const name = $(element).val();

        element.empty();

        element.append(
            `<option value="" ${
                name ? "" : "selected"
            }>Choose Province</option>`
        );

        datas.forEach((data) => {
            if (data.province_name === name) {
                element.append(
                    `<option value="${data.province_name}" data-code="${data.province_code}" selected>${data.province_name}</option>`
                );
            } else {
                element.append(
                    `<option value="${data.province_name}" data-code="${data.province_code}">${data.province_name}</option>`
                );
            }
        });
    }

    function showAllCities(datas, element, province) {
        const currentProvince = $(province).val();
        const currentCity = $(element).val();

        const code = getProvinceCodeByName(PROVINCES, currentProvince);

        element.empty();
        element.append(
            `
                <option ${
                    currentCity ? "" : "selected"
                } value = "">Choose City</option>
            `
        );
        datas.forEach((data) => {
            if (data.province_code === code) {
                if (data.city_name === currentCity) {
                    element.append(
                        `
                    <option value="${data.city_name}" data-code="${data.city_code}" selected >${data.city_name}</option>
                    `
                    );
                }
                element.append(
                    `
                    <option value="${data.city_name}" data-code="${data.city_code}">${data.city_name}</option>
                    `
                );
            }
        });
    }

    function showAllBarangays(datas, element, city) {
        const currentCity = $(city).val();
        const currentBarangay = $(element).val();
        const code = getCityCodeByName(CITIES, currentCity);
        element.empty();
        element.append(
            `
                <option ${
                    currentBarangay ? "" : "selected"
                } value="">Choose Barangay</option>
            `
        );

        datas.forEach((data) => {
            if (data.city_code === code) {
                if (data.brgy_name === currentBarangay) {
                    element.append(
                        `
                        <option value="${data.brgy_name}" selected>${data.brgy_name}</option>
                        `
                    );
                }

                element.append(
                    `
                        <option value="${data.brgy_name}">${data.brgy_name}</option>
                        `
                );
            }
        });
    }

    function getProvinceCodeByName(provinces, name) {
        const foundProvince = provinces.find(
            (province) => province.province_name === name
        );
        return foundProvince ? foundProvince.province_code : null;
    }

    function getCityCodeByName(cities, name) {
        const foundCity = cities.find((city) => city.city_name === name);
        return foundCity ? foundCity.city_code : null;
    }

    async function getDataToJSON(url) {
        try {
            const res = await $.ajax({
                url: url,
                type: "GET",
            });
            return JSON.parse(res);
        } catch (err) {
            console.error("Error:", err);
            return null; // Or handle the error as needed
        }
    }
});
