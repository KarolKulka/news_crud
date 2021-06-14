<?php

use App\Entity\Helper\UrlEntity;
use App\Entity\NewsEntity;
use App\Helper\UrlHelper;

/** @var NewsEntity $newsItem */

?>
<div class="container">
    <form method="post" action="<?= UrlHelper::getSiteUrl(
        UrlEntity::create()->setControllerValue('admin')->setActionValue(
            'news'
        )->setMethodValue('edit-news')->setIdValue($newsItem->getId())
    ) ?>">
        <div class="row">
            <div class="col-12 col-md-6 ">
                <div class="form-group">
                    <label for="name">Page Name</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Page Name"
                           value="<?= $newsItem->getName() ?>">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="begin">Begin</label>
                    <textarea class="form-control" name="begin" id="begin" cols="30" rows="10"
                              placeholder="Begin..."><?= $newsItem->getBegin() ?></textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" name="content" id="content" cols="30" rows="10"
                              placeholder="Content..."><?= $newsItem->getContent() ?></textarea>
                </div>
            </div>
            <input type="hidden" name="id" value="<?= $newsItem->getId() ?>">
            <div class="col-12 col-md-6 mt-2">
                <a class="btn btn-outline-secondary" href="<?= UrlHelper::getSiteUrl(
                    UrlEntity::create()->setControllerValue('admin')->setActionValue(
                        'news'
                    )->setMethodValue('list-news')
                ) ?>">Cancel</a>
                <button type="submit" class="btn btn-success">Save</button>
            </div>

        </div>
    </form>
</div>