<?php

class IndexController extends BaseController {

    /**
     * Отображение каталога товаров
     */
    public function index()
    {
        $this->render('catalog', $this->getCatalog($_GET));
    }

    public function task()
    {
        $this->render('task');
    }

    /**
     * Отображение каталога товаров при AJAX запросе     
     */
    public function getCatalogAjax()
    {

    	$data = $this->getCatalog($_POST);

    	echo json_encode([
    		'success' => !empty($data),
    		'products' => $this->fetch('catalog_ajax', $data),
    		'request' => $data['request']
    	]);
    }

    /**
     * Обрабатывает входящие $_GET или $_POST параметры, и делаете выборку товаров каталога
     * 
     * @param  array  $request Параметры запроса (POST или GET массив)
     * @return array  Массив дынных, достаточный для формирования отображения каталога
     */
    private function getCatalog($request = [])
    {
    	
    	$catalog = new Catalog();

    	$filters = [
    		'length' => [
    			9, 12, 18
    		],
    		'field' => [
    			'id'     => 'Дата создания',
    			'name'   => 'Название',
    			'price'  => 'Цена',
    			'status' => 'Статус'
    		],
    		'order' => [
    			'asc'  => 'По возрастанию',
    			'desc' => 'По убыванию'
    		]
    	];

    	$request['field'] = (isset($request['field']) && isset($filters['field'][$request['field']])) ? $request['field'] : 'id';
    	$request['order'] = (isset($request['order']) && isset($filters['order'][$request['order']])) ? $request['order'] : 'desc';
    	$request['length'] = (isset($request['length']) && in_array($request['length'], $filters['length'])) ? $request['length'] : 9;
    	$request['page'] = (isset($request['page']) && $request['page'] > 0) ? $request['page'] : 1;

    	// total count
    	$catalog->setOrdering($request['field'], $request['order']);
        $catalog->setFilter('status', Product::UNAVAILABLE, '!=');
        $totalCount = count($catalog->get());

        $pagination = getPagination($request['page'], $totalCount, $request['length']);

        if ($pagination[1] > $pagination[2]){
        	$pagination[1] = $pagination[2];
        	$request['page'] = $pagination[1];
        }

        $catalog->setOrdering($request['field'], $request['order']);
        $catalog->setFilter('status', Product::UNAVAILABLE, '!=');
        $catalog->setLimit($request['length']);
        $catalog->setOffset(($request['page'] - 1) * $request['length']);
        $products = $catalog->get();

        return [
        	'pagination' => $pagination,
        	'products' => $products,
        	'filters' => $filters,
        	'request' => $request
        ];
    }

    /**
     * Редактирование товара
     */
    public function editProductAjax()
    {

        if (isset($_POST['id'])){
        	$id = intval($_POST['id']);
        } else {
        	exit('Invalid data');
        }

		$product = Product::getById($id);
		if ($product !== false) {
			$title = $product->getId() > 0 ? 'Редактирование товара `' . $product->getName() . '`' : 'Добавить новый товар';
	        $form = $this->fetch('edit_product_form', [
	            'product' => $product
	        ]);

	        echo json_encode([
	            'form' => $form,
	            'title' => $title
	        ]);
		}
    }

    /**
     * Удаление товара
     */
    public function deleteProductAjax()
    {

        if (isset($_POST['id'])){
        	$id = intval($_POST['id']);
        } else {
        	exit('Invalid data');
        }

		$product = Product::getById($id);
		if ($product !== false){
			$product->setStatus(Product::UNAVAILABLE);
	        if ($product->save()){
	            echo json_encode([
	                'success' => true
	            ]);
	        }
		}

        exit;
    }

    /**
     * Восстановление товара после удаления
     *
     * Товар считается удаленным если его статус равен Product::UNAVAILABLE
     * В случае если товар найден и является удаленным, его можно восстановить
     * 
     */
    public function recoverProductAjax()
    {

        if (isset($_POST['id'])){
        	$id = intval($_POST['id']);
        } else {
        	exit('Invalid data');
        }

		$product = Product::getById($id);
        if ($product !== false && $product->getStatus() == Product::UNAVAILABLE) {
            $product->setStatus(Product::IN_STOCK);
	        if ($product->save()){
	            echo json_encode([
	                'success' => true
	            ]);
	        }
        }

        exit;
    }

    /**
     * Сохранение товара
     */
    public function saveProductAjax()
    {

        // check fields existance
        foreach (['id', 'name', 'description', 'price', 'status'] as $field){
            if (!isset($_POST[$field])) {
                exit('Invalid data');
            }
        }

        $id = intval($_POST['id']);
        $product = Product::getById($id);
        if ($product !== false) {

        	$filter = new Filter();

        	// filter name
	        $name = $filter->sanitize($_POST['name'], 'string!');
	        if (!empty($name)) {
	        	$product->setName($name);
	        }

	        // filter description
	        $description = $filter->sanitize($_POST['description'], 'string!');
	        $product->setDescription($description);

	        // filter price
	        $price = $filter->sanitize($_POST['price'], 'float!');
	        $product->setPrice($price);

	        // filter status
	        $status = $filter->sanitize($_POST['status'], 'int!');
	        if (in_array($status, [Product::IN_STOCK, Product::OUT_OF_STOCK])) {
	            $product->setStatus($status);
	        }

	        // save product
	        if ($product->save()){
	            echo json_encode([
	                'success' => true
	            ]);
	        }
        } 

        exit;
    }
}