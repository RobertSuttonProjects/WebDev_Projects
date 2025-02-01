<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="assets/scripts/movie.js"></script>
    <link rel="stylesheet" href="assets/styles/ai.css">
</head>

<body>
    <form id="movie-filter">
        <select title="movie-filter-genre" id="movie-filter-genre">
            <option disabled selected hidden value="">Genre</option>
            <option value="">All Genre</option>
        </select>
        <select title="movie-filter-year" id="movie-filter-year">
            <option disabled selected hidden value="">Year</option>
            <option value="">All Years</option>
            <!--Try To get years to set up dynamically-->
        </select>
        <select title="movie-filter-language" id="movie-filter-language">
            <option disabled selected hidden value="">Language</option>
            <option value="All">All</option>
            <option value="en">English</option>
            <option value="es">Spanish</option>
            <option value="fr">French</option>
            <option value="de">German</option>
        </select>
        <select title="movie-filter-sort" id="movie-filter-sort">
            <option disabled selected hidden value="">Sort</option>
            <option value="">No Sort</option>
            <option disabled>By Title</option>
            <option value="original_title.asc">Ascending</option>
            <option value="original_title.desc">Desending</option>
            <option disabled>By Popularity Rating</option>
            <option value="popularity.desc">Popular</option>
            <option value="popularity.asc">Unpopular</option>
            <option disabled>By Release Date</option>
            <option value="primary_release_date.asc">Oldest</option>
            <option value="primary_release_date.desc">Newest</option>
        </select>
    </form>

    <form id="movie-search">
        <input type="text" id="search" placeholder="Search">
        <input type="submit" value="Submit" id="submit">
    </form>

    <div id="movie-search-results">

    </div>
</body>

</html>