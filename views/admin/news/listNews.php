<?php

use App\Collection\NewsCollection;
use App\Entity\Helper\UrlEntity;
use App\Entity\NewsEntity;
use App\Helper\UrlHelper;

/** @var NewsCollection $listNews */
/** @var NewsEntity $newsItem */
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <a class="btn btn-success" href="<?= UrlHelper::getSiteUrl(
                UrlEntity::create()->setControllerValue('admin')->setActionValue(
                    'news'
                )->setMethodValue('add-news')
            ) ?>">Add</a>
        </div>
        <div class="col-12">
            <table class="table table-striped table-hover vertical-middle">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Option</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                foreach ($listNews->getIterator() as $newsItem) { ?>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td><?= $newsItem->getName() ?></td>
                        <td>
                            <a class="btn btn-primary" href="<?= UrlHelper::getSiteUrl(
                                UrlEntity::create()->setControllerValue('admin')->setActionValue(
                                    'news'
                                )->setMethodValue('edit-news')->setIdValue($newsItem->getId())
                            ) ?>">Edit</a>
                            <a class="btn btn-danger confirm-action" href="<?= UrlHelper::getSiteUrl(
                                UrlEntity::create()->setControllerValue('admin')->setActionValue(
                                    'news'
                                )->setMethodValue('delete-news')->setIdValue($newsItem->getId())
                            ) ?>" data-name="<?= $newsItem->getName() ?>">Delete</a>
                        </td>
                    </tr>
                    <?php
                    $i++; ?>
                <?php
                } ?>
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <a class="btn btn-outline-secondary" href="<?= UrlHelper::getSiteUrl(UrlEntity::create()) ?>">Return</a>
        </div>
    </div>
</div>