<?php
declare(strict_types=1);

namespace App\Entity;

/**
 * Class GlobalViewEntity
 * @package App\Entity
 */
class GlobalViewEntity
{
    const VIEW_DATA_TITLE_KEY = 'globalTitle';
    const VIEW_DATA_HEADER_KEY = 'globalHeader';

    /**
     * @var string
     */
    protected string $title = 'Strona Główna';

    /**
     * @var string
     */
    protected string $header = 'Witamy';

    /**
     * Return title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Return header
     *
     * @return string
     */
    public function getHeader(): string
    {
        return $this->header;
    }

    /**
     * Set header
     *
     * @param string $header
     * @return self
     */
    public function setHeader(string $header): self
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Prepare title and header data based on passed values in array on proper key
     *
     * @param array $data
     * @return self
     */
    public function prepareGlobalData(array $data): self
    {
        if (isset($data[self::VIEW_DATA_TITLE_KEY])){
            $this->setTitle($data[self::VIEW_DATA_TITLE_KEY]);
        }

        if (isset($data[self::VIEW_DATA_HEADER_KEY])){
            $this->setHeader($data[self::VIEW_DATA_HEADER_KEY]);
        }

        return $this;
    }
}
