<?php 

class DB {

    private $settings;
    private $connection;

    public static $instance = null;

    private function __construct()
    { 

        $this->settings = [
            'host'     => 'localhost',
            'user'     => 'root',
            'password' => '',
            'database' => 'netpeak_catalog',
            'port'     => 3306
        ];
        
        $this->connection = new PDO('mysql:host=' . $this->settings['host'] . ';dbname=' . $this->settings['database'], $this->settings['user'], $this->settings['password']);
    }

    public static function connect()
    {
        if (is_null(self::$instance)) {
            self::$instance = new DB();
        } 

        return self::$instance;
    }

    public function execute($query, $bindParameters = [], $fetchMode = PDO::FETCH_ASSOC)
    {
        $stmt = $this->query($query, $bindParameters, $fetchMode);
        return !is_null($stmt);
    }

    public function query($query, $bindParameters = [], $fetchMode = PDO::FETCH_ASSOC)
    {
        $stmt = $this->connection->prepare($query);
        if ($stmt->execute($bindParameters)) {
            return $stmt;
        }

        return null;
    }

    public function fetch($query, $bindParameters = [], $fetchMode = PDO::FETCH_ASSOC)
    {
        $record = [];

        $stmt = $this->query($query, $bindParameters, $fetchMode);
        if (!is_null($stmt)) {
            $record = $stmt->fetch($fetchMode);
        }

        return $record;
    }

    public function fetchAll($query, $bindParameters = [], $fetchMode = PDO::FETCH_ASSOC)
    {
        $records = [];

        $stmt = $this->query($query, $bindParameters, $fetchMode);
        if (!is_null($stmt)) {
            $records = $stmt->fetchAll($fetchMode);
        }

        return $records;
    }

}