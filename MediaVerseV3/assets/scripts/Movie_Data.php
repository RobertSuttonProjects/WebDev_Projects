<?php

/*
 *everything is setup i just need to allow javascript to call the movie data now
 * */
include("api.php");

if (isset($_GET["search_query"])) {
    $id = isset($_GET["id"]) ? $_GET["id"] : "";

    $genre = isset($_GET["genre"]) ? $_GET["genre"] : "";
    $year = isset($_GET["year"]) ? $_GET["year"] : "";
    $language = isset($_GET["language"]) ? $_GET["language"] : "";
    $sort = isset($_GET["sort"]) ? $_GET["sort"] : "";

    $query = isset($_GET["query"]) ? urlencode($_GET["query"]) : "";
    $media_type = isset($_GET["media_type"]) ? $_GET["media_type"] : "";
    $search_query = $_GET["search_query"];

    switch ($search_query) {
        case "discover":
            if ($media_type == "movie") {
                discoverMovie($genre, $year, $language, $sort, 1);
            } else if ($media_type == "tv") {
                discoverTv($genre, $year, $language, $sort, 1);
            } else {
                echoJson("Error", "Invalid media type: " . $media_type);
            }
            break;
        case "search":
            if ($media_type == "movie") {
                searchMovie($query, 1);
            } else if ($media_type == "tv") {
                searchTv($query, 1);
            } else {
                echoJson("Error", "Invalid media type: " . $media_type);
            }
            break;
        case "recommend":
            if ($media_type == "movie") {
                recommendedMovie($id, 1);
            } else if ($media_type == "tv") {
                recommendedTv($id, 1);
            } else {
                echoJson("Error", "Invalid media type: " . $media_type);
            }
            break;
        case "details":
            if ($media_type == "movie") {
                detailsMovie($id);
            } else if ($media_type == "tv") {
                detailsTv($id);
            } else {
                echoJson("Error", "Invalid media type: " . $media_type);
            }
            break;
        case "streaming":
            if ($media_type == "movie") {
                streamingDataMovie($id);
            } else if ($media_type == "tv") {
                streamingDataTv($id);
            } else {
                echoJson("Error", "Invalid media type: " . $media_type);
            }
            break;
        case "popular":
            if ($media_type == "movie") {
                popularMovie(1);
            } else if ($media_type == "tv") {
                popularTv(1);
            } else {
                echoJson("Error", "Invalid media type: " . $media_type);
            }
            break;
        case "upcoming":
            if ($media_type == "movie") {
                upcomingMovie(1);
            } else {
                echoJson("Error", "Invalid media type: " . $media_type);
            }
            break;
        case "now_playing":
            if ($media_type == "movie") {
                nowPlaying(1);
            } else {
                echoJson("Error", "Invalid media type: " . $media_type);
            }
            break;
        case "genre":
            if ($media_type == "movie") {
                genre($media_type);
            } else if ($media_type == "tv") {
                genre($media_type);
            } else {
                echoJson("Error", "Invalid media type: " . $media_type);
            }
            break;


        default:
            echoJson("Error", "Invalid search query: " . $search_query);
    }
}

/**
 * @param $status
 * @param $message
 * @return void
 */
function echoJson($status, $message)
{
    echo json_encode([
        "status" => $status,
        "message" => $message
    ]);
}

/**
 * @param $url
 * @return bool|string|void
 */
function fetchData($url)
{
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "Authorization: " . API_KEY,
            "accept: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        return $response;
    }
}

/**
 * @param $genre
 * @param $year
 * @param $language
 * @param $sort
 * @param $page
 * @return void
 */
function discoverMovie($genre, $year, $language, $sort, $page)
{

    $url = "https://api.themoviedb.org/3/discover/movie?include_adult=false&page=" . $page;
    if ($genre != "") {
        $url .= "&with_genres=" . $genre;
    }
    if ($year != "") {
        $url .= "&primary_release_date.gte=1-1-" . $year . "&primary_release_date.lte=31-12-" . ($year + 10);
    }
    if ($language != "") {
        $url .= "&with_original_language=" . $language;
    }
    if ($sort != "") {
        $url .= "&sort_by=" . $sort;
    }
    echo fetchData($url);
}

/**
 * @param $genre
 * @param $year
 * @param $language
 * @param $sort
 * @param $page
 * @return void
 */
function discoverTv($genre, $year, $language, $sort, $page)
{
    $url = "https://api.themoviedb.org/3/discover/tv?include_adult=false&page=" . $page;
    if ($genre != "") {
        $url .= "&with_genres=" . $genre;
    }
    if ($year != "") {
        $url .= "&first_air_date.gte=1-1-" . $year . "&first_air_date.lte=31-12-" . ($year + 10);
    }
    if ($language != "") {
        $url .= "&with_original_language=" . $language;
    }
    if ($sort != "") {
        $url .= "&sort_by=" . $sort;
    }
    echo fetchData($url);
}

/**
 * @param $query
 * @param $page
 * @return void
 */
function searchMovie($query, $page)
{
    $url = "https://api.themoviedb.org/3/search/movie?query=" . $query . "&include_adult=false&language=en-US&page=" . $page;
    echo fetchData($url);
}

/**
 * @param $query
 * @param $page
 * @return void
 */
function searchTv($query, $page)
{
    $url = "https://api.themoviedb.org/3/search/tv?query=" . $query . "&include_adult=false&language=en-US&page=" . $page;
    echo fetchData($url);
}

/**
 * @param $id
 * @param $page
 * @return void
 */
function recommendedMovie($id, $page)
{
    $url = "https://api.themoviedb.org/3/movie/" . $id . "/recommendations?page=" . $page;
    echo fetchData($url);
}

/**
 * @param $id
 * @param $page
 * @return void
 */
function recommendedTv($id, $page)
{
    $url = "https://api.themoviedb.org/3/tv/" . $id . "/recommendations?page=" . $page;
    //echoJson("url", $url);
    echo fetchData($url);
}

/**
 * @param $id
 * @return void
 */
function detailsMovie($id){
    $url = "https://api.themoviedb.org/3/movie/" . $id;
    echo fetchData($url);
}

/**
 * @param $id
 * @return void
 */
function detailsTv($id){
    $url = "https://api.themoviedb.org/3/tv/" . $id;
    echo fetchData($url);
}

/**
 * @param $id
 * @return void
 */
function streamingDataMovie($id){
    $url = "https://api.themoviedb.org/3/movie/" . $id. "/watch/providers";
    echo fetchData($url);
}

/**
 * @param $id
 * @return void
 */
function streamingDataTv($id){
    $url = "https://api.themoviedb.org/3/tv/" . $id. "/watch/providers";
    echo fetchData($url);
}

/**
 * @param $page
 * @return void
 */
function popularMovie($page){
    $url = "https://api.themoviedb.org/3/movie/popular?page=" . $page;
    echo fetchData($url);
}

/**
 * @param $page
 * @return void
 */
function popularTv($page){
    $url = "https://api.themoviedb.org/3/tv/popular?page=" . $page;
    echo fetchData($url);
}

/**
 * @param $page
 * @return void
 */
function upcomingMovie($page){
    $url = "https://api.themoviedb.org/3/movie/upcoming?page=" . $page;
    echo fetchData($url);
}

/**
 * @param $page
 * @return void
 */
function nowPlaying($page){
    $url = "https://api.themoviedb.org/3/movie/now_playing?page=" . $page;
    echo fetchData($url);
}

function genre($mediaType){
    $url = "https://api.themoviedb.org/3/genre/" . $mediaType . "/list?language=en";
    echo fetchData($url);
}


//streaming detail recommend
