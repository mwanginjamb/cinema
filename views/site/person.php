<?php
use yii\helpers\Url;

?>

<!-- Affiliate Banner -->
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

<div class="person-content" style="display: none;">
    <div class="person-header">
        <div class="profile-container">
            <img class="profile-image" src="" alt="">
        </div>
        <div class="header-info">
            <h1 class="name"></h1>
            <div class="meta-info">
                <span class="birth-date"></span>
                <span class="death-date"></span>
                <span class="birth-place"></span>
            </div>
            <div class="department"></div>
        </div>
    </div>

    <section class="biography">
        <h2>Biography</h2>
        <p class="biography-text"></p>

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

    <section class="known-for">
        <h2>Known For</h2>
        <div class="known-for-grid">
            <!-- Will be populated via JavaScript -->
        </div>
    </section>

    <section class="filmography">
        <h2>Filmography</h2>
        <div class="filmography-list">
            <!-- Will be populated via JavaScript -->
        </div>
    </section>
</div>


<?php

/** @var yii\web\View $this */


$this->registerJsFile(Url::to('@web/js/person.js'));