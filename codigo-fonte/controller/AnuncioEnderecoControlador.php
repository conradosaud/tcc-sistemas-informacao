<?php

include_once("../../model/AnuncioEndereco.php");
include_once("../../php/InterfaceREST.php");

class AnuncioEnderecoControlador implements InterfaceREST{
    
    // <editor-fold defaultstate="collapsed" desc="REST">
    
    public function delete($action, $obj) {
        $objAnuncio = new AnuncioEndereco();
        $objAnuncio = $objAnuncio->remove($obj);
        return $objAnuncio;
    }

    public function get($action, $obj) {
        switch($action){
            case "busca":
                $objAnuncio = new AnuncioEndereco();
                $objAnuncio = $objAnuncio->busca($obj);
                return $objAnuncio;
            case "buscaTodosPorIdEmpresa":
                $objAnuncio = new AnuncioEndereco();
                $objAnuncio = $objAnuncio->buscaTodosPorIdEmpresa($obj);
                return $objAnuncio;
            default:
                return false;
        }
        
    }

    public function post($action, $obj) {
        switch($action){
            case "insere":
                $objAnuncioEndereco = new AnuncioEndereco();
                $objAnuncioEndereco = $objAnuncioEndereco->insere($obj);
                return $objAnuncioEndereco;
            default:
                return false;
        }
    }

