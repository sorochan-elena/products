<?php

class BaseController {
    
    public $viewsPath;
    public $layout;

    public function __construct()
    {
        $this->viewsPath = $_SERVER['DOCUMENT_ROOT'] . '/app/views/';
        $this->layout = 'layout';
    }

    /**
     * Рендерит вид и отображает на странице
     * 
     * @param  stiring $view      Название файла с видом (без расширения файла)
     * @param  array  $parameters Массив данных, которые нужно передать в вид
     */
    public function render($view, $parameters = [])
    {
        $pageContent = $this->fetch($view, $parameters);

        include $this->viewsPath . $this->layout . ".php";
    }

    /**
     * Рендерит вид и возвращает его, без отображения на странице
     * 
     * @param  stiring $view      Название файла с видом (без расширения файла)
     * @param  array  $parameters Массив данных, которые нужно передать в вид
     * @return string             Код вида
     */
    public function fetch($view, $parameters = [])
    {
        ob_start();

        if (!empty($parameters)) {
            extract($parameters);
        }

        include $this->viewsPath . $view . ".php";

        return ob_get_clean();
    }

    /**
     * Отображает 404-ую страницу, если страница не найдена
     */
    public function notFound(){
        http_response_code(404);
        $this->render('404');
    }
}