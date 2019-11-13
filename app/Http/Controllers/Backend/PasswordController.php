<?php namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PasswordController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/

	use ResetsPasswords;

	/**
	 * Create a new password controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\PasswordBroker $passwords
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware( 'guest' );
	}

	/**
	 * Display the form to request a password reset link.
	 *
	 * @return Response
	 */
	public function getEmail() {
		return view( 'backend.auth.password' );
	}

	/**
	 * Send a reset link to the given user.
	 *
	 * @param  Request $request
	 *
	 * @return Response
	 */
	public function postEmail( Request $request ) {
		$this->validate( $request, [ 'email' => 'required|email' ] );

		$response = \AdminPasswordBroker::sendResetLink( $request->only( 'email' ), function ( $m ) {
			$m->subject( trans( 'backend.reset.subject' ) );
		} );

		switch ( $response ) {
			case PasswordBroker::RESET_LINK_SENT:
				return response()->json( [ 'email_status' => 'success' ] );

			case PasswordBroker::INVALID_USER:
				return response()->json( [ 'email_status' => 'invalid' ] );
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string $token
	 *
	 * @return Response
	 */
	public function getReset( $token = null ) {
		if ( is_null( $token ) ) {
			throw new NotFoundHttpException;
		}

		return view( 'backend.auth.reset' )->with( 'token', $token );
	}

	/**
	 * Reset the given user's password.
	 *
	 * @param  Request $request
	 *
	 * @return Response
	 */
	public function postReset( Request $request ) {
		$this->validate( $request, [
			'token'    => 'required',
			'email'    => 'required|email',
			'password' => 'required|confirmed',
		] );

		$credentials = $request->only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = \AdminPasswordBroker::reset( $credentials, function ( $user, $password ) {
			$user->password = $password;

			$user->save();

			\AdminAuth::login( $user );
		} );

		switch ( $response ) {
			case PasswordBroker::PASSWORD_RESET:
				return redirect( route( 'backend_dashboard' ) );

			default:
				return redirect()->back()
				                 ->withInput( $request->only( 'email' ) )
				                 ->withErrors( [ 'email' => trans( $response ) ] );
		}
	}

}
