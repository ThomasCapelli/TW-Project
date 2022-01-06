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
    public function getSales($n = -1) {
        $query = "SELECT NomeProdotto, Prezzo, Descrizione_Breve, Sconto 
        FROM prodotto WHERE Sconto > 0 
        ORDER BY Prezzo ASC";
        if($n > 0){
            $query .= " LIMIT ?";
        }
        $stmt = $this->db->prepare($query);
        if($n > 0){
            $stmt->bind_param('i',$n);
        }
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
    public function getProductsByCategory($NomeCategoria) {
        $stmt = $this->db->prepare("SELECT * FROM prodotto p, categoria c WHERE c.NomeCategoria = ? AND c.IdCategoria = p.IdCategoria");
        $stmt->bind_param("s", $NomeCategoria);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getProducts() {
        $stmt = $this->db->prepare("SELECT * FROM prodotto");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getCarrello() {
        $stmt = $this->db->prepare("SELECT * FROM dettaglio_ordine");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>