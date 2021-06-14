<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\BaseController;
use App\Entity\Helper\UrlEntity;
use App\Helper\RequestHelper;
use App\Helper\ResponseHelper;
use App\Helper\UrlHelper;
use App\Repository\BaseRepository;

/**
 * Class AdminController
 * @package App\Controller\Admin
 */
class AdminController extends BaseController
{
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        parent::__construct(
            new class extends BaseRepository {
            }
        );
    }

    /**
     * Admin Routing
     *
     * @param string $adminAction
     * @return mixed
     */
    public function adminRoutes(string $adminAction): mixed
    {
        //TODO: implement admin authentication via login form
        switch ($adminAction) {
            case 'news':
                $news = new NewsController();
                if (RequestHelper::verifyControllerMethod($news)) {
                    return call_user_func_array(
                        [new NewsController(), RequestHelper::getRequestControllerMethod()],
                        []
                    );
                }
                $this->addError("Requested method not found");
                break;
            default:
                $this->addError("Requested module not found");
                break;
        }

        if (isset($_SERVER['HTTP_REFERER'])) {
            ResponseHelper::redirect($_SERVER['HTTP_REFERER']);
        } else {
            ResponseHelper::redirect(UrlHelper::getSiteUrl(UrlEntity::create()));
        }
    }
}
