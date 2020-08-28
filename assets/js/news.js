let $ = require("jquery");

import { getJsonData } from "./getJsonData";

$(document).ready(function() {

    let countrySelected = $("#select-country option:selected").val();

    getJsonData(countrySelected)

});