    public function put($action, $objAtual, $objNovo) {
        switch($action){
            case "altera":
                $objAnuncioEndereco = new AnuncioEndereco();
                $objAnuncioEndereco = $objAnuncioEndereco->altera(null, $objNovo);
                return $objAnuncioEndereco;
            default:
                return false;
        }
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos">
    
    private function buscaFiltroSimples($obj){
        $aux = "";
        
        $obj = strtolower($obj);
        switch($obj){
            case "todos":
                break;
            case "pizzarias":
                $aux = " AND e.TipoNegocio = 'Pizzaria' ";
                break;
            case "lanchonetes":
                $aux = " AND e.TipoNegocio = 'Lanchonete' ";
                break;
            case "salgadarias":
                $aux = " AND e.TipoNegocio = 'Salgadaria' ";
                break;
            case "frios":
                $aux = " AND e.TipoNegocio = 'Frios' ";
                break;
            case "drinks":
                $aux = " AND e.TipoNegocio = 'Drinks' ";
                break;
            case "festas":
                $aux = " AND e.TipoNegocio = 'Festa' ";
                break;
            case "recomendados":
                $aux = " AND e.IdPlano > 0 ";
                break;
            case "maisavaliados":
                break;
            case "maiscomentados":
                break;
            default:
                return;
        }
        
        $sql = " 
        
            SELECT *
            FROM Anuncio a
            INNER JOIN AnuncioApresentacao ap
            INNER JOIN AnuncioContato ac
            INNER JOIN AnuncioEndereco ae
            INNER JOIN AnuncioInfo ai
            INNER JOIN AnuncioIntegracao ain
            INNER JOIN Empresa e
            ON a.IdAnuncio = ap.IdAnuncio
            AND a.IdAnuncio = ac.IdAnuncio
            AND a.IdAnuncio = ae.IdAnuncio
            AND a.IdAnuncio = ai.IdAnuncio
            AND a.IdAnuncio = ain.IdAnuncio
            AND a.IdAnuncio = e.IdAnuncio

        ";
        
        $sql.= $aux;
        $sql.= ";";
        
        $objAnuncio = new Anuncio();
        $objAnuncio = $objAnuncio->buscaFiltro($sql);  
        
        return $objAnuncio;
    }
    
    private function buscaFiltro($obj){

        $obj = explode(",", $obj);
        
        $categoria = array();
        $avalicaoes = array();
        $info = array();
        $horarios = array();
        
        foreach($obj as $item){
            if(strpos($item, "categoria") !== false){
                $aux = $item;
                $aux = str_replace("categoria=", "", $aux);
                $categoria[] = $aux;
            }
            if(strpos($item, "avaliacoes") !== false){
                $aux = $item;
                $aux = str_replace("avaliacoes=", "", $aux);
                $avaliacoes[] = $aux;
            }
            if(strpos($item, "info") !== false){
                $aux = $item;
                $aux = str_replace("info=", "", $aux);
                $info[] = $aux;
            }
            if(strpos($item, "horarios") !== false){
                $aux = $item;
                $aux = str_replace("horarios=", "", $aux);
                $horarios[] = $aux;
            }
        }
        
        $sql = " 
        
            SELECT *
            FROM Anuncio a
            INNER JOIN AnuncioApresentacao ap
            INNER JOIN AnuncioContato ac
            INNER JOIN AnuncioEndereco ae
            INNER JOIN AnuncioInfo ai
            INNER JOIN AnuncioIntegracao ain
            INNER JOIN Empresa e
            ON a.IdAnuncio = ap.IdAnuncio
            AND a.IdAnuncio = ac.IdAnuncio
            AND a.IdAnuncio = ae.IdAnuncio
            AND a.IdAnuncio = ai.IdAnuncio
            AND a.IdAnuncio = ain.IdAnuncio
            AND a.IdAnuncio = e.IdAnuncio

        ";
        
        // filtro de categorias
        if(count($categoria) == 1){
            $sql .= "AND e.TipoNegocio = '$categoria[0]'";
        }
        if(count($categoria) > 1){
            $sql .= " AND (";
            foreach($categoria as $item){
                $sql .= "e.TipoNegocio = '$item'";
                if(next($categoria)){
                    $sql.= " OR ";
                }
            }
            $sql .= ") ";
        }
        
        // filtro de avaliações
        
        // filtro de info
        if(count($info) >= 1){
            $sql .= " AND ";
            if(count($info) > 1){
                $sql.=" (";
            }
            foreach($info as $item){
                switch ($item){
                    case "entregas":
                        $sql .= "ai.EntregaDomicilio = 1";
                        break;
                    case "atende":
                        $sql .= "ai.AtendeLocal = 1";
                        break;
                    case "endereco":
                        $sql .= "e.Rua IS NOT NULL";
                        break;
                    case "telefone":
                        $sql .= "(ac.Telefone1 IS NOT NULL OR ac.Celular1 IS NOT NULL)";
                        break;
                    case "email":
                        $sql .= "ac.Email1 IS NOT NULL";
                        break;
                    case "mapa":
                        $sql .= "ain.GoogleMaps IS NOT NULL";
                        break;
                    case "facebook":
                        $sql .= "ain.FacebookPagina IS NOT NULL";
                        break;
                }
                
                if(next($info)){
                    $sql.= " AND ";
                }
            }
            if(count($info) > 1){
                $sql.=") ";
            }
        }
        
        // filtro de horarios
        
        // filtro outros
        /*
        switch($outros){
            case "recentes":
                $sql .= "ORDER BY e.DataCadastro DESC";
                break;
            case "antigos":
                $sql .= "ORDER BY e.DataCadastro ASC";
                break;
        }
        */
        
        
        $sql .= ";";

        $objAnuncio = new Anuncio();
        $objAnuncio = $objAnuncio->buscaFiltro($sql);    
        return $objAnuncio;
    }
    
    private function montaListaAlbum($obj){
        $img = explode("-", $obj);
        array_pop($img);
        return $img;
    }
    
    private function buscaHome($obj){
        
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos Estáticos">
    
    public static function criaObj($IdEmpresa, $IdEndereco, $Email, $Cep, $Rua, $Numero, $Bairro, $Complemento, $Telefone1, $Telefone2, $Celular1, $Celular2, $cboxCelular1, $cboxCelular2){
        $obj = new AnuncioEndereco();
        $obj->setIdEmpresa($IdEmpresa);
        $obj->setIdEndereco($IdEndereco);
        $obj->setEmail($Email);
        $obj->setCep($Cep);
        $obj->setRua($Rua);
        $obj->setNumero($Numero);
        $obj->setBairro($Bairro);
        $obj->setComplemento($Complemento);
        $obj->setTelefone1($Telefone1);
        $obj->setTelefone2($Telefone2);
        $obj->setCelular1($Celular1);
        $obj->setCelular2($Celular2);
        $obj->setCboxCelular1($cboxCelular1);
        $obj->setCboxCelular2($cboxCelular2);
        
        return $obj;
    }
    
    // </editor-fold>

}
