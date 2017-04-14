<?php

/**
 * Класс предназначен для автозагрузки классов
 */

class Loader {

	/**
	 * Массив путей, по которым нужно искать классы
	 * 
	 * @var array
	 */
    protected static $paths = [];

    /**
     * Регистрация путей
     *
     * Каждый валидный путь из массива добавляется в Loader::$paths
     * 
     * @param  array $paths Массив путей
     */
    public function registerPaths($paths){
    	if (count($paths > 0)) {
    		foreach ($paths as $path) {
	            $path = realpath($path);
	            if ($path) {
	                self::$paths[] = $path . DIRECTORY_SEPARATOR;
	            }
	        }	
    	}
    }

    /**
     * Загрузка класса
     * 
     * @param  stirng $class Название класса
     * @return bool Возвращает true если файл класса найден и включен, false - в случае ошибки
     */
    public static function load($class) {
        $classPath = $class . ".php"; // Do whatever logic here

        if (count(self::$paths)) {
        	foreach (self::$paths as $path) {
	            if (is_file($path . $classPath)) {
	                require_once $path . $classPath;
	                return true;
	            }
	        }	
        }
        
        return false;
    }

    /**
     * Регистрация автозагрузчика
     */
    public function register(){
        spl_autoload_register([
            'Loader',
            'load'
        ]);
    }
}