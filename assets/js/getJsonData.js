let $ = require("jquery");

export function getJsonData(optionselected) {

    if (optionselected == "none") {
        apiurl = "http://newsapi.org/v2/top-headlines?country=&q=covid&apiKey=f6ee46b1b01d42a9b9e3a3fdc6cfe32b";
    } else {
        apiurl = "http://newsapi.org/v2/top-headlines?country=" + optionselected + "&q=covid&apiKey=f6ee46b1b01d42a9b9e3a3fdc6cfe32b";

    }

    $.getJSON(apiurl, function(data) {
        let news = data.articles;

        if (!$.isArray(news) || !news.length) {
            $("#news").append($("<div/>", {
                "class": "alert alert-danger",
                html: "No news found"
            }));
        } else {
            let cardnews = [];
            for (let i in news) {
                //console.log(news[i]);
                let cardimg = "<img class='card-img-top img-fluid' src='" + news[i].urlToImage + "' title='" + news[i].title + "'/>";
                let cardtitle = "<h4 class='card-title'><a href='" + news[i].url + "' target='_blank'>" + news[i].title + "</a></h4>";
                let cardtext = "<div class='card-text'>" + news[i].description + "</div>";
                let cardtextsmall = "<div class='card-text'><small class='text-muted'>" + new Date(news[i].publishedAt).toString() + " by " + news[i].source.name + "</small></div>";
                let cardbody = "<div class='card-body'>" + cardtitle + cardtext + cardtextsmall + "</div>";
                let cardcontentnews = "<div class='card'>" + cardimg + cardbody + "</div>";

                cardnews.push(cardcontentnews);
            }

            $("#news").append($("<div/>", {
                "class": "card-columns",
                html: cardnews.join("")
            }));
        }

    });


}