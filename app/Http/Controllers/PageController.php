<?php

namespace App\Http\Controllers;

use App\Models\Doc;

class PageController extends Controller
{
    public function test()
    {
//        $userdata = json_decode($_COOKIE['userdata']);
//        echo $userdata->name;
//            echo json_encode('{"value":"'. print_r($_GET['value']) .'"}');
        //print_r($_GET['userdata']);

        $user = session('username');
        $usertype = session('usertype');
        $is_user_logged = session('is_user_logged');

        if (isset($_GET['userdata'])) {
            $userdata = json_decode($_GET['userdata']);

            session('username', $userdata->name);
            session('usertype', $userdata->usertype);
            session('is_user_logged', $userdata->is_user_logged);

            echo "test 123";

        }
//        echo $userdata->usertype;
        /*$fn  = $_POST['fn'];
        $str = $_POST['str'];
        /*
        $file = fopen(url('').$fn.".record","w");
        echo fwrite($file,$str);
        fclose($file);
        */
    }

    public function check()
    {
        return view('app/pages/checkuser');
    }

    public function showHome()
    {
        $activeNav = UrlUtility::getActiveLinkArray('main');
        return view('app/pages/main')->with('activeNav', $activeNav);
    }

    public function showRequests()
    {
        $activeNav = UrlUtility::getActiveLinkArray('requests');
        return view('app/pages/requests')->with('activeNav', $activeNav);
    }

    public function operationDoc()
    {
        $activeNav = UrlUtility::getActiveLinkArray('main');
        return view('app/pages/operation_doc')->with('activeNav', $activeNav);
    }

    public function showMessages()
    {
        //$users = DB::connection('metrolog_mysql')->select('select * from jos_users');

        /*$users = User::all();
        foreach ($users as $user){
            echo $user->name ." ". $user->usertype ."<br>";
        }*/

        $activeNav = UrlUtility::getActiveLinkArray('messages');
        return view('app/pages/messages')->with('activeNav', $activeNav);
    }

    public function viewDoc($name)
    {

        $doc = Doc::find($name);
        $marking = $doc->marking;
        $source = url(config('app.pdf_view') . $doc->reference);
        $descr = $doc->description;
        $activeNav = UrlUtility::getActiveLinkArray('main');

        return view('app/pages/viewer')
            ->with('activeNav', $activeNav)
            ->with('source', $source)
            ->with('marking', $marking)
            ->with('descr', $descr);
    }


}
