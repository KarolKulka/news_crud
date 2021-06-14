<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\GlobalViewEntity;
use App\Helper\SessionHelper;
use App\Library\View;
use App\Repository\BaseRepository;

/**
 * Class BaseController
 * @package App\Controller
 */
abstract class BaseController
{
    /**
     * @var BaseRepository
     */
    protected BaseRepository $repository;

    /**
     * @var View
     */
    protected View $view;

    /**
     * BaseController constructor.
     * @param BaseRepository $repository
     */
    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
        $this->view = new View();
    }

    /**
     * Call render method in View Library and pass prepared data for views
     *
     * @param string $viewName
     * @param array $data
     */
    protected function render(string $viewName, array $data = [])
    {
        $this->view->renderView($viewName, $this->prepareViewData($data));
    }

    /**
     * Prepares Globally accessible data in all views based on passed view data
     *
     * @param array $data
     * @return array
     */
    protected function prepareViewData(array $data): array
    {
        $globalView = new GlobalViewEntity();

        $data['globalData'] = $globalView->prepareGlobalData($data);
        $data['errors'] = $this->getSessionErrors();
        $data['successes'] = $this->getSessionSuccesses();

        return $data;
    }

    /**
     * Get errors from session
     *
     * @return array|null
     */
    protected function getSessionErrors(): ?array
    {
        $errors = SessionHelper::getSessionValue('error');
        SessionHelper::removeSession('error');
        return $errors;
    }

    /**
     * Get successes from session
     *
     * @return array|null
     */
    protected function getSessionSuccesses(): ?array
    {
        $successes = SessionHelper::getSessionValue('success');
        SessionHelper::removeSession('success');
        return $successes;
    }

    /**
     * Add error string to session
     *
     * @param string $error
     */
    public function addError(string $error): void
    {
        SessionHelper::appendSession('error', $error);
    }

    /**
     * Add success string to session
     *
     * @param string $success
     */
    public function addSuccess(string $success): void
    {
        SessionHelper::appendSession('success', $success);
    }
}
