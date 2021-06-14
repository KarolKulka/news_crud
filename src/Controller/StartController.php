<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\GlobalViewEntity;
use App\Repository\BaseRepository;

/**
 * Class StartController
 * @package App\Controller
 */
class StartController extends BaseController
{
    /**
     * StartController constructor.
     */
    public function __construct()
    {
        parent::__construct(new class extends BaseRepository{});
    }

    /**
     * Display starting page with welcome
     */
    public function start()
    {
        $this->render(
            'welcome.php',
            [
                GlobalViewEntity::VIEW_DATA_TITLE_KEY  => 'Welcome',
                GlobalViewEntity::VIEW_DATA_HEADER_KEY => 'Welcome :)',
            ]
        );
    }
}
