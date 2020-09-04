let $ = require("jquery");

function checkifcontentnotnull(content) {

    if (content !== null) {
        return content;
    } else {
        return "";
    }
}

function checkifimgurlnotnull(imgurl) {
    if (imgurl !== null) {
        return imgurl;
    } else {
        return "https://via.placeholder.com/300.png?text=No%20image%20found";
    }
}

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
}

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

function apirequest(url) {

    $.getJSON(url, function(data) {

        let news = data.articles;

        checkNews(news);
    });


}
export function getJsonData(optionselected) {

    if (optionselected == "none") {
        let apiurl = "http://newsapi.org/v2/top-headlines?country=&q=covid&apiKey=f6ee46b1b01d42a9b9e3a3fdc6cfe32b";
        apirequest(apiurl);
    } else {
        let apiurl = "http://newsapi.org/v2/top-headlines?country=" + optionselected + "&q=covid&apiKey=f6ee46b1b01d42a9b9e3a3fdc6cfe32b";
        apirequest(apiurl);
    }

}