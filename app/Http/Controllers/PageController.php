<?php

namespace App\Http\Controllers;

use App\Models\Doc;

class PageController extends Controller
{
    public function setuser()
    {
//        $userdata = json_decode($_COOKIE['userdata']);
//        echo $userdata->name;
//            echo json_encode('{"value":"'. print_r($_GET['value']) .'"}');
        //print_r($_GET['userdata']);
   /*     $userdata = json_encode($_GET['userdata']);
        session(['username' => $userdata->name]);
        session(['usertype' => $userdata->usertype]);
        session(['user_is_logged' => $userdata->is_user_logged]);
*/
echo "test 123";
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

        return view('app/pages/main')->with('activeNav', 'main');

    }

    public function showRequests()
    {
        return view('app/pages/requests')->with('activeNav', 'requests');
    }

    public function operationDoc()
    {
        return view('app/pages/operation_doc')->with('activeNav', 'main');
    }

    public function showMessages()
    {
        //$users = DB::connection('metrolog_mysql')->select('select * from jos_users');

        /*$users = User::all();
        foreach ($users as $user){
            echo $user->name ." ". $user->usertype ."<br>";
        }*/

        //return view('app/pages/messages')->with('activeNav', 'messages');
    }

    public function viewDoc($name)
    {

        $doc = Doc::find($name);
        $marking = $doc->marking;
        $source = url(config('app.pdf_view') . $doc->reference);
        $descr = $doc->description;
        return view('app/pages/viewer')
            ->with('activeNav', 'main')
            ->with('source', $source)
            ->with('marking', $marking)
            ->with('descr', $descr);
    }


}
