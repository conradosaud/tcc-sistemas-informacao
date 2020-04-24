<?php

include_once("Dao.php");
include_once("../../php/InterfaceCRUD.php");

class AnuncioGeral{
    
    /***********************************************************************
     *  Relação com a tabela: AnuncioApresentacao
    ************************************************************************/
    
    // <editor-fold defaultstate="collapsed" desc="Atributos">
    
    private $IdEmpresa;
    
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Construtor">
    
    private $db;
    public function __construct(){
        $db = new Dao();
        $this->db = $db->instance();
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos">
    
    public function buscaAnuncio($IdEmpresa){
        try{
            
            $sql = "
                SELECT * FROM AnuncioApresentacao
                WHERE IdAnuncio = :IdAnuncio
                ;";

            $imagens = "";
            
            $query = $this->db->prepare($sql);
            $query->bindValue(":IdAnuncio", $obj->getIdAnuncio(), PDO::PARAM_INT);
            $query->execute();
            $dados = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($dados as $listado){
                $imagens = $listado["ImgAlbum"];
            }
            
            return $imagens;
            
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
        
        $anuncioApresentacoes = [];
        
        $dados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($dados as $listado){
            $anuncioApresentacao = new AnuncioApresentacao();
            $anuncioApresentacao->setNomeExibicao($listado["NomeExibicao"]);
            $anuncioApresentacao->setDescricaoCurta($listado["DescricaoCurta"]);
            $anuncioApresentacao->setDescricaoLonga($listado["DescricaoLonga"]);
            $anuncioApresentacao->setStatus($listado["Status"]);
            $anuncioApresentacoes[] = $anuncioApresentacao;
        }

        switch(count($anuncioApresentacoes)){
            case 0:
                return NULL;
            case 1:
                return $anuncioApresentacoes[0];
            default:
                return $anuncioApresentacoes;
        }
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

    function setIdEmpresa($IdEmpresa) {
        $this->IdEmpresa = $IdEmpresa;
    }
    
    // </editor-fold>

}
