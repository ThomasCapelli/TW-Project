<?php
class DatabaseHelper{

    private $db;
    public function __construct($serername, $username, $password, $dbname, $port){
        //connessione a DB
        $this->db = new mysqli($serername, $username, $password, $dbname, $port);
        if($this->db->connect_error) {
            die("connessione al DB fallita");
        }
    }
    
    public function getCategories() {
        $stmt = $this->db->prepare("SELECT * FROM categoria");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getSales($n = 6) {
        $stmt = $this->db->prepare("SELECT NomeProdotto, Prezzo, Descrizione_Breve, Sconto 
        FROM prodotto WHERE Sconto > 0 
        ORDER BY Prezzo ASC
        LIMIT ?");
        $stmt->bind_param("i", $n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function checkLogin($username, $password){
        $query = "SELECT Email, Nome FROM utente WHERE Email= ? AND Password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss',$username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }    
    public function getBestSellers($n = 3) {
        $stmt = $this->db->prepare("SELECT NomeProdotto, Prezzo, Descrizione_Breve
        FROM prodotto ORDER BY Prezzo DESC LIMIT ?");
        $stmt->bind_param("i", $n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getProductsByCategory($categoryId) {
        $stmt = $this->db->prepare("SELECT * FROM prodotto WHERE IdCategoria = ?");
        $stmt->bind_param("i", $categoryId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getCategoryById($categoryId) {
        $stmt = $this->db->prepare("SELECT * FROM categoria WHERE IdCategoria = ?");
        $stmt->bind_param("i", $categoryId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

}
?>