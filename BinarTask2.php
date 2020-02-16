<?php

class BinarTask2 {

    protected $db;
    function __construct() {
        $this->db = new db();
    }

    function __destruct() {
        $this->db->close();
    }

    /**
     * @param int $fromId
     * @param int $level
     * @return bool
     */
    public function autoCreate($fromId = 1, $level = 5) {
        $positionsArray = BinarTask1::$positionsArray;

        if (!$fromElement = $this->db->query('SELECT * FROM binar WHERE id = ?', [$fromId])->fetchArray()) {
            return false;
        }

        $i = $fromElement['level'];
        $parentId = $fromId;
        while ($i < ($fromElement['level'] + ($level - 1))) {
            $elements = $this->db->query('SELECT * FROM binar WHERE level = ? AND ((path LIKE ?) || path = ?)', [$i, '%' . $parentId . '.%', $parentId])->fetchAll();
            foreach ($elements as $element) {
                foreach ($positionsArray as $position) {
                    $model = new BinarTask1;
                    $model->parentId = $element['id'];
                    $model->position = $position;
                    $model->save();
                }
            }

            $i++;
        }

        return true;
    }

    /**
     * @param int $fromElementId
     * @return null|array
     */
    public function getPreElements($fromElementId) {
        if ($fromElement = $this->db->query('SELECT * FROM binar WHERE id = ?', [$fromElementId])->fetchArray()) {
            $ids = join("','", explode(".", $fromElement['path']));
            return $this->db->query("SELECT * FROM binar WHERE id in ('$ids') AND id <> ?", [$fromElementId])->fetchAll();
        }

        return null;
    }

    /**
     * @param int $fromElementId
     * @return null|array
     */
    public function getNextElements($fromElementId) {
        if ($fromElement = $this->db->query('SELECT * FROM binar WHERE id = ?', [$fromElementId])->fetchArray()) {
            return $this->db->query("SELECT * FROM binar WHERE path LIKE ?", [$fromElement['path'] . '.%'])->fetchAll();
        }

        return null;
    }
}
?>