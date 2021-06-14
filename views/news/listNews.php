<?php

use App\Collection\NewsCollection;
use App\Entity\Helper\UrlEntity;
use App\Entity\NewsEntity;
use App\Helper\UrlHelper;

/** @var NewsCollection $listNews */
/** @var NewsEntity $newsItem */
?>
<div class="container news-list">
    <div class="row">
        <?php
        foreach ($listNews as $newsItem) { ?>
            <div class="col-12 position-relative news-list-item">
                <h2 class="news-list-item-name"><?= $newsItem->getName() ?></h2>
                <span class="news-list-item-date"><?= $newsItem->getCreateTime()->format('H:i - d/m/Y') ?></span>
                <p class="news-list-item-begin"><?= $newsItem->getBegin() ?></p>
                <a href="<?= UrlHelper::getSiteUrl(
                    UrlEntity::create()->setControllerValue('news')->setMethodValue('news')->setIdValue(
                        $newsItem->getId()
                    )
                ) ?>" class="btn btn-outline-dark stretched-link">Read more</a>
                <hr>
            </div>
        <?php
        } ?>

        <?php
        if (empty($listNews->toArray())) { ?>
            <div class="col-12">
                <h2 class="text-warning text-center">There are no newses to display</h2>
            </div>
        <?php
        } ?>

        <div class="col-12 mt-5">
            <a class="btn btn-outline-secondary" href="<?= UrlHelper::getSiteUrl(UrlEntity::create()) ?>">Return</a>
        </div>
    </div>
</div>