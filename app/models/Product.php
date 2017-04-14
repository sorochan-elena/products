<?php

/**
 * Класс Product отвечает за хранение данных о товаре, а также за операции CRUD
 */

class Product {

	/**
	 * ID товара
	 * @var iteger
	 */
    private $id;

    /**
     * Название товара
     * @var string
     */
    private $name;

    /**
     * Описание товара
     * @var string
     */
    private $description;

    /**
     * Цена товара
     * @var float
     */
    private $price;

    /**
     * Статус товара
     * @var integer
     */
    private $status;

    /**
     * Константы товара, необходимые для задания статуса:
     *   Product::IN_STOCK - товар в наличии
     *   Product::OUT_OF_STOCK - товара нет в наличии
     *   Product::UNAVAILABLE - товар удален и в каталоге не выводится
     */
    const IN_STOCK     = 1;
    const OUT_OF_STOCK = 2;
    const UNAVAILABLE  = 3;

    public function __construct($data = [])
    {
        $this->id = isset($data['id']) ? $data['id'] : 0;
        $this->name = isset($data['name']) ? $data['name'] : '';
        $this->description = isset($data['description']) ? $data['description'] : '';
        $this->price = isset($data['price']) ? $data['price'] : 0;
        $this->status = isset($data['status']) ? $data['status'] : self::IN_STOCK;
    }

    /**
     * Задает название товара
     * 
     * @param string $value Название
     */
    public function setName($value)
    {   
        $this->name = $value;
    }

    /**
     * Задает описание товара
     * 
     * @param string $value Описание
     */
    public function setDescription($value)
    {   
        $this->description = $value;
    }

    /**
     * Задает цену товара
     * 
     * @param float $value Цена товара
     */
    public function setPrice($value)
    {   
    	if ($value > 0) {
    		$this->price = $value;
    	}
    }

    /**
     * Задает статус товара
     * 
     * @param integer $status Статус товара
     */
    public function setStatus($value)
    {   
    	if (in_array($value, [self::IN_STOCK,  self::OUT_OF_STOCK, self::UNAVAILABLE])) {
    		$this->status = $value;
    	}
    }

    /**
     * Возвращает ID
     * 
     * @return integer ID товара
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Возвращает название 
     * 
     * @return string Название товара
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Возвращает описание
     * 
     * @return string Описание товара
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Возвращает цену
     * 
     * @return float Цена товара
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Возвращает статус
     * 
     * @return integer Статус товара
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Возвращает текстовое описание статуса
     * 
     * @return string Текст статуса
     */
    public function getStatusLabel()
    {
        switch ($this->status) {
            case self::IN_STOCK:
                return 'В наличии';
            case self::OUT_OF_STOCK:
                return 'Нет в наличии';
        }

        return false;
    }

    /**
     * Сохранение
     * 
     * @return bool Результат сохранения
     */
    public function save()
    {
        if ($this->id == 0) {
            return $this->create();
        } else {
            return $this->update();
        }
    }

    /**
     * Создание товара
     * 
     * @return bool Результат сохранения
     */
    private function create()
    {
        $query = 'INSERT INTO products (name, description, price, status)
                  VALUES (:name, :description, :price, :status)';

        return DB::connect()->execute($query, [
            ':name' => $this->name,
            ':description' => $this->description,
            ':price' => $this->price,
            ':status' => $this->status
        ]);
    }

    /**
     * Обновление данных товара
     * 
     * @return bool Результат сохранения
     */
    private function update()
    {
        $query = 'UPDATE products
                  SET name = :name, description = :description, price = :price, status = :status
                  WHERE id = :id';

        return DB::connect()->execute($query, [
            ':name' => $this->name,
            ':description' => $this->description,
            ':price' => $this->price,
            ':status' => $this->status,
            ':id' => $this->id
        ]);
    }

    /**
     * Удаление товара
     * 
     * @return bool Результат удаления
     */
    public function delete()
    {
        return DB::connect()->execute('DELETE FROM products WHERE id = ?', [
            $this->id
        ]);
    }

    /**
     * Поиск товара по ID
     *
     * Если передан ID, равный 0, метод вернет пустой обьект Product (создание нового товара)
     * Если передан ID, отличный от 0, метод будет искать товар в БД. Если товар не найден - вернет false.
     * 
     * @param  integer $id ID товара
     * @return bool | Product Вернет найденный товар, или false в случае ошибки
     */
    public static function getById($id)
    {

    	if ($id == 0) {
    		return new Product();
    	}

        $data = DB::connect()->fetch('SELECT * FROM products WHERE id = ?', [
            $id
        ]);   

        if (!empty($data)){
            return new Product($data);
        }

        return false;
    }
}