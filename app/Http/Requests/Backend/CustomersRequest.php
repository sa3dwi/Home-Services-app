<?php namespace App\Http\Requests\Backend;

class CustomersRequest extends BackendRequest {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		$id = \Route::input( 'id', null );

		return [
			'first_name'   => 'max:55|withoutChar|required',
			'last_name'   => 'max:55|withoutChar|required',
			//'description' => 'required',

		];
	}

}
