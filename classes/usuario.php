<?php 
class Usuario{
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;


    public function __construct($login = "", $password = "")
    {
        $this->setDeslogin($login);
        $this->setDessenha($password);
    }
    public function getIdusuario(){
       return $this->idusuario;
    }
    public function setIdusuario($value){
        $this->idusuario = $value;
    }
    public function getDeslogin(){
        return $this->deslogin;
     }
     public function setDeslogin($value){
        $this->deslogin = $value;
    }
     public function getDessenha(){
        return $this->dessenha;
     }
     public function setDessenha($value){
        $this->dessenha = $value;
    }
     public function getDtcadastro(){
        return $this->dtcadastro;
     }
     public function setDtcadastro($value){
        $this->dtcadastro = $value;
    }
    public function loadByid($id){
        $sql = new sql();

        $results = $sql->execSelect("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$id));
        if(count($results) > 0){
            $this->setData($results[0]);
        }
    }
        public static function getList(){
            $sql = new sql();
            return $sql->execSelect("SELECT * FROM tb_usuarios ORDER BY deslogin");


        }
        public function setData($data){
            if(count($data) > 0){
            $this->setIdusuario($data['idusuario']);
            $this->setDeslogin($data['deslogin']);
            $this->setDessenha($data['dessenha']);
            $this->setDtcadastro(new DateTime($data['dtcadastro']));
        }
        }
        public static function search($login){
            $sql = new sql();
            return $sql->execSelect("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(":SEARCH=>"=>"%".$login."%"));
        }

        public function insert(){
            $sql = new sql();
            $results = $sql->execSelect("CALL sp_usuarios_insert(:LOGIN,:PASSWORD)", array(':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha()));
            if(count($results) > 0){
                $this->setData($results[0]);
            }
            
        }

        public function login($login, $password){

            $sql = new sql();

            $results = $sql->execSelect("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(":LOGIN"=>$login, ":PASSWORD"=>$password));

            if(count($results) > 0){

                $this->setData($results[0]);

        } else {

            throw new Exception("Login e/ou senha inválidos.");

        }
        
    }
    public function delete(){
        $sql = new sql();
        $sql->execQuery("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$this->getIdusuario()));
        $this->setIdusuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
        $this->setDtcadastro(new DateTime());

    }
    public function update($login, $password){
        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new sql();
        $sql->execQuery("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
            ":LOGIN"=>$this->getDeslogin(),
            ":PASSWORD"=>$this->getDessenha(),
            ":ID"=>$this->getIdusuario()
        ));


    }    
    public function __toString()
    {
        return json_encode(array(
            "idusuario"=> $this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }
}




?>