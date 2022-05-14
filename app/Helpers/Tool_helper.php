<?php

if(!function_exists("http_get")) {
    function http_get($url, $errorHandle = "", $timeout = 60) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        $output = curl_exec($ch);
        curl_close($ch);

        if (curl_errno($ch) && $errorHandle) {
            return $errorHandle($ch);
        }

        return $output;
    }

    function http_post($url, $data, $content_type = "application/x-www-form-urlencoded", $errorHandle = "", $time_out = 60) {
        $headers = [];
        if (is_string($content_type)) {
            $headers['Content-Type'] = $content_type;
        } else {
            $headers = array_merge($headers, $content_type);
        }

        if (isset($headers['Content-Type']) && $headers['Content-Type'] == "application/x-www-form-urlencoded") {
            $data = http_build_query($data);
        } elseif (!is_string($data)) {
            $data = json_encode($data);
        }

        $mergeHeaders = [];
        foreach ($headers as $key => $val) {
            $mergeHeaders[] = "$key: $val";
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $time_out);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $mergeHeaders);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        curl_close($ch);

        if (curl_errno($ch) && $errorHandle) {
            return $errorHandle($ch);
        }

        return $output;
    }
}

if(!function_exists("array_rows_keyby")) {
    /*
     * 提取结果集数组列名作为每一行value的key
     */
    function array_rows_keyby($col, &$ar, $isLowercase = false, $isGroupKy = false, $isUnsetKeybyVal = false) {
        $rar = array();
        foreach ($ar as $key => $val) {
            if (is_array($val) && array_key_exists($col, $val)) {
                $k = $isLowercase ? mb_strtolower($val[$col]) : $val[$col];
                if ($isGroupKy) {
                    if($isUnsetKeybyVal) unset($val[$col]);
                    $rar[$k][] = $val;
                } else {
                    $rar[$k] = $val;
                }
            }
        }
        return $rar;
    }
}