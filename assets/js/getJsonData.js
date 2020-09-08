let $ = require("jquery");

/**
 * Check if a content is null or not
 * @param {string} content 
 */
function checkifcontentnotnull(content) {

    if (content !== null) {
        return content;
    } else {
        return "";
    }
}

/**
 * Check if an image url is null or not
 * @param {string} imgurl 
 */
function checkifimgurlnotnull(imgurl) {
    if (imgurl !== null) {
        return imgurl;
    } else {
        return "https://via.placeholder.com/300.png?text=Image%20not%20found";
    }
}

/**
 * Check if an image is loaded or not
 * @param {string} tagimg 
 */
function checkifimgloaded(tagimg) {

    //console.log("nb img", $(tagimg).length);

    $(tagimg).each(function() {
        $(this).on("load", function() {
            // console.log("img loaded");
        }).on("error", function() {
            $(this).attr("src", "https://via.placeholder.com/300.png?text=Image%20not%20found")
        }).attr("src", $(this).attr("src"));
    });

}

/**
 * Rendering the JSON data from the API request
 * @param {array} newscontent 
 */
function renderNews(newscontent) {

    let cardnews = [];

    for (let i in newscontent) {

        let cardimg = "<img class='card-img-top img-fluid' src='" + checkifimgurlnotnull(newscontent[i].urlToImage) + "' title='" + checkifcontentnotnull(newscontent[i].title) + "'/>";

        let cardtitle = "<h4 class='card-title'><a href='" + newscontent[i].url + "' target='_blank'>" + checkifcontentnotnull(newscontent[i].title) + "</a></h4>";

        let cardtext = "<div class='card-text'>" + checkifcontentnotnull(newscontent[i].description) + "</div>";

        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            'hour': 'numeric',
            'minute': 'numeric'
        };
        let cardtextsmall = "<div class='card-text'><small class='text-muted'>Published on " + new Date(newscontent[i].publishedAt).toLocaleDateString("en-EN", options) + " by " + newscontent[i].source.name + "</small></div>";
        let cardbody = "<div class='card-body'>" + cardtitle + cardtext + cardtextsmall + "</div>";
        let cardcontentnews = "<div class='card mb-4' style='min-width: 18rem;'>" + cardimg + cardbody + "</div>";

        if (i % 3 == 0) {
            cardnews.push("<div class='w-100 d-lg-none mt-4'></div>")
        }

        cardnews.push(cardcontentnews);
    }

    $("#news").append($("<div/>", {
        "class": "card-deck",
        html: cardnews.join("")
    }));

    checkifimgloaded("img");

}

/**
 * Check if the result of the API request is not empty
 * @param {array} newscontent 
 */
function checkNews(newscontent) {

    if (!$.isArray(newscontent) || newscontent.length == 0) {
        $("#news").append($("<div/>", {
            "class": "alert alert-danger",
            html: "No news found"
        }));
    } else {
        renderNews(newscontent);
    }

}

/**
 * Doing the API request
 * @param {string} url 
 */
function apirequest(url) {

    $.getJSON(url, function(data) {

        let news = data.articles;

        checkNews(news);
    });


}

/**
 * Get data from a remote API as JSON
 * @param {string} optionselected 
 */
export function getJsonData(optionselected) {

    if (optionselected == "none") {
        let apiurl = "http://newsapi.org/v2/top-headlines?country=&q=covid&apiKey=f6ee46b1b01d42a9b9e3a3fdc6cfe32b";
        apirequest(apiurl);
    } else {
        let apiurl = "http://newsapi.org/v2/top-headlines?country=" + optionselected + "&q=covid&apiKey=f6ee46b1b01d42a9b9e3a3fdc6cfe32b";
        apirequest(apiurl);
    }

}