<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use App\Customers;

class CustomersController extends Controller
{

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */
    public function index( Request $request ) {
        if ( \Request::input( 'search' ) ) {
            $customers = $this->search();
        } else {
            $customers = Customers::latest()->paginate( 100 );
        }


        if($request->header( 'Authorization' )){
            return response()
                ->json($customers);
        }

        \Session::put( 'currentPage', (int) \Request::input( 'page' ) );
        return view(  'backend.customers.index' , compact( 'customers' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $citylist = [];
//        $citylist = city::get()->lists( 'name', 'id' );
        return view( $this->getTemplatePath( 'create', compact( 'citylist') ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store( Request $request ) {
        Customers::create( $request->except( '_token' ) );
        //$this->moveUploadedImage( $request->file( 'photo' ), 'customers', $slug );

        $currentPage = (int) \session( 'currentPage' );
        if ( $request->hasFile( 'photo' ) ) {
            $this->moveUploadedImage( $request->file( 'photo' ), 'customers', 'customers-'.time()  );
        }

        if($request->header( 'Authorization' )){
           return response()
                ->json(['name' => 'Abigail', 'state' => 'CA']);
        }

        return redirect( route( 'customers' ) );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function verification( Request $request ) {

        if($request->header( 'Authorization' )){
            return response()
                ->json();
        }
        return view( $this->getTemplatePath( 'create' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit( $id ) {
        $customers     = Customers::findOrFail( $id );
        return view( $this->getTemplatePath( 'edit' ), compact( 'customers' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PageRequest $request
     * @param  int $id
     *
     * @return Response
     */
    public function update( Request $request, $id ) {
        $customer = Customers::findOrFail( $id );
        $customer->update( $request->except( '_token' ) );

        $currentPage = (int) \session( 'currentPage' );
        if ( $request->hasFile( 'photo' ) ) {
            $this->deleteImageIfExist( 'customers', $customer->photo );
            $this->moveUploadedImage( $request->file( 'photo' ), 'customers', 'customers-'.time() );
        }

        return redirect( route( 'customers', [ ( $currentPage > 0 ? 'page=' . $currentPage : '' ) ] ) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( $id ) {
        $page = Customers::findOrFail( $id );
        $page->delete();

        return redirect()->back();
    }


//    public function deleteImage( $id ) {
//        $row = RoomsCategories::findOrFail( $id );
//
//        if ( ! empty( $row->photo ) ) {
//            $photo = public_path( '/' . env( 'IMAGE_UPLOAD_PATH' ) . 'customers/' . $row->getOriginal( 'photo' ) );
//            @unlink( $photo );
//            RoomsCategories::where( 'id', $id )->update( [ 'photo' => '' ] );
//        }
//
//        return redirect()->back();
//
//    }

    public function getModel() {
        return new Customers();
    }

    protected function getTemplateFolder() {
        return "customers";
    }
}
