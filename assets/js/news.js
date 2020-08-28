let $ = require("jquery");

$(document).on("ready", function() {

    let countrySelected = $("#select-country option:selected").val();

    if (countrySelected == "none") {
        apiurl = "http://newsapi.org/v2/top-headlines?country=&q=covid&apiKey=f6ee46b1b01d42a9b9e3a3fdc6cfe32b";
    } else {
        apiurl = "http://newsapi.org/v2/top-headlines?country=" + countrySelected + "&q=covid&apiKey=f6ee46b1b01d42a9b9e3a3fdc6cfe32b";

    }

    console.log(countrySelected)

});