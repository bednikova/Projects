<?php
namespace Pragmatic;

class ModelHelper {
	
	public static $classProperties = array();

	/**
	 * 
	 * Extracts class properties from an object
	 * 
	 * @param type $model
	 * @return Array an array of properties
	 */
	private static function extractClassProperties($model) {
		
		$modelClass = get_class($model);
		
		if (array_key_exists($modelClass, self::$classProperties) ) {
			return self::$classProperties[$modelClass];
		}
		
		$rawData = (array)$model;
		$keys = array_keys($rawData);
		$properties = array();
		foreach ($keys as $key=>$value) {
			$properties[] = preg_replace('/(.+?[^a-z0-9]*)([a-z0-9]+)$/i', '\2', $value);
		}
		
		self::$classProperties[$modelClass] = $properties;
		
		return self::$classProperties[$modelClass];
	}
	
	/**
	 * 
	 * Builds getter method name
	 * 
	 * @param type $property
	 * @return string the getter method name
	 */
	private static function buildGetter($property) {
		return "get".ucfirst($property);
	}
	
	/**
	 * 
	 * Builds setter method name
	 * 
	 * @param type $property
	 * @return string the setter method name
	 */
	private static function buildSetter($property) {
		return "set".ucfirst($property);
	}

	/**
	 * 
	 * Translates to snake_style from pascalCase
	 * 
	 * @param type $name
	 * @return type
	 */
	public static function nameToSnakeStyle($name) {
		return preg_replace_callback(
				'/([A-Z])/', 
				function($matches){
					return '_'.strtolower($matches[1]);
				},
				$name);
	}

	/**
	 * 
	 * Converts a model onject to an associative array
	 * 
	 * @param type $model
	 * @return type
	 */
	public static function modelToArray($model, $useSnakeStyle = true) {
		
		$classProperties = self::extractClassProperties($model);
		$data = array();
		
		foreach ($classProperties as $property) {
			
			$methodName = self::buildGetter($property);
			
			if ( !method_exists($model, $methodName) ) {
				continue;
			}
			
			if ( $useSnakeStyle ) {
				$data[self::nameToSnakeStyle($property)] = $model->$methodName();
			} else {
				$data[$property] = $model->$methodName();
			}
			
		}
		
		return $data;
	}
	
	
	public static function convertToModelData($dbData, $model) {
		$data = array();
		$classProperties = self::extractClassProperties($model);
		foreach ($classProperties as $property) {
			$arrayKey = self::nameToSnakeStyle($property);
			if ( !array_key_exists($arrayKey, $dbData)) {
				continue;
			}
			$data[$property] = $dbData[$arrayKey];
		}
		return $data;
	}
	
}
