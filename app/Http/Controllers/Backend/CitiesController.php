<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use App\Workers;

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

        $worker = Workers::where('token',$request->input('token'))->get();

        return response()->json($worker);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $citylist = [];
        //$citylist = city::get()->lists( 'name', 'id' );
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
        Workers::create( $request->except( '_token' ) );

        $currentPage = (int) \session( 'currentPage' );
        if ( $request->hasFile( 'photo' ) ) {
            $this->moveUploadedImage( $request->file( 'photo' ), 'workers', 'workers-'.time()  );
        }

        return redirect( route( 'workers' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit( $id ) {
        $worker = Workers::findOrFail( $id );
        return view( $this->getTemplatePath( 'edit' ), compact( 'worker' ) );
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
