/**
 * First Setup for when page loads
 */
$(document).ready(async function () {
    setMovieDateFilter();
    setMovieGenreFilter("en")
    setOnMovieFilterChange();
})

/**
 * Gets movie data from imdb, 
 * THERE IS NO API KEY as I have not setup a seperate file for github yet
 * @param {*} URL 
 * @returns 
 */
async function fetchMovieData(URL) {
    const options = {
        method: 'GET',
        headers: {
            accept: 'application/json',
            Authorization: ''
        }
    };

    return await fetch(URL, options)
        .then(res => res.json())
        .catch(err => console.error(err));
}

/**
 * Allows all decades to be added to movie filter from 1850-present decade
 */
function setMovieDateFilter() {
    let currentYear = new Date().getFullYear()
    currentDecade = currentYear - currentYear % 10
    for (let i = currentDecade; i >= 1850; i -= 10) {
        $("#movie-filter-year").append(`<option value="${i}">${i}</option>`)
    }
}

/**
 * Allows for a genres to be added based on user language
 * @param {*} language 
 */
async function setMovieGenreFilter(language) {
    const URL = 'https://api.themoviedb.org/3/genre/movie/list?language=en'
    const data = await fetchMovieData(URL)

    data.genres.forEach(element => {
        $("#movie-filter-genre").append(`<option value="${element.id}">${element.name}</option>`);
    });
}

/**
 * When user changes movie-filter the inner function is called
 */
function setOnMovieFilterChange() {

    $("#movie-filter-genre, #movie-filter-year, #movie-filter-language, #movie-filter-sort").on("change", function () {
        const genre = $("#movie-filter-genre").val() || "";
        const year = $("#movie-filter-year").val() || "";
        const language = $("#movie-filter-language").val() || "en";
        const sort = $("#movie-filter-sort").val() || "";

        discoverMovie(genre, year, language, sort);
    });
}

/**
 * This is called based on movie discover filter from the above function
 * @param {*} genre 
 * @param {*} year 
 * @param {*} language 
 * @param {*} sort 
 */
async function discoverMovie(genre, year, language, sort) {
    const URL = `https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=${language}&page=${1}&release_date.gte=${year + "-1-1"}&release_date.lte=${parseInt(year) + 9 + "-12-31"}&sort_by=${sort}&with_genres=${genre}`
    data = await fetchMovieData(URL)
    setMovieResults(data.results)
}

/**
 * This allows discover movie, and movie search to both allow a similar look based on returned data
 * @param {*} data 
 */
function setMovieResults(data) {
    $("#movie-search-results").empty();
    data.forEach(element => {
        $("#movie-search-results").append(`<img src="${"https://image.tmdb.org/t/p/w500/" + element.poster_path}" alt="${element.title}" class="movie-poster-card" onClick="onMovieCardClick(${element.id})">`);
    });
}

/**
 * when a movie is clicked from setMovieResults, this function opens details page with an id of the movie
 * @param {*} id 
 */
function onMovieCardClick(id) {
    window.location.href = `details.php?id=${id}`
}

/**
 * This loads the details of the movie for details page, but does not set the html, setMovieDetails is for html
 * @param {*} itemID 
 * @param {*} type 
 * @returns 
 */
async function loadDetails(itemID, type) {
    if (type != "movie") {
        return;
    }
    console.log(itemID)
    data = await fetchMovieData(`https://api.themoviedb.org/3/movie/${itemID}?language=en-US`)
    console.log(data)
    const backdrop = data.backdrop_path;
    const poster = data.poster_path;
    const title = data.title;
    const overview = data.overview;
    const release = data.release_date;
    const runtime = data.runtime;
    const popular = "data.backdrop_path";
    const recommended = "data.backdrop_path";
    const streaming = "data.backdrop_path";

    setMovieDetails(backdrop, poster, title, overview, release, runtime, popular, recommended, streaming)
}

/**
 * Sets HTML for details page for movies
 * @param {*} backdrop 
 * @param {*} poster 
 * @param {*} title 
 * @param {*} overview 
 * @param {*} release 
 * @param {*} runtime 
 * @param {*} popular 
 * @param {*} recommended 
 */
function setMovieDetails(backdrop, poster, title, overview, release, runtime, popular, recommended, streaming) {
    $("#title").append(title);
    $("#detail-overview").append(overview);
    $("#detail-release").append(release);
    $("#detail-runtime").append(runtime);
    //$("#detail-popular").append(popular);
    //$("#detail-recommended").append(recommended);
    //$("#detail-streaming").append(streaming);
    $("#detail-poster").attr("src", "https://image.tmdb.org/t/p/w500/" + poster);
    $("#detail-backdrop").attr("src", "https://image.tmdb.org/t/p/w500/" + backdrop);
}