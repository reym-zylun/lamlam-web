<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Course;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MapController extends Controller
{

    public function getIndex(Request $request) {
        return view('admin.map.index');
    }

    public function postRegistBusStops(Request $request) {
        $validator = \Validator::make($request->all(), [
           'kml' => 'required'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors()->all();
            return view('admin.map.index')->with(compact('errors'));
        }

        $file = $request->file('kml');
        $xmlData = simplexml_load_file($file, 'SimpleXMLElement', LIBXML_NOCDATA);
        $inserts = [];
        foreach($xmlData->Document->Placemark as $placemark){
            $names = explode('<br>', $placemark->description);
            $busStopId = explode(",", $placemark->name);
            $busStopId = trim($busStopId[0], '#');
            $locations = [];
            $locationsTmp = explode(" ",(string)$placemark->LineString->coordinates);
            $location = explode(",",$placemark->Point->coordinates);
            $insert  = "INSERT INTO bus_stops (id, name_ja, name_en, latitude, longitude)\n";
            $insert .= "VALUES (".$busStopId.",'".$names[0]."','".$names[1]."','".$location[1]."','".$location[0]."');\n";
            $inserts[] = $insert;
        }

        return view('admin.map.index')->with(compact('inserts'));

    }

    public function postRegistBusCourses(Request $request) {
        $validator = \Validator::make($request->all(), [
           'bus_id' => 'required',
           'kml' => 'required'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors()->all();
            return view('admin.map.index')->with(compact('errors'));
        }

        $id = Course::getMaxId() + 1;

        $file = $request->file('kml');
        $xmlData = simplexml_load_file($file);
        $busId = $request->input('bus_id');
        $insertCols = [
            "id",
            "bus_id",
            "from_bus_stop_id",
            "to_bus_stop_id",
            "next_bus_course_id",
            "time",
            "course"
        ];
        $sqls[] = "DELETE FROM bus_courses WHERE bus_id=".$busId.";\n";
        foreach($xmlData->Document->Placemark as $placemark){
            $fromTo = explode("->", $placemark->name);
            $locations = [];
            $locationsTmp = explode(" ",(string)$placemark->LineString->coordinates);
            foreach($locationsTmp as $locationTmp){
                $location = explode(",",$locationTmp);
                $locations[] = ['latitude' => $location[1], 'longitude' => $location[0]]; 
            }
            $time = Course::getTime($locations); 
            $nextBusCourseId = "NULL";
            if (count($sqls) < count($xmlData->Document->Placemark)){
                $nextBusCourseId = $id + 1;
            }
            $insertData = [
                $id,
                $busId,
                trim($fromTo[0], '#'),
                trim($fromTo[1], '#'),
                $nextBusCourseId,
                $time,
                "'".json_encode($locations)."'",
            ];
            $insert  = "INSERT INTO bus_courses (".implode(",", $insertCols).")\n";
            $insert .= "VALUES (".implode(",", $insertData).");\n";
            $sqls[] = $insert;
            $id++;
        }

        return view('admin.map.index')->with(compact('sqls'));
    }

}
