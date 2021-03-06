<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */
namespace App\Model;

/**
 *
 */
class CategoryManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'category';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @param string $category
     * @return int
     */
    public function insert(string $category): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`name`) VALUES (:name)");
        $statement->bindValue('name', $category, \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }
  
    /**
     * Get all row from database order by name ASC.
     *
     * @return array
     */
    public function selectAllByAsc(): array
    {
        $query = "SELECT * FROM $this->table ORDER BY name ASC";
        return $this->pdo->query($query)->fetchAll();
    }

    /**
     * Delete category from BDD
     *
     * @param int $id
     */
    public function delete(int $id): void
    {

        $query = "DELETE FROM $this->table WHERE `id`=:id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);

        $statement->execute();
    }
}
