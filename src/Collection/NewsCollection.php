<?php
declare(strict_types=1);

namespace App\Collection;

use App\Entity\NewsEntity;

/**
 * Class NewsCollection
 * @package App\Collection
 *
 * @method static NewsCollection create()
 * @property NewsEntity[] $collection
 */
class NewsCollection extends Collection
{
    /**
     * Add NewsEntity to collection. If index is passed as param then item is added on given index
     *
     * @param NewsEntity|null $newsEntity
     * @param int|null $index
     * @return $this
     */
    public function add(NewsEntity $newsEntity = null, int $index = null): self
    {
        if (!is_null($newsEntity)) {
            if (!is_null($index)) {
                $this->collection[$index] = $newsEntity;
            } else {
                $this->collection[] = $newsEntity;
            }
        }

        return $this;
    }

    /**
     * Return News entity from collection on given index
     *
     * @param int|null $index
     * @return NewsEntity|null
     */
    public function get(int $index = null): ?NewsEntity
    {
        if (is_null($index) || !$this->isset($index)){
            return null;
        }

        return $this->collection[$index];
    }
}
