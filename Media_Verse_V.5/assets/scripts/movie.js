$(document).ready(async function () {
    setMovieDateFilter();
    setMovieGenreFilter("en")
    setOnMovieFilterChange();
})

async function fetchMovieData(URL) {
    const options = {
        method: 'GET',
        headers: {
            accept: 'application/json',
            Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIwYzJmN2RiNDFhMDc5OTYzZWU3MjkxYWY3OGYxZjFlZSIsIm5iZiI6MTczNjk5NjA5Ni42NDQsInN1YiI6IjY3ODg3NTAwMzg5MjAzOTNhZDFkMmNkMiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.PjVqrSBZLif9fXjhlo78_LTPK-BWvaMEN_fsqnY5wro'
        }
    };

    return await fetch(URL, options)
        .then(res => res.json())
        .catch(err => console.error(err));
}

function setMovieDateFilter() {
    let currentYear = new Date().getFullYear()
    currentDecade = currentYear - currentYear % 10
    for (let i = currentDecade; i >= 1850; i -= 10) {
        $("#movie-filter-year").append(`<option value="${i}">${i}</option>`)
    }
}

async function setMovieGenreFilter(language) {
    const URL = 'https://api.themoviedb.org/3/genre/movie/list?language=en'
    const data = await fetchMovieData(URL)

    data.genres.forEach(element => {
        $("#movie-filter-genre").append(`<option value="${element.id}">${element.name}</option>`);
    });
}

function setOnMovieFilterChange() {
    //movie-filter-genre
    //movie-filter-year
    //movie-filter-language
    //movie-filter-sort

    $("#movie-filter-genre, #movie-filter-year, #movie-filter-language, #movie-filter-sort").on("change", function () {
        const genre = $("#movie-filter-genre").val() || "";
        const year = $("#movie-filter-year").val() || "";
        const language = $("#movie-filter-language").val() || "en";
        const sort = $("#movie-filter-sort").val() || "";

        discoverMovie(genre, year, language, sort);
    });
}

async function discoverMovie(genre, year, language, sort) {
    const URL = `https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=${language}&page=${1}&release_date.gte=${year + "-1-1"}&release_date.lte=${parseInt(year) + 9 + "-12-31"}&sort_by=${sort}&with_genres=${genre}`
    data = await fetchMovieData(URL)
    setMovieResults(data.results)
}

function setMovieResults(data) {
    $("#movie-search-results").empty();
    data.forEach(element => {
        $("#movie-search-results").append(`<img src="${"https://image.tmdb.org/t/p/w500/" + element.poster_path}" alt="${element.title}" class="movie-poster-card" onClick="onMovieCardClick(${element.id})">`);
    });
}

function onMovieCardClick(id){
    window.location.href = `details.php?id=${id}`
}

async function loadDetails(itemID, type){
    if(type != "movie"){
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
    setMovieDetails(backdrop, poster, title, overview, release, runtime, popular, recommended)
}

function setMovieDetails(backdrop, poster, title, overview, release, runtime, popular, recommended){
    $("#title").append(title);
    $("#detail-overview").append(overview);
    $("#detail-release").append(release);
    $("#detail-runtime").append(runtime);
    //$("#detail-popular").append(popular);
    $("#detail-poster").attr("src", "https://image.tmdb.org/t/p/w500/" + poster);
    $("#detail-backdrop").attr("src", "https://image.tmdb.org/t/p/w500/" + backdrop);
}