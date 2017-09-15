<?php

namespace App\Http\Controllers;

use App\Models\Req;
use App\Models\StatusRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ReqController extends Controller
{
    public function index()
    {
        $reqs = Req::all();
        // load the view and pass the docs
        return view('app.reqs.index')
            ->with('activeNav', 'requests')
            ->with('reqs', $reqs);
    }


    public function create()
    {

    }

    public function store()
    {

    }

    public function show($id)
    {
        $req = Req::find($id);
        $parentReq = Req::find($req->parent_id);

        // show the view and pass the doc to it
        return view('app.reqs.show')
            ->with('activeNav', 'requests')
            ->with('req', $req)
            ->with('parentReq', $parentReq);
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


        return view('app.reqs.edit')
            ->with('activeNav', 'main')
            ->with('statuses', $statuses)
            ->with('parents', $parents)
            ->with('req', $req);
    }

    public function update($id)
    {
        $req = Req::find($id);
        $req->status = Input::get('status');
        if (Input::get('parent_id') != '0'){
            $req->parent_id = Input::get('parent_id');
        }

        $req->save();

        Session::flash('message', 'Заявка ' . $id . ' обработана!');
        return Redirect::to('reqs');
    }

    public function destroy()
    {
        //
    }
}
