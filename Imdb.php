<?php

require_once __DIR__ . '/ApiKey.php';

class Imdb{
    const BASEURL = 'http://www.omdbapi.com/?';
    const TITLEKEY = 't=';
    const YEARKEY = 'y=';

    public function __construct(){

    }
    protected function _apiCall($url){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output);
    }
    public static function search($title,$year = null){
        $url = self::BASEURL . IMDBKEY . '&' . self::TITLEKEY . urlencode($title);
        if(!is_null($year)){
            $url .= self::YEARKEY . $year;
        }
        $obj = new self();
        $result = $obj->_apiCall($url);
        if(isset($result->Error)){
          return false;
        }
        return $result;
    }

}
