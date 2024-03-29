<?php
class DatabaseHelper{
    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }

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
    public function getName($email) {
        $stmt = $this->db->prepare("SELECT Nome FROM utente WHERE Email = ?");
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
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
    public function getFirstOption($idProdotto, $idcategoria) {
        $stmt = $this->db->prepare("SELECT Colore FROM opzioni_prodotto WHERE IdProdotto = ? AND IdCategoria = ? LIMIT 1");
        $stmt->bind_param("ii", $idProdotto, $idcategoria);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getCarrello($utente) {
        $stmt = $this->db->prepare("SELECT * FROM dettaglio_ordine dp,prodotto p,immagine_opzione i WHERE dp.NomeUtente = ? AND dp.IdProdotto = p.IdProdotto AND dp.IdCategoria = p.IdCategoria AND i.IdProdotto=dp.IdProdotto AND i.IdCategoria=dp.IdCategoria AND i.Colore = dp.Colore GROUP BY IdDettaglioOrdine");
        $stmt->bind_param("s", $utente);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function placeOrder($idCategoria,$idProduttore,$idProdotto,$idDettaglioOrdine,$quantita,$colore,$taglia,$nomeUtente,$idOrdine){
        $stmt = $this->db->prepare("INSERT INTO dettaglio_ordine
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiiisssi",$idCategoria,$idProduttore,$idProdotto,$idDettaglioOrdine,$quantita,$colore,$taglia,$nomeUtente,$idOrdine);
        return $stmt->execute();
    }
    public function setOrder($nome,$idOrdine){
        $stmt = $this->db->prepare("INSERT INTO ordine
        VALUES (?,?,NULL,NULL,0,'in corso')");
        $stmt->bind_param("si",$nome,$idOrdine);
        return $stmt->execute();
    }
    public function getOrder($nome){
        $stmt = $this->db->prepare("SELECT * FROM ordine WHERE NomeUtente = ? AND Stato <> 'elaborazione' AND Stato <> 'consegnato' ");
        $stmt->bind_param("s",$nome);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getOrders($nome){
        $stmt = $this->db->prepare("SELECT * FROM ordine WHERE NomeUtente = ? AND Stato='elaborazione'");
        $stmt->bind_param("s",$nome);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getImage($idProdotto, $idCategoria, $colore){
        $stmt = $this->db->prepare("SELECT URL FROM immagine_opzione WHERE IdCategoria = ? AND IdProdotto = ? AND Colore = ? LIMIT 1");
        $stmt->bind_param("iis", $idCategoria,$idProdotto,$colore);
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
    public function getSizeFromOrders() {
        $stmt = $this->db->prepare("SELECT t.Quantita FROM Taglia t, dettaglio_ordine do WHERE t.IdProdotto = do.IdProdotto AND t.IdCategoria = do.IdCategoria AND t.Colore = do.Colore AND t.Nome_taglia = do.Taglia");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getImages($idprodotto, $idcategoria, $colore) {
        $stmt = $this->db->prepare("SELECT URL FROM immagine_opzione WHERE IdProdotto = ? AND IdCategoria = ? AND Colore = ?");
        $stmt->bind_param("iis", $idprodotto, $idcategoria, $colore);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function clearCart(){
        $stmt = $this->db->prepare("DELETE FROM dettaglio_ordine");
        $stmt->execute();
    }
    public function updateOrder($nome,$totale,$token){
        $stmt = $this->db->prepare("UPDATE ordine SET Stato = 'elaborazione', CostoTotale = ? WHERE NomeUtente = ? AND IdOrdine = ?");
        $stmt->bind_param("dsi", $totale, $nome, $token);
        $stmt->execute();
    }
    public function updateQuantity($idprodotto, $idcategoria,$idDO){
        $stmt = $this->db->prepare("UPDATE dettaglio_ordine SET Quantita = Quantita + 1 WHERE IdProdotto = ? AND IdCategoria = ? AND IdDettaglioOrdine = ?");
        $stmt->bind_param("iii", $idprodotto, $idcategoria, $idDO);
        $stmt->execute();
    }
    public function removeFromCart($idDO){
        $stmt = $this->db->prepare("DELETE FROM dettaglio_ordine WHERE IdDettaglioOrdine = ?");
        $stmt->bind_param("i", $idDO);
        $stmt->execute();
    }
    public function getNumber($token) {
        $stmt = $this->db->prepare("SELECT COUNT('*') FROM dettaglio_ordine WHERE IdOrdine = ?");
        $stmt->bind_param("i", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getProducers(){
        $stmt = $this->db->prepare("SELECT * FROM produttore");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function updateProductQuantity($idDO){
        $stmt = $this->db->prepare("UPDATE taglia
        INNER JOIN dettaglio_ordine ON taglia.IdProdotto = dettaglio_ordine.IdProdotto AND taglia.IdCategoria = dettaglio_ordine.IdCategoria AND taglia.Nome_taglia = dettaglio_ordine.Taglia
        SET taglia.Quantita =taglia.Quantita -  dettaglio_ordine.Quantita
        WHERE dettaglio_ordine.IdDettaglioOrdine = ?");
        $stmt->bind_param("i",$idDO);
        $stmt->execute();
    }
    public function getOrderDetails($utente) {
        $stmt = $this->db->prepare("SELECT * FROM dettaglio_ordine WHERE NomeUtente = ?");
        $stmt->bind_param("s", $utente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function changeOrderStatus($idO,$nome){
        $stmt = $this->db->prepare("UPDATE ordine SET Stato = 'consegnato' WHERE NomeUtente = ? AND IdOrdine = ?");
        $stmt->bind_param("si", $nome, $idO);
        $stmt->execute();
    }
    public function setOrderNotification($idO,$nome){
        $stmt = $this->db->prepare("INSERT INTO notifica VALUES(CONCAT('Ordine consegnato: ',?),DEFAULT,'no',?)");
        $stmt->bind_param("is",$idO,$nome);
        $stmt->execute();
    }
    public function setNotifica($text, $utente) {
        $stmt = $this->db->prepare("INSERT INTO notifica 
        VALUES (?, DEFAULT, 'no', ?)");
        $stmt->bind_param("ss", $text, $utente);
        $stmt->execute();
    }
    public function getNotifiche($utente) {
        $stmt = $this->db->prepare("SELECT * FROM `notifica` WHERE NomeUtente = ?  ORDER BY Letta = 'no' DESC");
        $stmt->bind_param("s", $utente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function setLette($utente) {
        $stmt = $this->db->prepare("UPDATE notifica
        SET Letta = 'si'
        WHERE NomeUtente = ?");
        $stmt->bind_param("s", $utente);
        $stmt->execute();
    }
    public function isAdmin($email) {
        $stmt = $this->db->prepare("SELECT Admin FROM `utente` WHERE NomeUtente = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getQuantity($idProdotto,$idCategoria,$taglia,$colore){
        $stmt = $this->db->prepare("SELECT * FROM taglia WHERE IdProdotto = ? and IdCategoria=? and Nome_taglia=? and Colore=?");
        $stmt->bind_param("iiss", $idProdotto,$idCategoria,$taglia,$colore);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    function newProduct($idprodotto, $idcategoria, $idproduttore, $nome, $prezzo, $descrizione, $descrizioneBreve, $sconto) {
        $stmt = $this->db->prepare("INSERT INTO prodotto
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiisissi",$idcategoria, $idproduttore, $idprodotto, $nome, $prezzo, $descrizione, $descrizioneBreve, $sconto);
        return $stmt->execute();

    }
    function newColor($idcategoria, $idproduttore, $idprodotto, $colore) {
        $stmt = $this->db->prepare("INSERT INTO opzioni_prodotto
        VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $idcategoria, $idproduttore, $idprodotto, $colore);
        $stmt->execute();
    }
    function newTaglia($nomeTaglia, $quantita, $idcategoria, $idproduttore, $idprodotto, $colore) {
        $stmt = $this->db->prepare("INSERT INTO taglia
        VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("siiiis", $nomeTaglia, $quantita, $idcategoria, $idproduttore, $idprodotto, $colore);
        $stmt->execute();
    }
    function newImgOpzione($URL, $idcategoria, $idproduttore, $idprodotto, $colore) {
        $stmt = $this->db->prepare("INSERT INTO immagine_opzione
        VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("siiis", $URL, $idcategoria, $idproduttore, $idprodotto, $colore);
        $stmt->execute();
    }
    function getLastId($idcategoria) {
        $stmt = $this->db->prepare("SELECT IdProdotto FROM prodotto WHERE IdCategoria = ? ORDER BY IdProdotto DESC LIMIT 1");
        $stmt->bind_param("i", $idcategoria);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function updateODQty($sign,$utente,$idDO){
        $stmt = $this->db->prepare("UPDATE dettaglio_ordine SET Quantita = Quantita + ? WHERE NomeUtente = ? AND IdDettaglioOrdine = ?");
        $stmt->bind_param("isi", $sign,$utente,$idDO);
        $stmt->execute();
    }
    public function getUtente($utente){
        $stmt = $this->db->prepare("SELECT NomeUtente,Indirizzo,DataNascita FROM utente WHERE NomeUtente=?");
        $stmt->bind_param("s", $utente);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    function deleteProduct($idprodotto, $idcategoria) {
        $stmt = $this->db->prepare("DELETE FROM `prodotto` WHERE `IdCategoria` = ? AND `IdProdotto` = ?");
        $stmt->bind_param("ii", $idcategoria, $idprodotto);
        return $stmt->execute();
    }
    function deleteImg($idprodotto, $idcategoria) {
        $stmt = $this->db->prepare("DELETE FROM `immagine_opzione` WHERE `IdCategoria` = ? AND `IdProdotto` = ?");
        $stmt->bind_param("ii", $idcategoria, $idprodotto);
        return $stmt->execute();
    }
    function deletetaglia($idprodotto, $idcategoria) {
        $stmt = $this->db->prepare("DELETE FROM `taglia` WHERE `IdCategoria` = ? AND `IdProdotto` = ?");
        $stmt->bind_param("ii", $idcategoria, $idprodotto);
        return $stmt->execute();
    }
    function deleteOpzione($idprodotto, $idcategoria) {
        $stmt = $this->db->prepare("DELETE FROM `opzioni_prodotto` WHERE `IdCategoria` = ? AND `IdProdotto` = ?");
        $stmt->bind_param("ii", $idcategoria, $idprodotto);
        return $stmt->execute();
    }
    public function getQtyZero(){
        $stmt = $this->db->prepare("SELECT * FROM prodotto p,taglia t WHERE t.Quantita=0 and p.IdProdotto=t.IdProdotto and p.IdCategoria=t.IdCategoria");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getAllProd(){
        $stmt = $this->db->prepare("SELECT * FROM prodotto p,taglia t,immagine_opzione i WHERE p.IdProdotto=t.IdProdotto and p.IdCategoria=t.IdCategoria and i.IdProdotto=p.IdProdotto and i.IdCategoria=p.IdCategoria and i.Colore=t.Colore group by t.Colore,t.Nome_Taglia,t.IdProdotto,t.IdCategoria");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function updateSizeQty($idP,$idC,$color,$size){
        $stmt = $this->db->prepare("UPDATE taglia SET Quantita = Quantita + 1 WHERE Nome_taglia=? AND IdProdotto=? AND IdCategoria=? AND Colore=?");
        $stmt->bind_param("siis",$size, $idP,$idC,$color);
        $stmt->execute();
    }
}
?>