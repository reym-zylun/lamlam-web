<?php

namespace App;

use Illuminate\Http\Response;
use App\ApiModel;

class Course extends ApiModel
{

    static function getMaxId() {
        $res = self::call("GET", env('API_URL')."/courses");
        $courses = $res->getBody()->courses;
        $max_id = 0;
        foreach($courses as $course){
            if($course->id > $max_id){
                $max_id = $course->id;
            }
        }
        return $max_id;
    }

    static function getTime($locations){
        $distance = 0;
        foreach($locations as $i => $location){
            if($location === end($locations)){
                break;
            }
            $theta = $location['longitude'] - $locations[$i+1]['longitude'];
            $dist = sin(deg2rad($location['latitude'])) * sin(deg2rad($locations[$i+1]['latitude'])) +  cos(deg2rad($location['latitude'])) * cos(deg2rad($locations[$i+1]['latitude'])) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $distance += $dist * 60 * 1.1515 * 1.609344 * 1000;
        }
        return ceil($distance / 500);
    }

}
