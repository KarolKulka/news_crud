<?php
declare(strict_types=1);

namespace App\Repository;

use App\Collection\NewsCollection;
use App\Entity\NewsEntity;

/**
 * Class NewsRepository
 * @package App\Repository
 *
 * @method NewsEntity fetchObject()
 */
class NewsRepository extends BaseRepository
{
    /**
     * @var string
     */
    protected string $tableName = 'news';

    /**
     * @var string
     */
    protected string $primaryKey = 'id';

    /**
     * @var string[]
     */
    protected array $allowedColumns = [
        'id',
        'name',
        'begin',
        'content',
        'createtime',
    ];

    /**
     * @var string
     */
    protected string $returnObject = NewsEntity::class;

    /**
     * @var string
     */
    protected string $returnCollection = NewsCollection::class;

    /**
     * NewsRepository constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get news with given id value
     *
     * @param int $id
     * @return NewsEntity|null
     */
    public function getNewsById(int $id): ?NewsEntity
    {
        $this->find($id);

        return $this->fetchObject();
    }

    /**
     * Update news data in database
     *
     * @param NewsEntity $newsEntity
     * @return bool
     */
    public function updateNews(NewsEntity $newsEntity): bool
    {
        $this->query(
            "UPDATE $this->tableName 
                        SET name = :name,
                        begin = :begin,
                        content = :content
                        WHERE $this->primaryKey = :$this->primaryKey",
            $newsEntity,
            [
                'name',
                'begin',
                'content',
                $this->primaryKey
            ]
        );

        return $this->getLastExecuteResult();
    }

    /**
     * Insert new news in database
     *
     * @param NewsEntity $newsEntity
     * @return bool
     */
    public function insertNews(NewsEntity $newsEntity): bool
    {
        $this->query(
            "INSERT $this->tableName
                    SET name = :name,
                    begin = :begin,
                    content = :content
            ",
            $newsEntity,
            [
                'name',
                'begin',
                'content',
            ]
        );

        return $this->getLastExecuteResult();
    }

    /**
     * Return all existing news in given order
     *
     * @param array|string[] $order
     * @return NewsCollection
     */
    public function getAllNews(array $order = ['createtime' => 'DESC']): NewsCollection
    {
        reset($order);
        $news = $this->query(
            "SELECT * FROM $this->tableName ORDER BY ".key($order)." ".$order[key($order)],
        )
            ->fetchAll();

        return $news;
    }
}
