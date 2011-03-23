<?php

class Content {

        public static function getUrl($url){
                $ret = "";

                if (function_exists("curl_init")){
                    $crl = curl_init();
                    $timeout = 5;
                    $useragent="Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1";
                    curl_setopt ($crl, CURLOPT_URL,$url);
                    curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
                    curl_setopt ($crl, CURLOPT_USERAGENT, $useragent);
                    $ret = curl_exec($crl);
                    curl_close($crl);
                } else {
                    $handle = fopen($url, "rb");
                    while (!feof($handle)) {
                            $ret .= fread($handle, 1024);
                    }
                    fclose($handle);
                }
                
            return $ret;
        }

        public static function getFile($name){
            return file_get_contents($name);
        }
}


?>
