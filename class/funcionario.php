<?php
    class Funcionario{

        private $conexao;

        private $db_table = "Funcionario";

        public $id;
        public $nome;
        public $email;
        public $idade;
        public $funcao;
        public $criado;

        public function __construct($db){
            $this->conexao = $db;
        }

        public function getFuncionarios(){
            $sql = "SELECT id, nome, email, idade, funcao, criado FROM " . $this->db_table . "";
            $stmt = $this->conexao->prepare($sql);
            $stmt->execute();
            return $stmt;
        }
        public function criarFuncionario(){
            $sql = "INSERT INTO
                   ". $this->db_table ."
                SET 
                    nome = :nome,
                    email = :email,
                    idade = :idade,
                    funcao = :funcao,
                    criado = :criado";

            $stmt = $this->conexao->prepare($sql);

            $this->nome=htmlspecialchars(strip_tags($this->nome));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->idade=htmlspecialchars(strip_tags($this->idade));
            $this->funcao=htmlspecialchars(strip_tags($this->funcao));
            $this->criado=htmlspecialchars(strip_tags($this->criado));

            //ligar dados

            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":idade", $this->idade);
            $stmt->bindParam(":funcao", $this->funcao);
            $stmt->bindParam(":criado", $this->criado);

            if ($stmt->execute()) {
                # code...
                return true;
            }
            return false;
        }
        //Leitura Única
        public function getUnicoFuncionario(){
            $sql = "SELECT
                    id,
                    nome,
                    email,
                    idade,
                    funcao,
                    criado
                  FROM
                   ". $this->db_table ."
                WHERE 
                    id = ?
                LIMIT 0,1";
            $stmt = $this->conexao->prepare($sql);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->nome = $dataRow['nome'];
            $this->email = $dataRow['email'];
            $this->idade = $dataRow['idade'];
            $this->funcao = $dataRow['funcao'];
            $this->criado = $dataRow['criado'];
        }
        // função atualizar funcionário
        public function atualizarFuncionario(){
            $sql = "UPDATE 
                   ". $this->db_table ."
                SET
                    nome = :nome,
                    email = :email,
                    idade = :idade,
                    funcao = :funcao,
                    criado = :criado
                WHERE
                    id = :id";
            $stmt = $this->conexao->prepare($sql);

            $this->nome=htmlspecialchars(strip_tags($this->nome));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->idade=htmlspecialchars(strip_tags($this->idade));
            $this->funcao=htmlspecialchars(strip_tags($this->funcao));
            $this->criado=htmlspecialchars(strip_tags($this->criado));
            $this->id=htmlspecialchars(strip_tags($this->id));

            //ligando dados
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":idade", $this->idade);
            $stmt->bindParam(":funcao", $this->funcao);
            $stmt->bindParam(":criado", $this->criado);
            $stmt->bindParam(":id", $this->id);

            if ($stmt->execute()) {
                # code...
                return true;
            }
            return false;
        }
        //função deletar funcionário
        function deletarFuncionario(){
            $sql = "DELETE FROM " . $this->db_table . " WHERE id = ?";

            $stmt = $this->conexao->prepare($sql);

            $this->id=htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(1, $this->id);

            if ($stmt->execute()) {
                # code...
                return true;
            }
            return false;
        }
    }
?>