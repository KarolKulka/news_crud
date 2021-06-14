<?php

declare(strict_types=1);

namespace App\Repository;

use App\Collection\Collection;
use App\Helper\GlobalHelper;
use App\Interface\ToArrayInterface;
use App\Library\Database;
use PDO;
use PDOStatement;

/**
 * Class BaseRepository
 * @package App\Repository
 */
abstract class BaseRepository
{
    /**
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * @var PDOStatement
     */
    protected PDOStatement $stmt;

    /**
     * @var string
     */
    protected string $tableName;

    /**
     * @var string
     */
    protected string $returnObject;

    /**
     * @var string
     */
    protected string $returnCollection;

    /**
     * @var string
     */
    protected string $primaryKey;

    /**
     * @var bool
     */
    protected bool $lastExecuteResult;

    /**
     * @var string[]
     */
    protected array $allowedColumns;

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    /**
     * Return last execute result
     *
     * @return bool
     */
    public function getLastExecuteResult(): bool
    {
        return $this->lastExecuteResult ?? false;
    }

    /**
     * Set last execute result
     *
     * @param bool $result
     * @return self
     */
    protected function setLastExecuteResult(bool $result): self
    {
        $this->lastExecuteResult = $result;

        return $this;
    }

    /**
     * Find and return one row based on given primary key value and primaryKey property as column name
     *
     * @param mixed $id
     * @return self
     */
    public function find(mixed $id): self
    {
        $this->setStatement(
            $this->pdo->prepare("SELECT * FROM $this->tableName WHERE $this->primaryKey = :$this->primaryKey")
        )
            ->bindParam(":$this->primaryKey", $id)
            ->execute();

        return $this;
    }

    /**
     * Execute PDOStatement
     *
     * @return self
     */
    protected function execute(): self
    {
        $this->setLastExecuteResult($this->getStatement()->execute());

        return $this;
    }

    /**
     * Return PDOStatement
     *
     * @return PDOStatement
     */
    protected function getStatement(): PDOStatement
    {
        return $this->stmt;
    }

    /**
     * Bind current statement param based on given param name and value
     *
     * @param string $param
     * @param mixed $value
     * @return self
     */
    protected function bindParam(string $param, mixed $value): self
    {
        $this->stmt->bindParam($param, $value);

        return $this;
    }

    /**
     * Set current PDOStatement
     *
     * @param PDOStatement $PDOStatement
     * @return self
     */
    protected function setStatement(PDOStatement $PDOStatement): self
    {
        $this->setLastExecuteResult(false);
        $this->stmt = $PDOStatement;

        return $this;
    }

    /**
     * Deletes row based on given primary key value and set primaryKey property as column name
     *
     * @param mixed $id
     * @return $this
     */
    public function delete(mixed $id): self
    {
        $this->setStatement(
            $this->pdo->prepare(
                "DELETE 
                            FROM $this->tableName
                            WHERE $this->primaryKey = :$this->primaryKey"
            )
        )
            ->bindParam(":$this->primaryKey", $id)
            ->execute();

        return $this;
    }

    /**
     * Return PDOStatement result
     *
     * @return array|null
     */
    public function fetch(): ?array
    {
        $output = $this->getStatement()->fetch();

        if (!$output) {
            return null;
        }

        return $output;
    }

    /**
     * Return all rows found by PDOStatement
     *
     * @return array|Collection
     */
    public function fetchAll(): array|Collection
    {
        $output = $this->getStatement()->fetchAll(PDO::FETCH_CLASS, $this->returnObject);

        if (isset($this->returnCollection)) {
            return new $this->returnCollection($output);
        }

        return $output ?? [];
    }

    /**
     * Return one row found by PDOStatement as instance of object set in returnObject property
     *
     * @return object|null
     */
    public function fetchObject(): ?object
    {
        $output = $this->getStatement()->fetchObject($this->returnObject);

        if (!$output) {
            return null;
        }

        return $output;
    }

    /**
     * Function wrapper on setting PDOStatement, retrieving current query bind params from array or object with
     * ToArrayInterface
     *
     * @param string $query
     * @param array|ToArrayInterface $paramsForBinding
     * @param array $currentQueryParamsForBinding
     * @return self
     */
    public function query(
        string $query,
        array|ToArrayInterface $paramsForBinding = [],
        array $currentQueryParamsForBinding = []
    ): self {
        $this->setStatement($this->pdo->prepare($query));

        if ($paramsForBinding instanceof ToArrayInterface) {
            $paramsForBinding = $this->prepareEntityForDB($paramsForBinding, $currentQueryParamsForBinding);
        }

        foreach ($paramsForBinding as $param => &$paramForBinding) {
            $this->bindParam($param, $paramForBinding);
        }

        $this->execute();

        return $this;
    }

    /**
     * Prepares Entity instance implementing ToArrayInterface for bindParam function calls
     *
     * @param ToArrayInterface $entity
     * @param array $currentQueryParamsForBinding
     * @return array
     */
    public function prepareEntityForDB(ToArrayInterface $entity, array $currentQueryParamsForBinding = []): array
    {
        $currentQueryParamsForBinding = array_flip($currentQueryParamsForBinding);

        $output = [];
        foreach ($this->prepareQueryDataBeforeDB($entity) as $column => $value) {
            if (!empty($currentQueryParamsForBinding) && !isset($currentQueryParamsForBinding[':' . $column]) && !isset($currentQueryParamsForBinding[$column])) {
                continue;
            }
            $output[':' . $column] = $value;
        }

        return $output;
    }

    /**
     * Prepare data before binding parameters based on allowedColumns property array containing column names allowed to
     * update
     *
     * @param array|ToArrayInterface $queryData
     * @return array
     */
    protected function prepareQueryDataBeforeDB(array|ToArrayInterface $queryData): array
    {
        if ($queryData instanceof ToArrayInterface) {
            $queryData = $queryData->toArray();
        }

        return array_intersect_key($queryData, array_flip($this->getAllowedColumns()));
    }

    /**
     * Return allowedColumns property
     *
     * @return string[]
     */
    protected function getAllowedColumns(): array
    {
        return $this->allowedColumns;
    }

    /**
     * Return id generated by last executed insert
     *
     * @return int
     */
    public function getLastInsertId(): int
    {
        return (int)$this->pdo->lastInsertId();
    }
}
