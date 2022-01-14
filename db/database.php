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
    public function changeMode($mode, $email) {
        $stmt = $this->db->prepare("UPDATE utente
        SET DarkMode = ? WHERE Email = ?");
        $stmt->bind_param('is', $mode, $email);
        return $stmt->execute();;
    }
    public function getMode($email) {
        $stmt = $this->db->prepare("SELECT DarkMode FROM utente WHERE Email = ?");
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getCategories() {
        $stmt = $this->db->prepare("SELECT * FROM categoria");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getSales($n = -1) {
        $query = "SELECT *
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
        $stmt = $this->db->prepare("SELECT *
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
    public function getProductById($idProdotto, $idcategoria) {
        $stmt = $this->db->prepare("SELECT * FROM prodotto WHERE IdProdotto = ? AND IdCategoria = ?");
        $stmt->bind_param("ii", $idProdotto, $idcategoria);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getFirstOption($idProdotto) {
        $stmt = $this->db->prepare("SELECT Colore FROM opzioni_prodotto WHERE IdProdotto = ? LIMIT 1");
        $stmt->bind_param("i", $idProdotto);
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
    public function signUp($email, $nome, $cognome, $data, $password, $indirizzo) {
        $stmt = $this->db->prepare("INSERT INTO utente
        VALUES (?, ?, ?, ?, ?, ?, ?, 0, 0)");
        $stmt->bind_param("sssssss",$email, $email, $nome, $cognome, $data, $password, $indirizzo);
        return $stmt->execute();
    }
    public function validateEmail($email) {
        $stmt = $this->db->prepare("SELECT Email FROM utente WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getOpzioni($idprodotto, $idcategoria) {
        $stmt = $this->db->prepare("SELECT * FROM `opzioni_prodotto` WHERE IdCategoria = ? AND IdProdotto = ?");
        $stmt->bind_param("ii", $idcategoria, $idprodotto);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getSize($idprodotto, $idcategoria, $colore) {
        $stmt = $this->db->prepare("SELECT * FROM Taglia WHERE IdProdotto = ? AND IdCategoria = ? AND Colore = ?");
        $stmt->bind_param("iis", $idprodotto, $idcategoria, $colore);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>