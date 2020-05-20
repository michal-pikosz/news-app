<?php

namespace src\dao;

use src\framework\db;
use src\models\News;

class NewsDao
{
    private db $db;

    private const getQuery = "SELECT * FROM news WHERE id = ?";
    private const getQueryAll = "SELECT * FROM news";
    private const getQueryInactive = "SELECT * FROM news WHERE is_active != 0";
    private const saveQuery = "INSERT INTO news (name, description, is_active, created_at, updated_at) VALUES (?, ?, ?, ?, ?)";
    private const updateQuery = "UPDATE news SET name = ?, description = ?, is_active= ?, updated_at = ? WHERE id = ?";
    private const deleteQuery = "DELETE FROM news WHERE id = ?";

    public function __construct()
    {
        $this->db = new db();
    }

    public function get(int $id): News
    {
        $result = $this->db->query(self::getQuery, array($id))->fetchArray();

        $news = new News();
        $news->setId((int)$result['id']);
        $news->setName((string)$result['name']);
        $news->setDescription((string)$result['description']);
        $news->setIsActive((bool)$result['is_active']);
        $news->setCreatedAt((string)$result['created_at']);
        $news->setUpdatedAt((string)$result['updated_at']);

        return $news;
    }

    public function getAll(): array
    {
        return $this->db->query(self::getQueryAll)->fetchAll();
    }

    public function getAllInactive(): array
    {
        return $this->db->query(self::getQueryInactive)->fetchAll();
    }

    public function save(News $news): News
    {
        $date = date('Y-m-d H:i:s');
        $newsId = $this->db->query(self::saveQuery, array(
            $news->getName(),
            $news->getDescription(),
            $news->isIsActive(),
            $date,
            $date,
        ))->lastInsertID();
        $news->setId($newsId);
        return $news;
    }

    public function update(News $news): News
    {
        $this->db->query(self::updateQuery, array(
            $news->getName(),
            $news->getDescription(),
            $news->isIsActive(),
            date('Y-m-d H:i:s'),
            $news->getId()
        ));
        return $news;
    }

    public function delete(int $id): void
    {
        $this->db->query(self::deleteQuery, array($id));
    }
}