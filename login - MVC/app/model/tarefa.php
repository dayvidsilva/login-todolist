<?php 

require_once __DIR__ . '/../config/database.php';

class Tarefa{
    private $conn; 

    public function __construct(){
        $db = new Database();
        $this->conn = $db->conectar();
    }

    # Listar

    public function listar(int $usuario_id){
        $sql = "SELECT * FROM tarefas WHERE usuario_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt ->bind_param("i",$usuario_id);
        $stmt ->execute();
        $resposta = $stmt->get_result();
        $tarefas = $resposta ->fetch_all(MYSQLI_ASSOC);
        $stmt -> close();

        return $tarefas;
  
    }

    # Criar

    public function criar(string $descricao, int $usuario_id){
     $sql = "INSERT INTO tarefas (descricao, usuario_id) VALUES(?,?)";
     $stmt = $this->conn->prepare($sql);
     $stmt->bind_param('si',$descricao, $usuario_id);
     $resposta = $stmt ->execute();
     $stmt->close();

     return $resposta;

    }

    #Excluir 

    public function excluir(int $tarefas_id, int $usuario_id){
        $sql =" DELETE FROM tarefas WHERE id = ? AND usuario_id = ?";
        $stmt =$this->conn->prepare($sql);
        $stmt->bind_param('ii', $tarefas_id,$usuario_id);
        $resposta = $stmt->execute();
        $stmt->close();

        return $resposta;
      
    }

    # Editar

    public function editar(string $descricao,int $id_tarefa, int $usuario_id){
      $sql= "UPDATE tarefas SET descricao =? WHERE id=? AND usuario_id=?";
      $stmt =$this->conn->prepare($sql);
      $stmt->bind_param('sii', $descricao,$id_tarefa,$usuario_id);
      $resposta = $stmt->execute();
      $stmt->close();

      return $resposta;
    }
}

?>