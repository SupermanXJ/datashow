<?php

namespace App\Controllers;

use App\Models\CovidModel;
use App\Models\PopModel;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function api_getCovids() {
        $dataCol = '新增无症状';
        $model = new CovidModel();
        $covids = $model->getCovids(date('Ymd', strtotime('-3 month')));
        $rs = [
//            array('name' => '北京', 'data' => []),
            array('name' => '上海', 'data' => []),
//            array('name' => '深圳', 'data' => []),
//            array('name' => '武汉', 'data' => [])
        ];

        foreach ($covids as $covid) {
            switch ($covid['place']) {
//                case '北京': { $rs[0]['data'][] = intval($covid[$dataCol]); break; }
                case '上海': { $rs[0]['data'][] = intval($covid[$dataCol]); break; }
//                case '广东-深圳': { $rs[2]['data'][] = intval($covid[$dataCol]); break; }
//                case '湖北-武汉': { $rs[3]['data'][] = intval($covid[$dataCol]); break; }
            }
        }
        echo json_encode($rs);
    }

    public function api_getPops() {
        $dataCol = '常住人口';
        $model = new PopModel();
        $pops = $model->getPops(1978);
        $rs = [array('name' => '上海', 'data' => [])];
        foreach ($pops as $pop) {
            switch ($pop['place']) {
                case '上海': { $rs[0]['data'][] = intval($pop[$dataCol]); break; }
            }
        }
        echo json_encode($rs);
    }
}
