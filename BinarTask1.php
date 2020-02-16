<?php

class BinarTask1 {

    const POSITION_LEFT = 1;
    const POSITION_RIGTH = 2;

    public static $positionsArray = [
        self::POSITION_LEFT,
        self::POSITION_RIGTH
    ];

    public $parentId;
    public $position;
    protected $db;

    function __construct() {
        $this->db = new db();
    }

    function __destruct() {
        $this->db->close();
    }

    /**
     * @return string
     */
    public function save() {
        if (!in_array($this->position, self::$positionsArray)) {
            return 'Wrong position';
        }

        if (!$parentElement = $this->getParentElement()) {
            return 'No parent binar';
        }

        if ($this->checkElementIsExist()) {
            return 'Element exist';
        }

        $element = $this->db->query('INSERT INTO binar (parent_id, position, path, level) VALUES (?,?,?,?)', $this->parentId, $this->position, '', (int)$parentElement['level'] + 1);
        if (is_object($element)) {
            $lastId = $this->db->lastInsertID();
            $this->db->query('UPDATE binar SET path = "' . $parentElement['path'] . '.' . $lastId . '" WHERE id = ' . $lastId);
            return 'Success save';
        }

        return 'Some error';
    }

    /**
     * @return null|array
     */
    public function getParentElement() {
        return $this->db->query('SELECT * FROM binar WHERE id = ?', [$this->parentId])->fetchArray();
    }

    /**
     * @return bool
     */
    public function checkElementIsExist() {
        return $this->db->query('SELECT * FROM binar WHERE parent_id = ? AND position = ?', [$this->parentId, $this->position])->fetchArray() ? true : false;
    }
}
?>