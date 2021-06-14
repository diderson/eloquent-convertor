<?php

namespace App\Traits;
use Illuminate\Support\Facades\DB;

trait QueryConvertorTrait {

	public function __construct() {
	}

	//convert Laravel query to readable sql
	public function eloquentToSQL($eloquent) {
		$dbWOrd = 'DB::';

		//chcek if there is DB:: string
		if (strpos($eloquent, $dbWOrd) !== false) {

			$eloquent = str_replace($dbWOrd, '', $eloquent);
			$eloquentArr = explode('->', $eloquent);
			$spChar = array("\r\n", "\n", "\r");

			$thingToremove = ['(', ')', '()', "'", 'DB::table', 'DB::', 'table', 'where', 'get', 'first'];
			$buildEloquent = '';

			foreach ($eloquentArr as $key => $eloquentString) {
				$eloquentString = trim(str_replace($spChar, '', $eloquentString));

				if (strpos($eloquentString, 'table') !== false) {
					$eloquentString = str_replace($thingToremove, '', $eloquentString);
					$buildEloquent = DB::table($eloquentString);

				} else if (strpos($eloquentString, 'where') !== false) {
					$eloquentString = str_replace($thingToremove, '', $eloquentString);
					$where = explode(',', $eloquentString);
					$buildEloquent->where(...$where);

				} else {
					$eloquentString = str_replace($thingToremove, '', $eloquentString);
					if (!empty($eloquentString)) {
						$buildEloquent->{$eloquentString}();
					}
				}
			}
		}

		$query = str_replace(array('?'), array('\'%s\''), $buildEloquent->toSql());
		$query = vsprintf($query, $buildEloquent->getBindings());

		return $query;
	}

	public function sampleQuery() {
		return DB::table('users')->where('id', 1);
	}

	public function buildFromJson($query, $json) {
		foreach ($json as $function => $value) {
			if (is_array($value)) {
				$query->{$function}(...$value);
			} else {
				$query->{$function}($value);
			}
		}

		return $query;
	}
}