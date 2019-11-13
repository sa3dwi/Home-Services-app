<?php


namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
use Illuminate\Validation\Validator;
use App\Http\Requests\Request;

abstract class BackendRequest extends Request {
	/**
	 * {@inheritdoc}
	 */
//	protected function formatErrors( Validator $validator ) {
//		$route   = \Route::getCurrentRoute();
//		$nameArr = explode( '.', $route->getName() );
//
//		if ( $nameArr[0] == 'authors' ) {
//			$routeName = 'authors_list';
//		} else {
//			unset( $nameArr[ count( $nameArr ) - 1 ] );
//			$routeName = implode( '.', $nameArr );
//		}
//
//		$formatedErrors = [ ];
//		foreach ( $validator->errors()->getMessages() as $key => $errors ) {
//			foreach ( $errors as $error ) {
//				if ( str_is( '*مُستخدمة*', $error ) || str_is( '*taken*', $error ) ) {
//					$formatedErrors[ $key ][] = $error . ' ' . link_to( route( $routeName, [ 'search' => '1', 'keywords' => $this->input( $key ) ] ), trans( 'backend.general.goto_row' ) );
//				} else {
//					$formatedErrors[ $key ][] = $error;
//				}
//			}
//
//		}
//
//		return $formatedErrors;
//	}


}