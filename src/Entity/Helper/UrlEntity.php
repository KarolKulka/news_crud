<?php
declare(strict_types=1);

namespace App\Entity\Helper;

use App\Entity\BaseEntity;
use App\Interface\StaticFactoryInterface;
use App\Interface\ToArrayInterface;
use App\Trait\StaticFactoryTrait;

/**
 * Class UrlEntity
 * @package App\Entity\Helper
 *
 * @method static UrlEntity create()
 */
class UrlEntity extends BaseEntity implements ToArrayInterface, StaticFactoryInterface
{
    use StaticFactoryTrait;

    /**
     * @var string
     */
    protected string $controllerValue;

    /**
     * @var string
     */
    protected string $actionValue;

    /**
     * @var string
     */
    protected string $methodValue;

    /**
     * @var int
     */
    protected int $idValue;

    /**
     * Return entity in array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'cl'     => $this->getControllerValue(),
            'action' => $this->getActionValue(),
            'method' => $this->getMethodValue(),
            'id'     => $this->getIdValue(),
        ];
    }

    /**
     * Return controllerValue
     *
     * @return string
     */
    public function getControllerValue(): string
    {
        return $this->controllerValue ?? '';
    }

    /**
     * Set controllerValue
     *
     * @param string $controllerValue
     * @return UrlEntity
     */
    public function setControllerValue(string $controllerValue): UrlEntity
    {
        $this->controllerValue = $controllerValue;

        return $this;
    }

    /**
     * Return actionValue
     *
     * @return string
     */
    public function getActionValue(): string
    {
        return $this->actionValue ?? '';
    }

    /**
     * Set actionValue
     *
     * @param string $actionValue
     * @return UrlEntity
     */
    public function setActionValue(string $actionValue): UrlEntity
    {
        $this->actionValue = $actionValue;

        return $this;
    }

    /**
     * Return methodValue
     *
     * @return string
     */
    public function getMethodValue(): string
    {
        return $this->methodValue ?? '';
    }

    /**
     * Set methodValue
     *
     * @param string $methodValue
     * @return UrlEntity
     */
    public function setMethodValue(string $methodValue): UrlEntity
    {
        $this->methodValue = $methodValue;

        return $this;
    }

    /**
     * Return idValue
     *
     * @return int
     */
    public function getIdValue(): int
    {
        return $this->idValue ?? 0;
    }

    /**
     * Set idValue
     *
     * @param int $idValue
     * @return UrlEntity
     */
    public function setIdValue(int $idValue): UrlEntity
    {
        $this->idValue = $idValue;

        return $this;
    }
}
