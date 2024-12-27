<?php
/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Discover the latest movies and TV shows with our comprehensive database. Get real-time updates on box office hits, ratings, reviews, and upcoming releases worldwide.">
    <meta name="keywords"
        content="movies, TV shows, box office, cinema, film database, movie ratings, TV series, entertainment, movie reviews">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Movie Explorer - Your Ultimate Movie & TV Show Database">
    <meta property="og:description"
        content="Explore the world of cinema with real-time updates on movies, TV shows, box office performance, and entertainment news.">
    <meta property="og:type" content="website">
    <meta property="og:image" content="/images/movie-explorer-preview.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Movie Explorer - Your Ultimate Movie & TV Show Database">
    <meta name="twitter:description"
        content="Explore the world of cinema with real-time updates on movies, TV shows, box office performance, and entertainment news.">
    <meta name="p:domain_verify" content="d386f29c270fa395837d664ce8e8297d" />
    <link rel="canonical" href="https://boxoffice.gumzosystems.com/" />
    <title>Movie Explorer</title>
    <?php $this->head() ?>
    <script defer src="https://analytics.gumzosystems.com/custom"
        data-website-id="<?= env('ANALYTICS_CODE') ?>"></script>
    <!-- <script defer src="script.js"></script> -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "MovieBox",
      "url": "https://boxoffice.gumzosystems.com",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://boxoffice.gumzosystems.com/search?q={search_term_string}",
        "query-input": "required name=search_term_string"
      },
      "description": "Your ultimate destination for movies and TV shows information, including box office updates, ratings, and reviews.",
      "publisher": {
        "@type": "Organization",
        "name": "MovieBox",
        "logo": {
          "@type": "ImageObject",
          "url": "https://boxoffice.gumzosystems.com/images/logo.png"
        }
      }
    }
    </script>
</head>

<body>
    <?php $this->beginBody() ?>
    <header>
        <h1>Movie Explorer</h1>
        <div class="filter-section">
            <div class="filter-group">
                <select id="mediaType">
                    <option value="movie">Movies</option>
                    <option value="tv">TV Shows</option>
                </select>
                <select id="sortBy">
                    <option value="popularity.desc">Popularity</option>
                    <option value="vote_average.desc">Rating</option>
                    <option value="release_date.desc">Release Date</option>
                </select>
                <select id="genre" multiple>
                    <option value="">All Genres</option>
                    <!-- Will be populated via JavaScript -->
                </select>
                <select id="country" multiple>
                    <option value="">All Countries</option>
                    <!-- Will be populated via JavaScript -->
                </select>
            </div>
            <div class="filter-group">
                <input type="text" id="searchInput" placeholder="Search...">
                <select id="year" multiple>
                    <option value="">All Years</option>
                    <!-- Will be populated via JavaScript -->
                </select>
                <button id="clearFilters">Clear Filters</button>
                <button id="filterToggle" class="mobile-only">
                    <i class="fas fa-filter"></i>
                </button>
            </div>
        </div>
    </header>

    <main>
        <div class="affiliate-banner" id="affiliateBanner">
            <a href="#" target="_blank" rel="nofollow sponsored"></a>
            <button class="banner-close" id="closeBanner" aria-label="Close banner">×</button>
        </div>
        <div class="banner-toggle" id="bannerToggle">
            <button class="toggle-button">View Amazing Amazon Deals</button>
        </div>



        <?= $content; ?>



        <template id="movieTemplate">
            <div class="movie-card">
                <div class="poster-container">
                    <img class="movie-poster" src="" alt="">
                    <button class="favorite-btn">
                        <i class="far fa-bookmark"></i>
                    </button>
                </div>
                <div class="movie-info">
                    <h3 class="movie-title"></h3>
                    <div class="movie-meta">
                        <span class="release-date"></span>
                        <span class="rating"><i class="fas fa-star"></i> <span class="rating-value"></span></span>
                    </div>
                </div>
            </div>
        </template>
    </main>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>