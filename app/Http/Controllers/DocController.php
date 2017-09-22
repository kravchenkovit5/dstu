<?php

namespace App\Http\Controllers;

use App\Models\StatusDocument;
use App\Models\TypeDocuments;
use ErrorException;
use Throwable;
use App\Models\Doc;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class DocController extends Controller
{
    

    public function index()
    {

        $docs = Doc::all();
        $activeNav = UrlUtility::getActiveLinkArray('main');

        return view('app.docs.index')
            ->with('activeNav', $activeNav)
            ->with('docs', $docs);

    }

    public function selectDocs()
    {
//        $table = 'docs';
//        $primaryKey = 'marking';
//        $columns = array(
//            array('db' => 'marking', 'dt' => 0),
//            array('db' => 'description', 'dt' => 1),
//            array('db' => 'typedoc', 'dt' => 2),
//            array('db' => 'statusdoc', 'dt' => 3),
//            array('db' => 'size', 'dt' => 4),
//            array('db' => 'actualdate', 'dt' => 5),
//            array('db' => 'actualuser', 'dt' => 6),
//            array('db' => 'note', 'dt' => 7),
//        );
//        $sql_details = array(
//            'user' => 'root',
//            'pass' => '',
//            'db' => 'dstu',
//            'host' => 'localhost'
//        );
        // return json_encode(SSP::simple2($_GET, $sql_details, $table, $primaryKey, $columns));
        //метод выбора данных по умолчанию
        //

        $res = Doc::all('marking', 'description', 'typedoc',
            'statusdoc', 'size', 'actualdate', 'actualuser', 'note')->toArray();
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


    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $typedoc = TypeDocuments::pluck('name', 'typedoc')->toArray();
        $typedoc[0] = 'Выберите тип стандарта';
        asort($typedoc);

        $statusdoc = StatusDocument::pluck('name', 'statusdoc')->toArray();
        $statusdoc[0] = 'Выберите статус стандарта';
        asort($statusdoc);

        $activeNav = UrlUtility::getActiveLinkArray('main');

        return view('app.docs.create')
            ->with('activeNav', $activeNav)
            ->with('typedoc', $typedoc)
            ->with('statusdoc', $statusdoc);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'marking' => 'required',
            'description' => 'required',
            'edoc' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('docs/create')
                ->withInput()
                ->withErrors($validator);
        } else {
            // store
            $DocExists = Doc::find(Input::get('marking'));
            if ($DocExists == null) { //такого документа еще нет
                $doc = new Doc;
                $doc->marking = Input::get('marking');
                $doc->description = Input::get('description');
                $doc->typedoc = Input::get('typedoc');
                $doc->statusdoc = 1; //в начале всегда статус "Создана"
                $doc->note = Input::get('note');
                $doc->id_request = Input::get('id_request');

                if (!is_null($request->file('edoc'))) {
                    $doc->reference = uniqid() . uniqid() . '.' . $request->file('edoc')->getClientOriginalExtension();
                }

                try {
                    $movePath = base_path() . (config('app.pdf_path'));
                    $request->file('edoc')->move($movePath, $doc->reference);
                } catch (Throwable  $e) {
                    $validator->errors()->add('edoc', 'Ошибка загрузки файла ' . $request->file('edoc')->getClientOriginalName . ' !');
                    return Redirect::to('docs/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $doc->save();

            } else {
                $validator->errors()->add('marking', 'Документ с таким названием уже есть!');
                return Redirect::to('docs/create')
                    ->withInput()
                    ->withErrors($validator);
            }

            // redirect
            Session::flash('message', 'Документ создан!');
            return Redirect::to('docs');
        }
    }

    /**
     * Display the specified resource.
     *
     */
    public function show($marking)
    {
        $doc = Doc::find($marking);

        $activeNav = UrlUtility::getActiveLinkArray('main');

        return view('app.docs.show')
            ->with('activeNav', $activeNav)
            ->with('doc', $doc);
    }

    public function edit($marking)
    {
        $doc = Doc::find($marking);

        $activeNav = UrlUtility::getActiveLinkArray('main');

        return view('app.docs.edit')
            ->with('activeNav', $activeNav)
            ->with('doc', $doc);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update($marking)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'description' => 'required',
            'typedoc' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('docs/' . $marking . '/edit')->withErrors($validator);
        } else {
            // store
            $doc = doc::find($marking);
            $doc->description = Input::get('description');
            $doc->typedoc = Input::get('typedoc');
            $doc->statusdoc = Input::get('statusdoc');
            $doc->note = Input::get('note');
            $doc->id_request = Input::get('id_request');
            $doc->save();

            Session::flash('message', 'Документ ' . $marking . ' отредактирован!');
            return Redirect::to('docs');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($marking)
    {
        $doc = doc::find($marking);
        $delLink = base_path() . config('app.pdf_path') . '/' . $doc->reference;
        try {
            unlink($delLink);
        } catch (ErrorException $e) {
            $err = 'Ошибка';
        }

        $doc = Doc::find($marking);
        $doc->delete();

        // redirect
        Session::flash('message', 'Документ ' . $marking . ' удален!');
        return Redirect::to('docs');
    }

}
