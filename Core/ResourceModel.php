<?php
namespace mvc\Core;

use mvc\Core\ResourceModelInterface;
use mvc\Config\Database;
use mvc\Core\Model;

class ResourceModel implements ResourceModelInterface
{
    protected $table;
    protected $id;
    protected $model;

    public function _init($table, $id, $model)
    {
        $this->table = $table;
        $this->id = $id;
        $this->model = $model;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM $this->table";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function save($model)
    {
        $arrModel= $model->getProperties();

        $placeholder = [];
        $insert_key = [];
        $placeUpdate = [];
        if ($model->getId() === null) {
            //add
            foreach ($arrModel as $key=>$value){
                $insert_key[] = $key;
                array_push($placeholder, ':'.$key);

            }
            $strKeyIns= implode(', ',$insert_key);
            $strPlaceholder=implode(', ',$placeholder);
            $sql_insert = "INSERT INTO $this->table ({$strKeyIns}) VALUES ({$strPlaceholder})";
            $obj_insert = Database::getBdd()->prepare($sql_insert);
            return $obj_insert->execute($arrModel);
        } else {
            foreach ($arrModel as $k=>$item) {
                array_push($placeUpdate, $k.' = :'.$k);
            }

            //edit
            $strPlaceUpdate=implode(', ',$placeUpdate);
            $sql_update = "UPDATE {$this->table} SET $strPlaceUpdate WHERE id=:id";
            $obj_update = Database::getBdd()->prepare($sql_update);
            return $obj_update->execute($arrModel);
        }
    }

    public function get($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = " . $id;
        $obj = Database::getBdd()->prepare($sql);

        $obj->execute();
        return $obj->fetch();
    }

    public function delete($model)
    {
        $id=$model->getId();
        $sql = "DELETE FROM $this->table WHERE id = " . $id;
        $req = Database::getBdd()->prepare($sql);
        return $req->execute();
    }
}