<?php

class DbExt {

    public function rst($sql = '') {
        if (!empty($sql)) {
            $connection = Yii::app()->db;
            $rows = $connection->createCommand($sql)->queryAll();
            if (is_array($rows) && count($rows) >= 1) {
                return $rows;
            } else
                return false;
        } else
            return false;
    }

    public function qry($sql = '') {
        if (!empty($sql)) {
            if (Yii::app()->db->createCommand($sql)->query()) {
                return true;
            } else
                return false;
        } else
            return false;
    }

    public function insertData($table = '', $data = array()) {
        $connection = Yii::app()->db;
        $command = Yii::app()->db->createCommand();
        if ($command->insert($table, $data)) {
            return true;
        }
        return false;
    }

    public function updateData($table = '', $data = array(), $wherefield = '', $whereval = '') {
        $connection = Yii::app()->db;
        $command = Yii::app()->db->createCommand();
        $res = $command->update($table, $data, "$wherefield=:$wherefield", array(":$wherefield" => $whereval));
        if ($res) {
            return true;
        }
        return false;
    }

    public function customGet($options) {

        $select = false;
        $table = false;
        $join = false;
        $order = false;
        $limit = false;
        $offset = false;
        $where = false;
        $single = false;
        $group_by = false;

        extract($options);

        $qry = Yii::app()->db->createCommand();

        if ($select != false)
            $qry->select($select);

        if ($table != false)
            $qry->from($table);

        if ($where != false)
            $qry->Where($where);

        if ($limit != false) {

            if (!is_array($limit)) {
                $qry->limit($limit);
            } else {
                foreach ($limit as $limitval => $offset) {
                    $qry->limit($limitval, $offset);
                }
            }
        }

        if ($group_by != false) {

            $qry->group($group_by);
        }


        if ($order != false) {

            foreach ($order as $key => $value) {

                if (is_array($value)) {
                    foreach ($order as $orderby => $orderval) {
                        $qry->order($orderby, $orderval);
                    }
                } else {
                    $qry->order($key, $value);
                }
            }
        }

        if ($join != false) {

            foreach ($join as $key => $value) {

                if (is_array($value)) {
                    if (count($value) == 3) {
                        $qry->join($value[0], $value[1], $value[2]);
                    } else {
                        foreach ($value as $key1 => $value1) {
                            $qry->join($key1, $value1);
                        }
                    }
                } else {
                    $qry->join($key, $value);
                }
            }
        }

        if ($single) {

            return $qry->queryRow();
        } else {

            return $qry->queryAll();
        }
    }
    
    public function customUpdate($options) {
        
        $table = false;
        $where = false;
        $data = false;

        extract($options);
        
        $connection = Yii::app()->db->createCommand();
        
        if(empty($table)){
            return false;
        }

        if (empty($where)) {
            return false;
        }

       return $connection->update($table, $data, $where);

    }
    
    public function customDelete($options) {
        $table = false;
        $where = false;

        extract($options);

        $connection = Yii::app()->db->createCommand();
         
        if (empty($where))
            return false;

       return $connection->delete($table,$where);

    }
    
    public function customInsert($options) {
        
        $table = false;
        $data = false;

        extract($options);

        $connection = Yii::app()->db->createCommand();
       
        return $connection->insert($table, $data);

    }

}

/*END: Cdb*/