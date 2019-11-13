<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Orders;
use App\Reviews;
use App\Nationalities;
use App\Cities;
use App\Services;

class OrdersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $orders = Orders::latest()->paginate( 20 );
        if ( \Request::input( 'search' ) ) {
            $orders = $this->search();
        }

        \Session::put( 'currentPage', (int) \Request::input( 'page' ) );
        return view(  'backend.orders.index' , compact( 'orders' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view( $this->getTemplatePath( 'create') );
    }

    /**
     * Store a newly created resource in storage/registration.
     * @param Request $request
     * @return Response
     */
    public function store( Request $request ) {

        $sms_code = mt_rand(100000,999999);
        $request->merge(['sms_code'=>$sms_code]);
        $order = Orders::create( $request->except( ['_token','map_location_lat','map_location_lon'] ) );

        $data = [ '$set' => [ 'map_location'=> [ 'type' => "Point", 'coordinates' => [ $request->input('map_location_lat'), $request->input('map_location_lon') ] ] ] ];
        \DB::collection('orders')->where('_id', $order->id)
            ->update($data, ['upsert' => false, 'multi'=>false]);

        // API
        if($request->header( 'mobileAuthorization' )){
            return response()->json(['message'=>'order_registration_done','status_code'=>1,'token' => $order->_id]);
        }

        return redirect( route( 'orders' ) );
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int $id
     * @return Response
     */
    public function edit( $id ) {
        $order = Orders::findOrFail( $id );
        return view( $this->getTemplatePath( 'edit' ), compact( 'order' ) );
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param  int $id
     * @return Response
     */
    public function update( Request $request, $id ) {
        $order = Orders::findOrFail( $id );
        $order->update( $request->except( '_token' ) );

        $currentPage = (int) \session( 'currentPage' );
        if ( $request->hasFile( 'photo' ) ) {
            $this->deleteImageIfExist( 'orders', $order->photo );
            $this->moveUploadedImage( $request->file( 'photo' ), 'orders', 'orders-'.time() );
        }

        return redirect( route( 'orders', [ ( $currentPage > 0 ? 'page=' . $currentPage : '' ) ] ) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( $id ) {
        $page = Orders::findOrFail( $id );
        $page->delete();

        return redirect()->back();
    }


    public function deleteImage( $id ) {
        $row = Orders::findOrFail( $id );

        if ( ! empty( $row->photo ) ) {
            $photo = public_path( '/' . env( 'IMAGE_UPLOAD_PATH' ) . 'orders/' . $row->getOriginal( 'photo' ) );
            @unlink( $photo );
            Orders::where( 'id', $id )->update( [ 'photo' => '' ] );
        }

        return redirect()->back();

    }

    public function getModel() {
        return new Orders();
    }

    protected function getTemplateFolder() {
        return "orders";
    }
}
