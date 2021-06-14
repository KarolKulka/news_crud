<?php
declare(strict_types = 1);

namespace App\Collection;

use App\Interface\StaticFactoryInterface;
use App\Interface\ToArrayInterface;
use App\Trait\StaticFactoryTrait;
use ArrayIterator;
use Countable;
use IteratorAggregate;

/**
 * Class Collection
 * @package App\Collections
 */
abstract class Collection implements StaticFactoryInterface, Countable, IteratorAggregate, ToArrayInterface
{
    use StaticFactoryTrait;

    /**
     * @var bool
     */
    protected bool $allowNullValue = true;

    /**
     * @var array
     */
    protected array $collection;

    /**
     * Collection constructor.
     * @param array|null $collection
     */
    public function __construct(?array $collection = null)
    {
        $this->collection = $collection ?? [];
    }

    /**
     * Sets collection
     *
     * @param array $collection
     * @return self
     */
    public function set(array $collection): self
    {
        $this->collection = [];

        foreach ($collection as $index => $value) {
            $this->add($value, $index);
        }

        return $this;
    }

    /**
     * Unset collection item on given index
     *
     * @param $index
     * @return self
     */
    public function unset($index): self
    {
        if ($this->isset($index)) {
            unset($this->collection[$index]);
        }

        return $this;
    }

    /**
     * Checks if given index is set in collection
     *
     * @param $index
     * @return bool
     */
    public function isset($index): bool
    {
        return isset($this->collection[$index]);
    }

    /**
     * Return array iterator for collection
     *
     * {@inheritdoc}
     * @return ArrayIterator
     * @see http://php.net/manual/en/class.iteratoraggregate.php
     * @see \IteratorAggregate::getIterator()
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->collection);
    }

    /**
     * Count items in collection
     *
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->collection ?? []);
    }

    /**
     * Return collection as array
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->collection;
    }

    /**
     * Add item to collection
     *
     * @return mixed
     */
    abstract public function add();

    /**
     * Return item from collection
     *
     * @return mixed
     */
    abstract public function get();
}
