<?php

class TaskController extends BaseController {

    /**
     * Показывает задание
     */
    public function index()
    {
        $this->render('task');
    }
}