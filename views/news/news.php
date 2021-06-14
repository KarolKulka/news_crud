<?php

use App\Entity\Helper\UrlEntity;
use App\Entity\NewsEntity;
use App\Helper\UrlHelper;

/** @var NewsEntity $newsItem */

?>
<div class="container news-item">
    <div class="row">
        <?php
        if (!empty($newsItem->getBegin())) { ?>
            <div class="col-12 news-item-begin">
                <?= $newsItem->getBegin() ?>
                <hr>
            </div>
            <?php
        } ?>
        <div class="col-12 news-item-content">
            <?= $newsItem->getContent() ?>
        </div>
        <div class="col-12">
            <div class="news-item-date">
                <?= $newsItem->getCreateTime()->format('H:i - d/m/Y') ?>
            </div>
        </div>
        <div class="col-12 mt-5">
            <a class="btn btn-outline-secondary" href="<?= UrlHelper::getSiteUrl(
                UrlEntity::create()->setControllerValue('news')->setMethodValue('list-news')
            ) ?>">Return</a>
        </div>
    </div>
</div>