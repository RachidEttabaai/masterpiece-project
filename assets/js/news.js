let $ = require("jquery");

import { getJsonData } from "./getJsonData";

$(document).ready(function() {

    let countrySelected = $("#select-country option:selected").val();

    getJsonData(countrySelected);

    $("#select-country").change(function() {

        $(this).find("option:selected").each(function() {

            $("#news").empty();
            getJsonData($(this).val());
        });

    });

});