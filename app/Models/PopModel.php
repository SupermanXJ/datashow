<?php


namespace App\Models;


use CodeIgniter\Model;

class PopModel extends Model {
    protected $table = 'ds_pop';
    protected $allowedFields = ['reportYear', 'place', '常住人口'];

    public function getPops($startYear = 0, $endYear = 0) {
        if(empty($startYear)) $startYear =  1978;
        if(empty($endYear)) $endYear =  date('Y', strtotime('-2 year'));
        $sql = "select * from {$this->table} where reportYear >= '{$startYear}' and reportYear <= '{$endYear}' order by reportYear asc";
        return $this->db->query($sql)->getResultArray();
    }
}