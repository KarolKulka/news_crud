<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\BaseController;
use App\Entity\GlobalViewEntity;
use App\Entity\Helper\UrlEntity;
use App\Entity\NewsEntity;
use App\Helper\RequestHelper;
use App\Helper\ResponseHelper;
use App\Helper\UrlHelper;
use App\Repository\NewsRepository;

/**
 * Class NewsController
 * @package App\Controller\Admin
 *
 * @property NewsRepository $repository
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
     * Display all news list
     */
    public function listNews()
    {
        $this->render(
            'admin/news/listNews.php',
            [
                'listNews'                             => $this->repository->getAllNews(),
                GlobalViewEntity::VIEW_DATA_TITLE_KEY  => 'News List',
                GlobalViewEntity::VIEW_DATA_HEADER_KEY => 'News List',
            ]
        );
    }

    /**
     * Deletes news based on id passed in $_GET['id']
     */
    public function deleteNews()
    {
        $news = $this->repository->getNewsById(intval(RequestHelper::findRequestGetParam('id')));

        if (!empty($news)) {
            if (!$this->repository->delete($news->getId())) {
                $this->addError("Couldn't delete news.");
            }else{
                $this->addSuccess('News '.$news->getName().' deleted');
            }
        } else {
            $this->addError("Couldn't delete news. News for given ID doesn't exists");
        }

        ResponseHelper::redirect(
            UrlHelper::getSiteUrl(
                UrlEntity::create()->setControllerValue('admin')->setActionValue(
                    'news'
                )->setMethodValue('list-news')
            )
        );
    }

    /**
     * Add news action. If request isn't post it displays form. If request is post then invoke method to process post
     * data
     */
    public function addNews()
    {
        if (RequestHelper::isPostRequest()) {
            $this->addNewsPost();
        }

        $this->render(
            'admin/news/add.php',
            [
                GlobalViewEntity::VIEW_DATA_TITLE_KEY  => 'Add news',
                GlobalViewEntity::VIEW_DATA_HEADER_KEY => 'Add news',
            ]
        );
    }

    /**
     * Process post data from add form to add new news to database
     */
    public function addNewsPost()
    {
        $news = new NewsEntity();
        $news->fillProperties(RequestHelper::getPost());

        //TODO: add data validation

        if (!$this->repository->insertNews($news)) {
            $this->addError("Error occurred during adding new News entry!");
            ResponseHelper::redirect(
                UrlHelper::getSiteUrl(
                    UrlEntity::create()->setControllerValue('admin')->setActionValue(
                        'news'
                    )->setMethodValue('list-news')
                )
            );
        }

        $this->addSuccess('New news added: '.$news->getName());
        ResponseHelper::redirect(
            UrlHelper::getSiteUrl(
                UrlEntity::create()->setControllerValue('admin')->setActionValue(
                    'news'
                )->setMethodValue('list-news')
            )
        );
    }

    /**
     * Edit existing news
     */
    public function editNews()
    {
        if (RequestHelper::isPostRequest()) {
            $this->editNewsPost();
        }

        $news = $this->repository->getNewsById(intval(RequestHelper::findRequestGetParam('id')));

        if (empty($news)) {
            $this->addError("News entry for given ID doesn't exists!");
            ResponseHelper::redirect(
                UrlHelper::getSiteUrl(
                    UrlEntity::create()->setControllerValue('admin')->setActionValue(
                        'news'
                    )->setMethodValue('list-news')
                )
            );
        }

        $this->render(
            'admin/news/edit.php',
            [
                'newsItem'                             => $news,
                GlobalViewEntity::VIEW_DATA_TITLE_KEY  => 'Edit: ' . $news->getName(),
                GlobalViewEntity::VIEW_DATA_HEADER_KEY => 'Edit: ' . $news->getName(),
            ]
        );
    }

    /**
     * Process data from edit form
     */
    public function editNewsPost()
    {
        $news = $this->repository->getNewsById(intval(RequestHelper::getPostValue('id')));
        $news->fillProperties(RequestHelper::getPost());

        //TODO: add data validation

        if (!$this->repository->updateNews($news)) {
            $this->addError("Error occurred during update News entry!");
            ResponseHelper::redirect(
                UrlHelper::getSiteUrl(
                    UrlEntity::create()->setControllerValue('admin')->setActionValue(
                        'news'
                    )->setMethodValue('edit-news')->setIdValue($news->getId())
                )
            );
        }

        $this->addSuccess('News updated: '.$news->getName());
        ResponseHelper::redirect(
            UrlHelper::getSiteUrl(
                UrlEntity::create()->setControllerValue('admin')->setActionValue(
                    'news'
                )->setMethodValue('list-news')
            )
        );
    }
}
