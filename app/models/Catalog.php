<?php 

/**
 * Класс Catalog отвечает за поиск товаров
 */

class Catalog {

	/**
	 * Массив товаров
	 * @var array
	 */
    private $products = [];

    /**
     * Массив фильтров
     * @var array
     */
    private $filters = [];

    /**
     * Порядок сортировки товаров. Первый элемент - поле, по которому сортируем, второй - направление (desc, asc)
     * 
     * @var array
     */
    private $orderBy = [];

    /**
     * Количество товаров на странице
     * @var integer
     */
    private $limit = 100;

    /**
     * Порядковый номер товара, с которого нужно начинать вывод
     * @var integer
     */
    private $offset = 0;


    /**
     * Задание параметров по умолчанию
     *
     * По умолчанию сортировка идет по дате создания по убыванию
     */
    public function construct()
    {
        $this->orderBy = [
            'id', 'DESC'
        ];
    }

    /**
     * Задание значния фильтры
     * 
     * @param string $filterName    Название фильтра
     * @param mixed  $filterValue   Значение
     * @param string $operationType Тип операции
     */
    public function setFilter($filterName, $filterValue, $operationType = '=')
    {
        $this->filters[$filterName] = [
            'value' => $filterValue,
            'type'  => $operationType
        ];
    }

    /**
     * Задание порядка сортировки товаров
     * 
     * @param string $fieldName Название поля
     * @param string $orderType Направление сортировки
     */
    public function setOrdering($fieldName, $orderType = 'ASC')
    {
        $this->orderBy = [
            $fieldName, $orderType
        ];
    }

    /**
     * Именение количества товаров на странице
     * 
     * @param integer $value Количество товаров
     */
    public function setLimit($value) {
        if ($value >= 0) {
            $this->limit = $value;
        }
    }

    /**
     * Задание порядкового номера товара, с которого нужно начинать выборку
     * 
     * @param integer $value Порядковый номер
     */
    public function setOffset($value)
    {
        if ($value >= 0) {
            $this->offset = $value;
        }
    }

    /**
     * Поиск и выборка товаров из базы согласно заданным параметрам
     *
     * Поиск производится в соответствии с фильтрами (Catalog::$filters), сортировкой (Catalog::$orderBy), количеством (Catalog::$offset и Catalog::$limit)
     * 
     * @return array Массив результатов
     */
    private function fetch()
    {
        $query = 'SELECT id, name, price, status, description 
                  FROM products';

        $bindParameters = [];

        if (!empty($this->filters)) {

            $conditions = [];

            foreach ($this->filters as $filterName => $filterData) {

                if (is_array($filterData['value'])) {
                    // many values
                    $values = array_values($filterData['value']);
                    for ($i = 0, $temp = []; $i < count($values); $i++){
                        $paramName = ':' . $filterName . $i+1;

                        $temp[] = $paramName;
                        $bindParameters[$paramName] = $values[$i];
                    }

                    $conditions[] = $filterName . ' ' . $filterData['type'] . '(' . implode(',', $temp) . ')';

                } else {
                    // single
                    $conditions[] = $filterName . ' ' . $filterData['type'] . ' :' . $filterName;

                    if ($operationType == 'LIKE' || $operationType == 'NOT LIKE') {
                        $filterData['value'] = "'" . $filterData['value'] . "'";
                    }

                    $bindParameters[':' . $filterName] =  $filterData['value'];
                }
            }

            $query .= ' WHERE ' . implode(' AND ', $conditions);
        }

        if (!empty($this->orderBy)){
            $query .= ' ORDER BY ' . $this->orderBy[0] . ' ' . $this->orderBy[1];
        }

        $query .= ' LIMIT ' . $this->offset . ', ' . $this->limit;

        return DB::connect()->fetchAll($query, $bindParameters);
    }

    /**
     * Получение товаров
     * 
     * @return array Массив найденых товаров
     */
    public function get()
    {
        $this->products = [];

        $fetched = $this->fetch();
        if (!empty($fetched)) {
            foreach ($fetched as $item) {
                $this->products[] = new Product($item);
            }
        }

        return $this->products;
    }
}