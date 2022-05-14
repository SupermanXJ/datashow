<?php


namespace App\Controllers\command\covid;

//include_once "../../../ThirdParty/phpQuery.php";
//include_once "./app/ThirdParty/phpQuery.php";
//include_once APPPATH . ""

use App\Controllers\BaseController;
use App\Models\covid\CovidModel;

class Index extends BaseController {
    public function testCli($msg = 'cli') {
        echo "hello {$msg}" . PHP_EOL;
        $model = new CovidModel();
        $covids = $model->getCovids();
        print_r($covids);
    }

    public function spider() {
//        $source = http_get("https://voice.baidu.com/act/newpneumonia/newpneumonia/?from=osari_aladin_banner&city=%E4%B8%8A%E6%B5%B7-%E4%B8%8A%E6%B5%B7#tab0");
//        $query = \phpQuery::get("https://voice.baidu.com/act/newpneumonia/newpneumonia/?from=osari_aladin_banner&city=%E4%B8%8A%E6%B5%B7-%E4%B8%8A%E6%B5%B7#tab0");
//        print_r($query);
        //        $json = $query->find("#captain-config").text();
//        print_r($json);
        $output = null;
        exec("curl https://voice.baidu.com/act/newpneumonia/newpneumonia/?from=osari_aladin_banner&city=%E4%B8%8A%E6%B5%B7-%E4%B8%8A%E6%B5%B7#tab0", $output);
        $html = implode('', $output);
        $doc = phpQuery::newDocument($html);
//        $doc = phpQuery::newDocument("<div></div>");
        print_r($doc);
    }

//`新增确诊` int(8) NOT NULL DEFAULT '0',
//`新增本土` int(8) NOT NULL DEFAULT '0',
//`新增境外` int(8) NOT NULL DEFAULT '0',
//`新增无症状` int(8) NOT NULL DEFAULT '0',
//`现有确诊` int(8) NOT NULL DEFAULT '0',
//`累计确诊` int(8) NOT NULL DEFAULT '0',
//`累计治愈` int(8) NOT NULL DEFAULT '0',
//`累计死亡` int(8) NOT NULL DEFAULT '0',


    public function spiderHistory() {
        $model = new CovidModel();

        $r = '{"status":0,"msg":"success","data":[{"name":"湖北-武汉","trend":{"list":[{"name":"新增无症状","data":[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,5,1,0,0,0,0,1,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,1,1,3,1,1,3,2,10,12,12,7,22,13,28,7,5,4,0,0,0,1,2,2,3,0,0,0,0,0,0]},{"name":"新增本土","data":[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,4,5,10,2,0,0,5,2,0,4,4,1,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,1,0,0,0,1,1,0,0,0,0,0,0,0,0]}],"updateDate":["1.31","2.1","2.2","2.3","2.4","2.5","2.6","2.7","2.8","2.9","2.10","2.11","2.12","2.13","2.14","2.15","2.16","2.17","2.18","2.19","2.20","2.21","2.22","2.23","2.24","2.25","2.26","2.27","2.28","3.1","3.2","3.3","3.4","3.5","3.6","3.7","3.8","3.9","3.10","3.11","3.12","3.13","3.14","3.15","3.16","3.17","3.18","3.19","3.20","3.21","3.22","3.23","3.24","3.25","3.26","3.27","3.28","3.29","3.30","3.31","4.1","4.2","4.3","4.4","4.5","4.6","4.7","4.8","4.9","4.10","4.11","4.12","4.13","4.14","4.15","4.16","4.17","4.18","4.19","4.20","4.21","4.22","4.23","4.24","4.25","4.26","4.27","4.28","4.29","4.30","5.1"]}}]}';
        $data = json_decode($r, true);
        $name = $data['data'][0]['name'];
        $trend = $data['data'][0]['trend'];
        $listKeyby = array_rows_keyby('name',$trend['list']);

        foreach ($trend['updateDate'] as $i => $date) {
            $report = array(
                'reportDay' => date('Ymd', strtotime('2022-' . str_replace('.', '-', $date))),
                'place' => $name,
                '新增确诊' => $listKeyby['新增确诊']['data'][$i] ?? 0,
                '新增本土' => $listKeyby['新增本土']['data'][$i] ?? 0,
                '新增无症状' => $listKeyby['新增无症状']['data'][$i] ?? 0,
                '累计死亡' => $listKeyby['死亡']['data'][$i] ?? 0,
                '累计治愈' => $listKeyby['治愈']['data'][$i] ?? 0,
                '累计确诊' => $listKeyby['确诊']['data'][$i] ?? 0
            );
            $model->save($report);
        }
    }
}