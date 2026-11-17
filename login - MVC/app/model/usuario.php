<?php 

require_once __DIR__ . '/../config/database.php'; 

Class Usuario{
    private $conn; 

    public function __construct(){
        $db = new Database(); 
        $this->conn = $db->conectar(); 
    }

//funcao email
public function buscarPorEmail(string $email){
       $sql = "SELECT * FROM usuarios WHERE email = ? ";
       
       $stmt = $this->conn->prepare($sql);
       $stmt->bind_param('s',$email);
       $resposta = $stmt->execute();
       $resposta = $stmt->get_result();
       $stmt->close();
       return $resposta->fetch_assoc(); 
   }

}



?>