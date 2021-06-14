<?php

use App\Entity\Helper\UrlEntity;
use App\Helper\UrlHelper;

?>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 col-xl-2 offset-xl-4">
            <a class="btn btn-primary" href="<?= UrlHelper::getSiteUrl(UrlEntity::create()->setControllerValue('news')->setMethodValue('list-news')) ?>">News list</a>
        </div>
        <div class="col-12 col-md-6 col-xl-2 offset-xl-1">
            <a class="btn btn-outline-success" href="<?= UrlHelper::getSiteUrl(UrlEntity::create()->setControllerValue('admin')->setActionValue(
                'news')->setMethodValue('list-news')) ?>">Admin</a>
        </div>
    </div>
</div>
