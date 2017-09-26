<?php

namespace App\Modules\Pages\Controllers;

use App\Modules\Documents\Models\Doc;
use App\Modules\UrlUtility;

class PageController extends \App\Http\Controllers\Controller
{
    public function showHome()
    {
        $activeNav = UrlUtility::getActiveLinkArray('main');
        return view('Pages::main')->with('activeNav', $activeNav);
        //return view('app/pages/main')->with('activeNav', $activeNav);
    }

    public function operationDoc()
    {
        $activeNav = UrlUtility::getActiveLinkArray('main');
        return view('Documents::index')->with('activeNav', $activeNav);
    }


    public function viewDoc($id)
    {

        $doc = Doc::find($id);
        $marking = $doc->marking;
        $source = url(config('app.pdf_view') . $doc->reference);
        $descr = $doc->description;
        $activeNav = UrlUtility::getActiveLinkArray('main');

        return view('Pages::viewer')
            ->with('activeNav', $activeNav)
            ->with('source', $source)
            ->with('marking', $marking)
            ->with('descr', $descr);
    }


}
