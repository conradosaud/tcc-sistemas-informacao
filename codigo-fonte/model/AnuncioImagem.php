<?php

include_once("Dao.php");
include_once("../../php/InterfaceCRUD.php");

class AnuncioImagem implements InterfaceCRUD{
    
    /***********************************************************************
     *  Relação com a tabela: AnuncioInfo
    ************************************************************************/
    
    // <editor-fold defaultstate="collapsed" desc="Atributos">

    private $IdEmpresa;
    private $IdImagem;
    private $Nome;
    private $Principal;
    private $Observacao;
    private $Status;
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Construtor">
    
    private $db;
    public function __construct(){
        $db = new Dao();
        $this->db = $db->instance();
    }
    
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="CRUD"> 
    
    public function altera($atual, $novo) {
        
    }

    public function busca($id) {
        try{
            
            $sql = "
                SELECT * FROM AnuncioImagem
                WHERE IdEmpresa = :IdEmpresa
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEmpresa", $id, PDO::PARAM_INT);
            $query->execute();
            
            $anuncioImagem = $this->carregaDados($query);
            
            return $anuncioImagem;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }

    public function buscaTodos() {
        
    }

    public function insere($objeto) {
        try{
            
            $sql = "
                INSERT INTO AnuncioImagem
                (IdEmpresa, Nome, Principal)
                VALUES
                (:IdEmpresa, :Nome, :Principal)
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEmpresa", $objeto->getIdEmpresa(), PDO::PARAM_INT);
            $query->bindValue(":Nome", $objeto->getNome(), PDO::PARAM_STR);
            $query->bindValue(":Principal", $objeto->getPrincipal(), PDO::PARAM_BOOL);
            $query->execute();
            
            return $this->verificaDados($query);
            
            return $anuncioImagem;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }

    public function remove($id) {
        try{
            
            $sql = "
                DELETE FROM AnuncioImagem
                WHERE IdImagem IN (";
            
            for($i = 0; $i < count($id); $i++){
                $sql .= "$id[$i], ";
            }
            
            $sql = substr($sql, 0, strlen($sql)-2);
            $sql .= ");";

            
            $query = $this->db->prepare($sql);
            $query->execute();
            
            if($query->rowCount() >= 1){
                return TRUE;
            }else{
                return FALSE;
            }
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos">
    
    public function tornaPrincipal($IdEmpresa, $IdImagem){
        try{
            
            $pdo = $this->db;
            
            // inicia transacao
            $pdo->beginTransaction();
            
            $sql = "
                UPDATE AnuncioImagem
                SET Principal = 0
                WHERE 
                IdEmpresa = :IdEmpresa
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEmpresa", $IdEmpresa, PDO::PARAM_INT);
            $resultado = $query->execute();

            if(!$resultado){
                $pdo->rollBack();
                return false;
            }
            
            $sql = "
                UPDATE AnuncioImagem
                SET Principal = 1
                WHERE 
                IdEmpresa = :IdEmpresa
                AND
                IdImagem = :IdImagem
                ;";
            
            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEmpresa", $IdEmpresa, PDO::PARAM_INT);
            $query->bindValue(":IdImagem", $IdImagem, PDO::PARAM_INT);
            $resultado = $query->execute();
            
            if($resultado){
                $pdo->commit();
                return true;
            }else{
                $pdo->rollBack();
                return false;
            }
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos Fixos e Estáticos">
    
    private function dataAgora($horas){
        date_default_timezone_set('America/Sao_Paulo');
        $data = "";
        if($horas){
            $data = date("Y-m-d H:i:s");
        }else{
            $data = date("Y-m-d");
        }
        return $data;
    }
    
    private function carregaDados($query){
        
        $anuncioImagens = [];
        
        $dados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($dados as $listado){
            $anuncioImagem = new AnuncioImagem();
            $anuncioImagem->setIdImagem($listado["IdImagem"]);
            $anuncioImagem->setNome($listado["Nome"]);
            $anuncioImagem->setPrincipal($listado["Principal"]);
            $anuncioImagens[] = $anuncioImagem;
        }

        return $anuncioImagens;
    }
    
    public function carregaDadosFetch($dados){
        
        $anuncioImagens = [];
        
        //$dados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($dados as $listado){
            $anuncioImagem = new AnuncioImagem();
            $anuncioImagem->setIdImagem($listado["IdImagem"]);
            $anuncioImagem->setNome($listado["Nome"]);
            $anuncioImagem->setPrincipal($listado["Principal"]);
            $anuncioImagens[] = $anuncioImagem;
        }

        return $anuncioImagens;
    }

    private function verificaDados($query){
        $dados = $query->rowCount();
        if($dados == 1){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Getters e Setters">

    function getIdEmpresa() {
        return $this->IdEmpresa;
    }

    function getIdImagem() {
        return $this->IdImagem;
    }

    function getNome() {
        return $this->Nome;
    }

    function getPrincipal() {
        return $this->Principal;
    }

    function getObservacao() {
        return $this->Observacao;
    }

    function getStatus() {
        return $this->Status;
    }

    function setIdEmpresa($IdEmpresa) {
        $this->IdEmpresa = $IdEmpresa;
    }

    function setIdImagem($IdImagem) {
        $this->IdImagem = $IdImagem;
    }

    function setNome($Nome) {
        $this->Nome = $Nome;
    }

    function setPrincipal($Principal) {
        $this->Principal = $Principal;
    }

    function setObservacao($Observacao) {
        $this->Observacao = $Observacao;
    }

    function setStatus($Status) {
        $this->Status = $Status;
    }
    
    // </editor-fold>

}
