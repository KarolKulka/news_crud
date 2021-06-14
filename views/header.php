<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/main.min.css">

    <?php
    /** @var GlobalViewEntity $globalData */

    use App\Entity\GlobalViewEntity; ?>
    <title><?= $globalData->getTitle() ?></title>

</head>
<body>
<div class="body-background"><img src="/assets/images/bckg.jpg" alt="Application background"></div>
<div class="container">
    <div class="row">
        <div class="col-12 text-center mb-5">
            <h1><?= $globalData->getHeader() ?></h1>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <?php
            if (!empty($errors)) { ?>
                <div class="border border-danger pt-3 pb-1 mb-5">
                    <ul class="fa-ul">
                        <?php
                        foreach ($errors as $error) { ?>
                            <li class="text-danger">
                                <span class="fa-li"><i class="fas fa-exclamation-circle"></i></span>
                                <?= $error ?>
                            </li>
                        <?php
                        } ?>
                    </ul>
                </div>
            <?php
            } ?>
        </div>
        <div class="col-12">
            <?php
            if (!empty($successes)) { ?>
                <div class="border border-success pt-3 pb-1 mb-5">
                    <ul class="fa-ul">
                        <?php
                        foreach ($successes as $success) { ?>
                            <li class="text-success">
                                <span class="fa-li"><i class="fas fa-exclamation-circle"></i></span>
                                <?= $success ?>
                            </li>
                            <?php
                        } ?>
                    </ul>
                </div>
                <?php
            } ?>
        </div>
    </div>
</div>
