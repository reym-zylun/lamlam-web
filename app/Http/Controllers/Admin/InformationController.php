<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Information;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InformationController extends Controller
{

    public function __construct(Information $information) {
        $this->information   = $information;
    }

    protected function getIndex(Request $request) {
        $params             = array();
        $prev_search        = array();
        $params['offset']   = config('define.perPage');

        if($request->has('page')) {
            $params['page'] = $request->input('page');
        }

        if($request->has('search')) {
            $params['search']      = $request->input('search');
            $prev_search['search'] = $request->input('search');
        }

        $informations    = $this->information->getInformations($params);
        $infos           = $informations->informations;
        $pagination      = $informations->pagination;
        return view('admin.informations.index')->with(compact('infos','pagination','prev_search'));
    }

    public function postCreate(Request $request) {
        $information = $this->information->registerInformation($request->all());
        return response()->json($information, 200);
    }

    public function getEdit($id) {
        $information = $this->information->getInformation($id);
        return response()->json($information, 200);
    }

    public function putEdit(Request $request, $id) {
        $information = $this->information->updateInformation($request->all(), $id);
        return response()->json($information, 200);
    }

    public function getDelete(Request $request, $id) {
        $information = $this->information->deleteInformation($request->all(), $id);
        return response()->json($information, 200);
    }

}
