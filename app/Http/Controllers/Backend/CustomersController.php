<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use App\Http\Requests\Backend\RoomsCategoriesRequest;
use App\RoomsCategories;
use App\Hotels;

class CustomersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if ( \Request::input( 'search' ) ) {
            $roomscategories = $this->search();
        } else {
            $roomscategories = RoomsCategories::latest()->paginate( 100 );
        }
        \Session::put( 'currentPage', (int) \Request::input( 'page' ) );
        return view(  'backend.roomscategories.index' , compact( 'roomscategories' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $hotellist = [];
        $hotellist = Hotels::get()->lists( 'name', 'id' );
        return view( $this->getTemplatePath( 'create', compact( 'hotellist') ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PageRequest $request
     *
     * @return Response
     */
    public function store( RoomsCategoriesRequest $request ) {
        RoomsCategories::create( $request->except( '_token' ) );
        //$this->moveUploadedImage( $request->file( 'photo' ), 'roomscategories', $slug );

        $currentPage = (int) \session( 'currentPage' );
        if ( $request->hasFile( 'photo' ) ) {
            $this->moveUploadedImage( $request->file( 'photo' ), 'roomscategories', 'roomscategories-'.time()  );
        }

        return redirect( route( 'roomscategories' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit( $id ) {
        $roomscategory     = RoomsCategories::findOrFail( $id );
        $hotellist = [];
        $hotellist = Hotels::get()->lists( 'name', 'id' );
        return view( $this->getTemplatePath( 'edit' ), compact( 'roomscategory','hotellist' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PageRequest $request
     * @param  int $id
     *
     * @return Response
     */
    public function update( RoomsCategoriesRequest $request, $id ) {
        $roomscategory = RoomsCategories::findOrFail( $id );
        $roomscategory->update( $request->except( '_token' ) );

        $currentPage = (int) \session( 'currentPage' );
        if ( $request->hasFile( 'photo' ) ) {
            $this->deleteImageIfExist( 'roomscategories', $roomscategory->photo );
            $this->moveUploadedImage( $request->file( 'photo' ), 'roomscategories', 'roomscategories-'.time() );
        }

        return redirect( route( 'roomscategories', [ ( $currentPage > 0 ? 'page=' . $currentPage : '' ) ] ) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( $id ) {
        $page = RoomsCategories::findOrFail( $id );
        //$this->deleteImageIfExist( 'roomscategories', $page->photo );
        $page->delete();


        return redirect()->back();
    }


    public function deleteImage( $id ) {
        $row = RoomsCategories::findOrFail( $id );

        if ( ! empty( $row->photo ) ) {
            $photo = public_path( '/' . env( 'IMAGE_UPLOAD_PATH' ) . 'roomscategories/' . $row->getOriginal( 'photo' ) );
            @unlink( $photo );
            RoomsCategories::where( 'id', $id )->update( [ 'photo' => '' ] );
        }

        return redirect()->back();

    }

    public function getModel() {
        return new RoomsCategories();
    }

    protected function getTemplateFolder() {
        return "roomscategories";
    }
}
