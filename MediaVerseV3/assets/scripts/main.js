let sites = [
    {url: "https://hdtodayz.to/search/", icon: "stream1.png"},
    {url: "https://nunflix.org/search/", icon: "stream2.png"},
    //{url: "https://popcornmovies.to/search/", icon: "stream3.png"},
    //{url: "https://hexa.watch/search?q=", icon: "stream3.png"},
];

$(document).ready(async function () {
    let id = 26

    $("#search-query").submit(async function (e) {
        e.preventDefault();

        let searchBar = $("#search-bar")

        let query = searchBar.val() || "";
        searchBar.val("");

        setSlider(".search-results-container", await search(mediaType, query) , 1, 5);
    });

    $("#search-filter").length ? setupForm(mediaType) : "";

    $("#search-filter-genre, #search-filter-year, #search-filter-language, #search-filter-sort").on("change", async function () {
        const genre = $("#search-filter-genre").val() || "";
        const year = $("#search-filter-year").val() || "";
        const language = $("#search-filter-language").val() || "en";
        const sort = $("#search-filter-sort").val() || "";
        setSlider(".search-results-container", await discover(mediaType, genre, year, language, sort), 1, 5);
    });

    $("#recommend-container").length ? setSlider("#recommend-container", await recommend(mediaType, id), 1, 4) : "";
    $("#details-container").length ? setSlider("#details-container", await details(mediaType, id), 1, 4) : "";
    $("#streaming-container").length ? setSlider("#streaming-container", await streaming(mediaType, id), 1, 4) : "";
    $("#popular-container").length ? setSlider("#popular-container", await popular(mediaType), 1, 4) : "";
    $("#now-playing-container").length ? setSlider("#now-playing-container", await movieExtras("movie", "now_playing"), 1, 4) : "";
    $("#upcoming-container").length ? setSlider("#upcoming-container", await movieExtras("movie", "upcoming"), 1, 4) : "";

})

async function setupForm(mediaType) {
    //setup year
    let currentYear = new Date().getFullYear()
    let currentDecade = currentYear - currentYear % 10
    for (let i = currentDecade; i >= 1850; i -= 10) {
        $("#search-filter-year").append(`<option value="${i}">${i}</option>`)
    }

    //setup genre
    let data = await makeCall("genre", `&media_type=${mediaType}`)
    data.genres.forEach(element => {
        $("#search-filter-genre").append(`<option value="${element.id}">${element.name}</option>`);
    });

    setSlider(".search-results-container", await discover(mediaType, "", "2010", "en", "popular.asc"), 1, 5);

}

function getMediaCard(img, title, id) {
    let cardImage = `https://image.tmdb.org/t/p/original${img}`;
    if(img === null)
        cardImage = "assets/images/null-icon.jpg"

    return `
    <div class="media-card-container" onclick="openDetails('${id}', '${mediaType}')">
        <img src="${cardImage}" alt="${title}"/>
    </div>`
}

function setSlider(div, data, page, numberOfResults) {
    //find correct div to add data to
    if(!data){
        return;
    }
    const sliderDiv = $(div).find(".slider-container").find(".slider-results");

    //on left click
    $(div).find(".slider-container").find(".slider-left").off("click").on("click", function () {
        if (page - 1 < 1) return;
        setSlider(div, data, page - 1, numberOfResults);
    })

    //on right click
    $(div).find(".slider-container").find(".slider-right").off("click").on("click", function () {
        if ((page + 1) * numberOfResults >= data.length) return;
        setSlider(div, data, page + 1, numberOfResults);
    })

    //this will empty div and adds new data
    sliderDiv.empty();

    if(!data[0]){
        data = data.results;
    }
    for (let i = (page - 1) * numberOfResults; i < page * numberOfResults; i++) {
        if (data[i]) {
            sliderDiv.append(getMediaCard(data[i].poster_path, data[i].title, data[i].id))
        }
    }
}

