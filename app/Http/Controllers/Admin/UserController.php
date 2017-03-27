<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function __construct(User $user) {
        $this->user = $user;
    }

    public function getIndex(Request $request) {
        $params = array();
        $prev_search        = array();
        $params['offset']   = config('define.perPage');

        if($request->has('page')) {
            $params['page'] = $request->input('page');
        }

        if($request->has('search')) {
            $params['search']      = $request->input('search');
            $prev_search['search'] = $request->input('search');
        }

        $_users = $this->user->getUsersforAdmin($params);
        $users = $_users->users;
        $pagination = $_users->pagination;

        return view('admin.users.index')->with(compact('users','pagination','prev_search'));
    }

    public function getEdit($id) {
        $user = $this->user->GetUserInformation($id);
        return response()->json($user, 200);
    }

    public function putUpdate(Request $request, $id) {
        $user = $this->user->EditUserInformation($request->all(), $id);
        return response()->json($user, 200);
    }
}
