<?php
/** @var yii\web\View $this */
/** @var string $content */

use yii\helpers\Html;
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
    <?php $this->head() ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <script defer src="https://analytics.gumzosystems.com/custom"
        data-website-id="<?= env('ANALYTICS_CODE') ?>"></script>
    <script defer src="script.js"></script>
    <title><?= Html::encode($this->title) ?></title>

</head>

<body class="details-page">
    <?php $this->beginBody() ?>
    <header>
        <nav>
            <a href="/" class="back-button">
                <i class="fas fa-arrow-left"></i> Back to Movies
            </a>
        </nav>
    </header>

    <main class="details-container">
        <?= $content ?>
    </main>


    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>