async function makeCall(callType, params) {
    return await fetch(`assets/scripts/Movie_Data.php?search_query=${callType || ""}${params}`)
        .then(res => res.json())
}

async function discover(mediaType, genre, year, language, sort) {
    let data = await makeCall("discover", `&media_type=${mediaType}&year=${year}&genre=${genre}&language=${language}&sort=${sort}`)
    return data.results;
}

async function search(mediaType, query) {
    let data = await makeCall("search", `&media_type=${mediaType}&query=${query}`)
    return data.results;
}

async function recommend(mediaType, id) {
    return await makeCall("recommend", `&media_type=${mediaType}&id=${id}`)
}

async function details(mediaType, id) {
    return await makeCall("details", `&media_type=${mediaType}&id=${id}`)

}

async function streaming(mediaType, id) {
    return await makeCall("streaming", `&media_type=${mediaType}&id=${id}`)
}

async function popular(mediaType) {
    let data = await makeCall("popular", `&media_type=${mediaType}`)
    return data;
}

async function movieExtras(mediaType, search_query) {
    let data = await makeCall(search_query, `&media_type=${mediaType}`)
    return data.results;
}

async function openDetails(id, mediaType) {
    window.location.href = `details.php?id=${id}&media_type=${mediaType}`
}

//-----------------------------------------------------------------------------

function setStreamingCard(data, div) {
    $(div).empty();
    if (data == null) {
        return
    }
    data.forEach(element => {
        $(div).append(`<img src="${"https://image.tmdb.org/t/p/w500/" + element.logo_path}" alt="${element.provider_name}" class="media-streaming-card">`);
    });
}

async function loadMovieDetails(id, mediaType) {
    let data = await details(mediaType, id);
    $("#detail-title").append(data.title);
    $("#detail-overview").append(data.overview);
    $("#detail-release").append("Release: " + data.release_date);
    $("#detail-runtime").append("Runtime: " + data.runtime + " Minutes");
    $("#detail-poster").attr("src", "https://image.tmdb.org/t/p/original/" + data.poster_path);
    $("#detail-backdrop").attr("src", "https://image.tmdb.org/t/p/original/" + data.backdrop_path);
    mediaStreaming(itemID, "movie")
    mediaIStreaming(itemID, "movie")
}

async function loadTvDetails(id, mediaType) {
    let data = await details(mediaType, id);
    $("#detail-title").append(data.name);
    $("#detail-overview").append(data.overview);
    $("#detail-release").append("Release: " + data.first_air_date);
    $("#detail-runtime").append("Seasons: " + data.number_of_seasons + "<br><br> Episodes: " + data.number_of_episodes);
    $("#detail-poster").attr("src", "https://image.tmdb.org/t/p/original/" + data.poster_path);
    $("#detail-backdrop").attr("src", "https://image.tmdb.org/t/p/original/" + data.backdrop_path);
    mediaStreaming(itemID, "tv")
    mediaIStreaming(itemID, "tv")
}
function setIStreaming(link, icon, div) {
    console.log(link, "link")
    link = link + ""
    $(div).append(`<img src="${icon}" alt="${link}" class="media-streaming-card" onClick="openPage('${link}')">`);
}

function openPage(link){
    window.open(link, '_blank');
}

async function mediaStreaming(id, media) {
    let data = await streaming(media, id);
    setStreamingCard(data.results.US.buy, "#detail-streaming-buy")
    setStreamingCard(data.results.US.flatrate, "#detail-streaming-flatrate")
    setStreamingCard(data.results.US.rent, "#detail-streaming-rent")
}

async function mediaIStreaming(id, media) {
    let data = await details(media, id)
    let name = data.name ? data.name.replace(/['"]/g, "") : (data.title ? data.title.replace(/['"]/g, "") : "");
    if (name) {
        for (const site of sites) {
            let url = site.url + encodeURIComponent(name).replace(/%20/g, "-")
            let icon = "assets/Images/" + site.icon
            setIStreaming(url, icon, "#detail-streaming-rent2");
        }
    }
}