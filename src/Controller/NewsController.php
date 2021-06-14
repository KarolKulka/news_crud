<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\GlobalViewEntity;
use App\Entity\Helper\UrlEntity;
use App\Helper\RequestHelper;
use App\Helper\ResponseHelper;
use App\Helper\UrlHelper;
use App\Repository\NewsRepository;

/**
 * Class NewsController
 * @package App\Controller
 */
class NewsController extends BaseController
{
    /**
     * NewsController constructor.
     */
    public function __construct()
    {
        parent::__construct(new NewsRepository());
    }

    /**
     * Display all existing news from newest to oldest
     */
    public function listNews()
    {
        $this->render(
            'news/listNews.php',
            [
                'listNews'                             => $this->repository->getAllNews(),
                GlobalViewEntity::VIEW_DATA_TITLE_KEY  => 'News List',
                GlobalViewEntity::VIEW_DATA_HEADER_KEY => 'News List',
            ]
        );
    }

    /**
     * Display one news
     */
    public function news()
    {
        $news = $this->repository->getNewsById(intval(RequestHelper::findRequestGetParam('id')));

        if (is_null($news)) {
            $this->addError("This news doesn't exist");
            ResponseHelper::redirect(
                UrlHelper::getSiteUrl(
                    UrlEntity::create()
                )
            );
        }

        $this->render(
            'news/news.php',
            [
                'newsItem'                             => $news,
                GlobalViewEntity::VIEW_DATA_TITLE_KEY  => $news->getName() . ' - News',
                GlobalViewEntity::VIEW_DATA_HEADER_KEY => $news->getName(),
            ]
        );
    }
}
