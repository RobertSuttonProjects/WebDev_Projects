<?php

?>

<div class="search-container">
    <div class="search-bar-container">
        <h4>Browse</h4>
        <form id="search-filter">
            <select title="search-filter-genre" id="search-filter-genre">
                <option disabled selected hidden value="">Genre</option>
                <option value="">All Genre</option>
            </select>
            <select title="search-filter-year" id="search-filter-year">
                <option disabled selected hidden value="">Year</option>
                <option value="all">All Years</option>
                <!--Try To get years to set up dynamically-->
            </select>
            <select title="search-filter-language" id="search-filter-language">
                <option disabled selected hidden value="">Language</option>
                <option value="All">All</option>
                <option value="en">English</option>
                <option value="es">Spanish</option>
                <option value="fr">French</option>
                <option value="de">German</option>
            </select>
            <select title="search-filter-sort" id="search-filter-sort">
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

        <h4>Search</h4>
        <form id="search-query">
            <input type="text" id="search-bar" placeholder="Search">
            <button type="submit" form="search-query" value="Submit" class="fa-solid fa-search"></button>
        </form>
    </div>
</div>
<div class="search-results-container">
    <?php include("assets/templates/slider.php"); ?>
</div>






