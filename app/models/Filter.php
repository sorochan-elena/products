<?php

class Filter {

	const FILTER_INT         = "int";
	const FILTER_INT_CAST    = "int!";
	const FILTER_STRING      = "string";
	const FILTER_STRING_FULL = "string!";
	const FILTER_FLOAT       = "float";
	const FILTER_FLOAT_CAST  = "float!";
	const FILTER_TRIM        = "trim";
	const FILTER_STRIPTAGS   = "striptags";

	/**
	 * Очищает переменную в соответсвии с переданными фильтрами
	 * 
	 * @param  mixed  $value       Значение, которое нужно отфильтровать
	 * @param  mixed  $filters     Значение филльтра или массив фильтров
	 * @param  bool   $noRecursive Использовать рекурсию при фильтрации или нет (если передан массив в $value)
	 * @return mixed  Отфильтрованное значение
	 */
	public function sanitize($value, $filters, $noRecursive = false)
    {		
		if (is_array($filters)) {
			if (!is_null($value)){
				foreach ($filters as $filter) {
					if (is_array($value) && !$noRecursive) {
						$arrayValue = [];
						foreach ($value as $itemKey=>$itemValue) {
							$arrayValue[$itemKey] = $this->_sanitize($itemValue, $filter);
						}
						$value = $arrayValue;
					} else {
						$value = $this->_sanitize($value, $filter);
					}
				}
			}

			return $value;
		}

		if (is_array($value) && !$noRecursive) {
			$sanitizedValue = [];
			foreach ($value as $itemKey=>$itemValue) {
				$sanitizedValue[$itemKey] = $this->_sanitize($itemValue, $filters);
			}
			return $sanitizedValue;
		}

		return $this->_sanitize($value, $filters);
	}

	/**
	 * Фильтрация единственного значения (не массив)
	 *
	 * Используется в функции Filter::sanitize()
	 */
	protected function _sanitize($value, $filter)
    {

		switch ($filter) {

			case Filter::FILTER_STRING_FULL:
				return $this->sanitize($value, ["string", "striptags", "trim"]);

			case Filter::FILTER_INT:
				return filter_var($value, FILTER_SANITIZE_NUMBER_INT);

			case Filter::FILTER_INT_CAST:
				return intval($value);

			case Filter::FILTER_FLOAT_CAST:
				return floatval($value);

			case Filter::FILTER_STRING:
				return filter_var($value, FILTER_SANITIZE_STRING);

			case Filter::FILTER_FLOAT:
				return filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, ["flags"=> FILTER_FLAG_ALLOW_FRACTION]);

			case Filter::FILTER_TRIM:
				return trim($value);

			case Filter::FILTER_STRIPTAGS:
				return strip_tags($value);

			default:
				throw new Exception("Sanitize filter '" . filter . "' is not supported");
		}
	}
}