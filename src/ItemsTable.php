<?php
namespace TDD;

use \PDO;

/**
 * Class ItemsTable
 * @package TDD
 */
class ItemsTable {
    /**
     * @var string
     */
    protected $table = 'items';

    /**
     * @var PDO
     */
    protected $PDO;

    /**
     * ItemsTable constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo) {
        $this->PDO = $pdo;
    }

    /**
     *
     */
    public function __destruct() {
        unset($this->PDO);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findForId($id) {
        $query = "SELECT * FROM {$this->table} WHERE {$this->table}.id = ?";
        $statement = $this->PDO->prepare($query);
        $statement->execute([$id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
