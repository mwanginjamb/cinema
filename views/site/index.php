<?php

/** @var yii\web\View $this */
use yii\helpers\Url;

$this->title = 'Welcome to Gumzo BoxOffice Explorer';
?>

<div class="tabs">
    <button class="tab active" data-tab="discover">Discover</button>
    <button class="tab" data-tab="favorites">Favorites</button>
</div>
<div class="content-section">
    <div id="movieGrid" class="movie-grid">
        <!-- Movies will be populated here -->
    </div>
</div>

<?php



/** @var yii\web\View $this */


$this->registerJsFile(Url::to('@web/js/app.js'));