<?php namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard $auth
     * @param  \Illuminate\Contracts\Auth\Registrar $registrar
     *
     * @return void
     */
    public function __construct( Guard $auth, Registrar $registrar ) {
        \Debugbar::disable();
        $this->auth      = $auth;
        $this->registrar = $registrar;

        $this->middleware( 'guest', [ 'except' => 'getLogout' ] );
    }

    public function getLogin() {
        return view( 'backend.auth.login' );
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin( Request $request ) {
        $v = \Validator::make( $request->only( [ 'email', 'password' ] ), [
            'email'    => 'required|email',
            'password' => 'required',
        ] );

        if ( ! $v->passes() ) {
            return response()->json( [ 'login_status' => 'invalid' ] );
        }

        $credentials = $request->only( 'email', 'password' );

        if ( \AdminAuth::attempt( $credentials, $request->has( 'remember' ) ) ) {
            return response()->json( [ 'login_status' => 'success' ] );
        }

        return response()->json( [ 'login_status' => 'invalid', 'info' => 'yes' ] );
    }
}
