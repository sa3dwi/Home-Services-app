<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Workers;
use App\Reviews;
use App\Nationalities;
use App\Cities;
use App\Services;

class WorkersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $workers = Workers::latest()->paginate( 20 );
        if ( \Request::input( 'search' ) ) {
            $workers = $this->search();
        }

        \Session::put( 'currentPage', (int) \Request::input( 'page' ) );
        return view(  'backend.workers.index' , compact( 'workers' ) );
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */
    public function profile( Request $request ) {
        $worker = Workers::with('reviews')->where('_id',$request->input('token'))->get();
        return response()->json($worker);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */
    public function pick( Request $request ) {
        //TODO: order by rate
        $worker = Workers::with('reviews')
            ->where('service_id', $request->input('service_id'))
            ->where('map_let', $request->input('map_let'))
            ->where('map_lon', $request->input('map_lon'))->paginate( 20 );
        return response()->json($worker);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $nationalitiesList = Nationalities::pluck( 'name', 'id' )->all() ?: [];
        $citiesList = Cities::pluck( 'name', 'id' )->all();
        $servicesList = Services::pluck( 'name', 'id' )->all();
        return view( $this->getTemplatePath( 'create', compact( 'citiesList','nationalitiesList','servicesList') ) );
    }

    /**
     * Store a newly created resource in storage/registration.
     * @param Request $request
     * @return Response
     */
    public function store( Request $request ) {

        $sms_code = mt_rand(100000,999999);
        $request->merge(['sms_code'=>$sms_code]);
        $worker = Workers::create( $request->except( ['_token','map_location_lat','map_location_lon'] ) );

        $data = [ '$set' => [ 'map_location'=> [ 'type' => "Point", 'coordinates' => [ $request->input('map_location_lat'), $request->input('map_location_lon') ] ] ] ];
        \DB::collection('workers')->where('_id', $worker->id)
            ->update($data, ['upsert' => false, 'multi'=>false]);

        if ( $request->hasFile( 'profile_photo' ) ) {
            $this->moveUploadedImage( $request->file( 'profile_photo' ), 'workers', 'worker-'.$worker->id  );
        }
        if ( $request->hasFile( 'iqama_pic' ) ) {
            $this->moveUploadedImage( $request->file( 'iqama_pic' ), 'workers', 'worker-'.$worker->id  );
        }
        if ( $request->hasFile( 'labor_card_pic' ) ) {
            $this->moveUploadedImage( $request->file( 'labor_card_pic' ), 'workers', 'worker-'.$worker->id  );
        }

        // send sms
        $sms_code_send = 0;
        $mob = (int) $request->input('mob');
        $msg = $sms_code;
        $this->SendSms($mob,$msg);
        if($this->SendSms($mob,$msg))
            $sms_code_send = 1;

        // API
        if($request->header( 'mobileAuthorization' )){
            return response()->json(['message'=>'worker_registration_done','status_code'=>1,'sms_code_send'=>$sms_code_send,'token' => $worker->_id]);
        }

        return redirect( route( 'workers' ) );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function verification( Request $request ) {
        $worker_verification = Workers::where([
            ['_id', $request->input('token')],['sms_code',(int) $request->input('sms_code')]])->get();

        if($request->header( 'mobileAuthorization' )){
            if($worker_verification->count()){
                return response()->json(['message'=>'worker_verification_done','status_code'=>1]);
            }
            return response()->json(['message'=>'worker_verification_failed','status_code'=>0]);
        }

        //return view( $this->getTemplatePath( 'create' ) );
    }

    /**
     * get around workers.
     * @param Request $request
     * @return Response
     */
    public function around( Request $request ) {

        $lon = (double) $request->input('lon');
        $lat = (double) $request->input('lat');
        $distance = (int) $request->input('distance');

        $workers_around = Workers::raw(function($collection) use ($lon,$lat,$distance)
        {
            return $collection->find([ 'map_location' => [ '$nearSphere' => [ '$geometry' => [ 'type' => "Point", 'coordinates' => [ $lon, $lat ] ], '$maxDistance' => ($distance * 1000) ] ] ]);
        });

        if($request->header( 'mobileAuthorization' )){
            if($workers_around->count()){
                return response()->json($workers_around);
            }
            return response()->json(['message'=>'workers_around_not_found','status_code'=>0]);
        }

        //return view( $this->getTemplatePath( 'around' ) );
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int $id
     * @return Response
     */
    public function edit( $id ) {
        $worker = Workers::findOrFail( $id );
        return view( $this->getTemplatePath( 'edit' ), compact( 'worker' ) );
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param  int $id
     * @return Response
     */
    public function update( Request $request, $id ) {
        $worker = Workers::findOrFail( $id );
        $worker->update( $request->except( '_token' ) );

        $currentPage = (int) \session( 'currentPage' );
        if ( $request->hasFile( 'photo' ) ) {
            $this->deleteImageIfExist( 'workers', $worker->photo );
            $this->moveUploadedImage( $request->file( 'photo' ), 'workers', 'workers-'.time() );
        }

        return redirect( route( 'workers', [ ( $currentPage > 0 ? 'page=' . $currentPage : '' ) ] ) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( $id ) {
        $page = Workers::findOrFail( $id );
        $page->delete();

        return redirect()->back();
    }


    public function deleteImage( $id ) {
        $row = Workers::findOrFail( $id );

        if ( ! empty( $row->photo ) ) {
            $photo = public_path( '/' . env( 'IMAGE_UPLOAD_PATH' ) . 'workers/' . $row->getOriginal( 'photo' ) );
            @unlink( $photo );
            Workers::where( 'id', $id )->update( [ 'photo' => '' ] );
        }

        return redirect()->back();

    }

    public function getModel() {
        return new Workers();
    }

    protected function getTemplateFolder() {
        return "workers";
    }
}
