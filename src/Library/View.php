<?php
declare(strict_types=1);

namespace App\Library;

use App\Entity\GlobalViewEntity;

/**
 * Class View
 * @package App\Library
 */
class View
{
    /**
     * @var string
     */
    protected string $basePath = './views/';

    /**
     * @var string
     */
    protected string $headerName = 'header.php';

    /**
     * @var string
     */
    protected string $footerName = 'footer.php';

    /**
     * @var array
     */
    protected array $data = [];

    /**
     * @var GlobalViewEntity
     */
    protected GlobalViewEntity $globalData;

    /**
     * Return path to given view
     *
     * @param string $viewName
     * @return string
     */
    protected function getViewPath(string $viewName): string
    {
        return $this->basePath . $viewName;
    }

    /**
     * Render given view and header and footer views. Extract data so it's accessible in views
     *
     * @param string $viewName
     * @param array $data
     */
    public function renderView(string $viewName, array $data = [])
    {
        extract($data);

        require $this->getHeader();
        require $this->getViewPath($viewName);
        require $this->getFooter();
    }

    /**
     * Return header path
     *
     * @return string
     */
    protected function getHeader(): string
    {
        return $this->basePath . $this->headerName;
    }

    /**
     * Return footer path
     *
     * @return string
     */
    protected function getFooter(): string
    {
        return $this->basePath . $this->footerName;
    }
}
