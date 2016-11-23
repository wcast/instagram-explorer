<?php

namespace WCast\Authtool;

/**
 * Created by PhpStorm.
 * User: roger
 * Date: 11/21/16
 * Time: 4:10 PM
 */

class InstagramExloprer
{
    public static function request($tag='',$top=false){
        $response = [];
        $baseUrl = 'https://www.instagram.com/explore/tags/'.$tag.'/?__a=1';
        $url = $baseUrl;
        while(1) {
            $json = json_decode(file_get_contents($url));
            $array[] =  file_get_contents($url);
            if(!$json->tag->media->page_info->has_next_page) break;
            $url = $baseUrl.'&max_id='.$json->tag->media->page_info->end_cursor;
        }
        foreach($array as $data){
            $criteria = json_decode($data,true);
            if($top){
                foreach($criteria['tag']['top_posts'] as $data){
                    foreach ($data as $sdata)
                        $response[] = $sdata;
                };
            }else{
                foreach($criteria['tag']['media']['nodes'] as $data){
                    $response[] = $data;
                };
            }
        };
        return json_encode($response);
    }
}
