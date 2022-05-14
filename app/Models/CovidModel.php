<?php


namespace App\Models;


use CodeIgniter\Model;

class CovidModel extends Model {
    protected $table = 'ds_covid';
    protected $allowedFields = ['reportDay', 'place', '新增确诊', '新增本土', '新增无症状', '累计死亡', '累计治愈', '累计确诊'];

    public function getCovids($startDay = 0, $endDay = 0) {
        if(empty($startDay)) $startDay =  date('Ymd', strtotime('-1 month', strtotime($startDay)));
        if(empty($endDay)) $endDay =  date('Ymd', strtotime('-1 day'));
        $sql = "select * from {$this->table} where reportDay >= '{$startDay}' and reportDay <= '{$endDay}' order by reportDay asc";
        return $this->db->query($sql)->getResultArray();
    }
}