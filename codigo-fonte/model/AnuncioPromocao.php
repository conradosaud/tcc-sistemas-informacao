<?php

include_once("../../php/InterfaceCRUD.php");

class AnuncioIntegracao extends Anuncio implements InterfaceCRUD{
    
    /***********************************************************************
     *  Relação com a tabela: AnuncioIntegracao
    ************************************************************************/
    
    // <editor-fold defaultstate="collapsed" desc="Atributos">

    private $IdPromocao;
    private $ImgPromocao;
    private $Titulo;
    private $Descricao;
    private $DataInicio;
    private $DataFim;
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Construtor"> 
    
    public function __construct() {
        parent::__construct();
    }
    
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="CRUD"> 
    
    public function altera($atual, $novo) {
        try{
            
            $sql = "
                UPDATE AnuncioIntegracao
                SET
                FacebookPagina = :FacebookPagina,
                FacebookCurtidas = :FacebookCurtidas,
                FacebookComentarios = :FacebookComentarios,
                GoogleMaps = :GoogleMaps,
                Observacao = :Observacao
                WHERE
                IdAnuncio = :IdAnuncio
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":FacebookPagina", $novo->getFacebookPagina(), PDO::PARAM_STR);
            $query->bindValue(":FacebookCurtidas", $novo->getFacebookCurtidas(), PDO::PARAM_STR);
            $query->bindValue(":FacebookComentarios", $novo->getFacebookComentarios(), PDO::PARAM_STR);
            $query->bindValue(":GoogleMaps", $novo->getGoogleMaps(), PDO::PARAM_STR);
            $query->bindValue(":Observacao", $novo->getObservacao(), PDO::PARAM_STR);
            $query->bindValue(":IdAnuncio", $atual->getIdAnuncio(), PDO::PARAM_INT);
            $query->execute();
            $dados = $query->rowCount();
            if($dados == 1){
                return TRUE;
            }else{
                Mensagem::msgOperacaoErro();
                return FALSE;
            }
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }

    public function busca($id) {
        
    }

    public function buscaTodos() {
        
    }

    public function insere($objeto) {
        
    }

    public function remove($id) {
        
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos">
    
    
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Getters e Setters">

    function getIdPromocao() {
        return $this->IdPromocao;
    }

    function getImgPromocao() {
        return $this->ImgPromocao;
    }

    function getTitulo() {
        return $this->Titulo;
    }

    function getDescricao() {
        return $this->Descricao;
    }

    function getDataInicio() {
        return $this->DataInicio;
    }

    function getDataFim() {
        return $this->DataFim;
    }

    function setIdPromocao($IdPromocao) {
        $this->IdPromocao = $IdPromocao;
    }

    function setImgPromocao($ImgPromocao) {
        $this->ImgPromocao = $ImgPromocao;
    }

    function setTitulo($Titulo) {
        $this->Titulo = $Titulo;
    }

    function setDescricao($Descricao) {
        $this->Descricao = $Descricao;
    }

    function setDataInicio($DataInicio) {
        $this->DataInicio = $DataInicio;
    }

    function setDataFim($DataFim) {
        $this->DataFim = $DataFim;
    }
    
    // </editor-fold>

}
