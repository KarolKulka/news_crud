<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interface\ToArrayInterface;
use DateTime;
use Exception;

/**
 * Class NewsEntity
 * @package App\Entity
 *
 * @method NewsEntity fillProperties(array $dataToFill)
 */
class NewsEntity extends BaseEntity implements ToArrayInterface
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var string
     */
    protected string $begin;

    /**
     * @var string
     */
    protected string $content;

    /**
     * @var string
     */
    protected string $createtime;

    /**
     * @var string
     */
    protected string $updatetime;

    /**
     * Return id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id ?? 0;
    }

    /**
     * Return name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name ?? '';
    }

    /**
     * Return content
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content ?? '';
    }

    /**
     * Return createtime as DateTime object
     *
     * @return DateTime
     * @throws Exception
     */
    public function getCreateTime(): DateTime
    {
        return new DateTime($this->createtime ?? 'NOW');
    }

    /**
     * Return updatetime as DateTime object
     *
     * @return DateTime
     * @throws Exception
     */
    public function getUpdateTime(): DateTime
    {
        return new DateTime($this->updatetime ?? 'NOW');
    }

    /**
     * Return begin
     *
     * @return string
     */
    public function getBegin(): string
    {
        return $this->begin;
    }

    /**
     * Return NewsEntity as array
     *
     * @return array
     * @throws Exception
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'begin' => $this->getBegin(),
            'content' => $this->getContent(),
            'createtime' => $this->getCreateTime()->format('Y-m-d H:i:s'),
            'updatetime' => $this->getUpdateTime()->format('Y-m-d H:i:s'),
        ];
    }
}
