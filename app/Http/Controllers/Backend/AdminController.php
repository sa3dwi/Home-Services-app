<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view( 'backend.layout' );
    }

    protected function getTemplateFolder() {
        return "";
    }


    /**
     * @return Model|Translatable
     */
    protected function getModel() {
        //return new Admin();
    }
}
