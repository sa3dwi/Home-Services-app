<?php namespace App\Http\Controllers\Backend;

ini_set( 'memory_limit', '-1' );
set_time_limit( 0 );

use Illuminate\Database\Eloquent\Model;
use Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;
use Validator;
use RecursiveIteratorIterator;
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;
use Symfony\Component\HttpFoundation\File\UploadedFile;

defined( 'ROWS_PER_PAGE' ) or define( 'ROWS_PER_PAGE', 20 );

abstract class Controller extends BaseController {

	use ValidatesRequests;

	function __construct() {
//	    \Cache::flush();

		//\Debugbar::disable();
//		if ( \Input::get( 'debug' ) == 1 ) {
//			\Debugbar::enable();
//		}
		//$this->rows_per_page = (int) empty( \Input::get( 'count' ) ) ? 20 : \Input::get( 'count' );
	}


	function htmlSelectListOptions( $items ) {
		$htmlSelectListOptions = '';
		foreach ( $items as $id => $name ) {
			$htmlSelectListOptions .= '<option value="' . $id . '">' .  $name . '</option>';
		}

		return $htmlSelectListOptions;
	}

    function htmlAuthorsSelectListOptions( $items ) {
        $htmlSelectListOptions = '';
        foreach ( $items as $item ) {
            $htmlSelectListOptions .= '<option class="authors_names_'.$item->locale.'" value="' . $item->author_id . '">' .  $item->name . '</option>';
        }

        return $htmlSelectListOptions;
    }

	function categoriesCheckBoxes( $categories, $selected = [ ] ) {
		$cats = '<ul style="list-style-type: none;">';
		foreach ( $categories as $category ) {
			$checked = '';
			if ( in_array( $category->id, $selected ) ) {
				$checked = 'checked';
			}
			$cats .= '<li><div class="checkbox"><label><input type="checkbox" name="categories[]" value="' . $category->id . '" ' . $checked . ' />' . $category->name . '</label></div>';
			if ( ! empty( $category->childrens ) ) {
				$cats .= $this->categoriesCheckBoxes( $category->childrens );
			}
			$cats .= '</li>';
		}
		$cats .= '</ul>';

		return $cats;
	}

	/**
	 * @return string
	 */
	protected function getTemplatePath( $template ) {
		return sprintf( 'backend.%s.%s', $this->getTemplateFolder(), $template );
	}
	/**
	 * @return array|RecursiveIteratorIterator
	 */
	protected function getTmpFolders() {
		$directory = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( env( 'TMP_SOUNDS_UPLOAD_PATH' ), FilesystemIterator::SKIP_DOTS ), true );
		foreach($directory as $path) {
			if ($path->isDir()) {
				$files[] = $path;
			}
		}

		array_unshift( $files, trans( 'backend.general.sound_file' ) );

		return $files;
	}

	public function moveUploadedImage( $file, $destination, $fileName ) {
		if ( ! ( $file instanceof UploadedFile ) ) {
			return false;
		}

		$fullName = null;
		if ( $file->isValid() ) {
			$fullName = $fileName . '.' . $file->guessExtension();

			$file->move( env( 'IMAGE_UPLOAD_PATH' ) . $destination, $fullName );
		}

		return $fullName;
	}

	protected function deleteImageIfExist( $folder, $file ) {
		if ( empty( $file ) ) {
			return;
		}
		$filePath = sprintf( '%s%s/%s', env( 'IMAGE_UPLOAD_PATH' ), $folder, $file );
		if ( Storage::exists( $filePath ) ) {
			Storage::delete( $filePath );
		}
	}

//	public function search( $paginate = true ) {
//
//		$keywords = \Request::input( 'keywords' );
//		$model    = $this->getModel();
//		$table    = $model->getTable();
//
//		$query  = \DB::table( $table );
//		$select = [ ];
//		if ( isset( $model->translatedAttributes ) && count( $model->translatedAttributes ) ) {
//			$singularTableName = str_singular( $table );
//			$translationsTable = sprintf( '%s_translations', $singularTableName );
//			$fields            = $model->translatedAttributes;
//			$query->join( $translationsTable, $table . '.id', '=', sprintf( '%s.%s_id', $translationsTable, $singularTableName ) );
//			$query->orWhere( function ( $query ) use ( $fields, $keywords ) {
//				foreach ( $fields as $field ) {
//					$query->orWhere( $field, 'LIKE', '%' . $keywords . '%' );
//				}
//			} );
//			foreach ( $fields as $field ) {
//				$select[] = $translationsTable . '.' . $field;
//			}
//		} else {
//			foreach ( $model->getFillable() as $field ) {
//				$select[] = $table . '.' . $field;
//				$query->orWhere( $field, 'LIKE', '%' . $keywords . '%' );
//			}
//		}
//
//		$select[] = $table . '.id';
//		$select[] = $table . '.created_at';
//		$select[] = $table . '.updated_at';
//
//		$query->select( $select );
//		$query->groupBy( $table . '.id' );
//
//
//		return ( $paginate ? $query->paginate( $this->rows_per_page ) : $query );
//	}

	abstract protected function getTemplateFolder();

	/**
	 * @return Model|Translatable
	 */
	abstract protected function getModel();
}
