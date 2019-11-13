<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use App\Workers;

class CitiesController extends Controller
{

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */
    public function index( Request $request ) {
        $cities = Cities::latest()->paginate( 50 );
        if ( \Request::input( 'search' ) ) {
            $workers = $this->search();
        }

        //API Response
        if($request->header( 'Authorization' )){
            return response()->json($cities);
        }

        \Session::put( 'currentPage', (int) \Request::input( 'page' ) );
        return view(  'backend.cities.index' , compact( 'cities' ) );

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( $id ) {
        $page = Cities::findOrFail( $id );
        $page->delete();

        return redirect()->back();
    }

    public function getModel() {
        return new Cities();
    }

    protected function getTemplateFolder() {
        return "cities";
    }
}
