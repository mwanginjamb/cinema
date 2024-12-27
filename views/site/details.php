<?php

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/** @var yii\web\View $this */
$this->title = $details['title'] ?? 'Box Office Explorer';
$this->registerMetaTag(['name' => 'description', 'content' => $details['overview']]);
$this->registerMetaTag(['name' => 'keywords', 'content' => implode(', ', ArrayHelper::getColumn($details['genres'], 'name'))]);

// Open Graph Tags
$this->registerMetaTag(['property' => 'og-title', 'content' => $details['title'] ?? '']);
$this->registerMetaTag(['property' => 'og-description', 'content' => $details['overview'] ?? '']);
$this->registerMetaTag(['property' => 'og-image', 'content' => env('IMG_BASE_URL') . $details['backdrop_path']]);
$this->registerMetaTag(['property' => 'og-url', 'content' => Url::canonical()]);
$this->registerMetaTag(['property' => 'og:image:alt', 'content' => 'BoxOffice - Cinema Explorer']);
$this->registerMetaTag(['property' => 'og:type', 'content' => 'website']);

// x Tags
$this->registerMetaTag(['name' => 'twitter-title', 'content' => $details['title'] ?? '']);
$this->registerMetaTag(['name' => 'twitter-description', 'content' => $details['overview'] ?? '']);
$this->registerMetaTag(['name' => 'twitter-image', 'content' => env('IMG_BASE_URL') . $details['poster_path']]);
$this->registerMetaTag(['name' => 'twitter:site', 'content' => '@boxoffice']);

// WhatsApp Preview
$this->registerMetaTag(['property' => 'og:site_name', 'content' => 'BoxOffice']);
$this->registerMetaTag(['property' => 'og:locale', 'content' => 'en_US']);
$this->registerMetaTag(['property' => 'og:image:secure_url', 'content' => env('IMG_BASE_URL') . $details['poster_path']]);

?>
<div class="affiliate-banner" id="affiliateBanner">
    <a href="#" target="_blank" rel="nofollow sponsored"></a>
    <button class="banner-close" id="closeBanner" aria-label="Close banner">×</button>
</div>
<div class="banner-toggle" id="bannerToggle">
    <button class="toggle-button">View Amazing Amazon Deals</button>
</div>
<div class="loading-spinner">
    <i class="fas fa-spinner fa-spin"></i>
</div>

<div class="details-content" style="display: none;">
    <div class="details-header">
        <div class="poster-container">
            <img class="movie-poster" src="" alt="">
            <button class="favorite-btn">
                <i class="far fa-bookmark"></i>
            </button>
        </div>
        <div class="header-info">
            <h1 class="title"></h1>
            <div class="meta-info">
                <span class="release-date"></span>
                <span class="runtime"></span>
                <span class="rating">
                    <i class="fas fa-star"></i>
                    <span class="rating-value"></span>
                </span>
            </div>
            <div class="genres"></div>
        </div>
    </div>

    <div class="details-grid">
        <section class="overview">
            <h2>Overview</h2>
            <p class="overview-text"></p>

            <!-- Social Sharing Buttons -->
            <div class="social-share">
                <h3>Share this movie:</h3>
                <div class="share-buttons">
                    <button class="share-btn facebook" id="facebook-share">
                        <i class="fab fa-facebook"></i> Share
                    </button>
                    <button class="share-btn twitter" id="twitter-share">
                        <i class="fab fa-x-twitter"></i> Tweet
                    </button>
                    <button class="share-btn pinterest" id="pinterest-share">
                        <i class="fab fa-pinterest"></i> Pin
                    </button>
                    <button class="share-btn whatsapp" id="whatsapp-share">
                        <i class="fab fa-whatsapp"></i> Share
                    </button>
                </div>
            </div>
        </section>

        <section class="cast">
            <h2>Top Cast</h2>
            <div class="cast-grid"></div>
        </section>

        <section class="additional-info">
            <h2>Additional Information</h2>
            <div class="info-grid">
                <div class="info-item status">
                    <h3>Status</h3>
                    <p></p>
                </div>
                <div class="info-item original-language">
                    <h3>Original Language</h3>
                    <p></p>
                </div>
                <div class="info-item budget">
                    <h3>Budget</h3>
                    <p></p>
                </div>
                <div class="info-item revenue">
                    <h3>Revenue</h3>
                    <p></p>
                </div>
                <div class="info-item production-companies">
                    <h3>Production Companies</h3>
                    <p></p>
                </div>
                <div class="info-item production-countries">
                    <h3>Production Countries</h3>
                    <p></p>
                </div>
            </div>
        </section>

        <section class="videos">
            <h2>Videos</h2>
            <div class="videos-grid"></div>
        </section>

        <section class="similar">
            <h2>Similar Titles</h2>
            <div class="similar-grid"></div>
        </section>
    </div>
</div>

<!-- Structured Data -->
<script type="application/ld+json" id="movie-structured-data">
        {
            "@context": "https://schema.org",
            "@type": "Movie",
            "name": "",
            "image": "",
            "description": "",
            "datePublished": "",
            "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "",
                "ratingCount": ""
            }
        }
        </script>





<?php


/** @var yii\web\View $this */
$this->registerCssFile(Url::to('@web/css/style.css'), [
    'depends' => [\yii\web\YiiAsset::class],
]);
$this->registerJsFile(Url::to('@web/js/config.js'));
$this->registerJsFile(Url::to('@web/js/details.js'));
