<?php

namespace App\Http\Controllers;

use App\Models\Req;
use App\Models\StatusRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ReqController extends Controller
{
    public function index()
    {
        $reqs = Req::all();

        $activeNav = UrlUtility::getActiveLinkArray('requests');

        return view('app.reqs.index')
            ->with('activeNav', $activeNav)
            ->with('reqs', $reqs);
    }


    public function create()
    {
        $activeNav = UrlUtility::getActiveLinkArray('requests');
        return view('app.reqs.create')->with('activeNav', $activeNav);
    }

    public function store()
    {
        $rules = array(
            'name' => 'required',
            'description' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('reqs/create')
                ->withInput()
                ->withErrors($validator);
        } else {
            // store
            $ReqExists = Req::find(Input::get('name'));
            if ($ReqExists == null) { //такого документа еще нет
                $req = new Req;
                $req->name = Input::get('name');
                $req->status = 1;
                $req->author = ( isset($_COOKIE['user'])? $_COOKIE['user'] : 'undefined' );
                $req->description = Input::get('description');

                $req->save();

            } else {
                $validator->errors()->add('name', 'Заявка с таким названием уже есть!');
                return Redirect::to('reqs/create')
                    ->withInput()
                    ->withErrors($validator);
            }

            // redirect
            Session::flash('message', 'Заявка ' . $req->id . ' создана!');
            return Redirect::to('show_requests');
        }
    }

    public function show($id)
    {
        $req = Req::find($id);
        if (!is_null($req)) {
            $parentReq = Req::find($req->parent_id);

            $activeNav = UrlUtility::getActiveLinkArray('requests');

            return view('app.reqs.show')
                ->with('activeNav', $activeNav)
                ->with('req', $req)
                ->with('parentReq', $parentReq);
        } else {
            redirect('reqs');
        }
    }

    public function edit($id)
    {
        $req = Req::find($id);

        $statuses = StatusRequest::pluck('name', 'id')->toArray();
        $requests = Req::whereIn('status', [1, 2])->get();

        if ($requests->count() > 0) {
            $parents[0] = 'При необходимости выберите из списка родительскую заявку';
            foreach ($requests as $parent) {
                $parents[$parent->id] = 'Заявка № ' . $parent->id . ' ' . $parent->name . ' (' . $parent->status . ')';
            }
        } else $parents = null;

        $activeNav = UrlUtility::getActiveLinkArray('requests');

        return view('app.reqs.edit')
            ->with('activeNav', $activeNav)
            ->with('statuses', $statuses)
            ->with('parents', $parents)
            ->with('req', $req);
    }

    public function update($id)
    {
        $req = Req::find($id);
        $req->status = Input::get('status');
        if (Input::get('parent_id') == '0') {
            $req->parent_id = null;
        } else {
            $req->parent_id = Input::get('parent_id');
        }

        $req->save();

        Session::flash('message', 'Заявка ' . $id . ' обработана!');
        return Redirect::to('reqs');
    }

    public function destroy($id)
    {
        $req = Req::find($id);
        $req->delete();

        // redirect
        Session::flash('message', 'Заявка № ' . $id . ' удалена!');
        return Redirect::to('reqs');
    }

    public function selectRequests()
    {
        if (isset($_COOKIE['get_requests'])) $howFetch = $_COOKIE['get_requests'];
        else $howFetch = null;
        if (isset($_COOKIE['user'])) {
            $author = $_COOKIE['user'];
        } else $author = null;

        if ($howFetch == 'by_user' && !is_null($author)) {
            $res = Req::where('author', $author)
                ->select('created_at', 'name', 'status', 'description', 'author', 'performer', 'performdate')
                ->get()
                ->toArray();
        } elseif ($howFetch == 'all') {
            $res = Req::all('created_at', 'name', 'status', 'description', 'author', 'performer', 'performdate')
                ->toArray();
        }

        //преобразовать в формат необходимый для datatables
        foreach ($res as $key => $elem) {
            $i = 0;
            foreach ($elem as $subkey => $sub) {
                $res[$key][$i] = $elem[$subkey];
                unset($res[$key][$subkey]);
                $i++;
            }
        }
        $fech['data'] = $res;

//        return json_encode(SSP::simple2($_GET, $sql_details, $table, $primaryKey, $columns));
        return json_encode($fech);
    }

}
