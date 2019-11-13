<?php namespace App\Http\Controllers\Backend;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Validator;
use Request;
use Jenssegers\Date\Date;

class DashboardController extends Controller {

	public function index() {
		$usersPlays  = User::count();
		$dateNow = Date::hajridate("l d F Y, H:i A ",time());

		return view( 'backend.dashboard', compact( 'dateNow', 'usersPlays' ) );
	}

	protected function getTemplateFolder() {
		return '';
	}

	/**
	 * @return Model|Translatable
	 */
	protected function getModel() {
		// TODO: Implement getModel() method.
	}
}
