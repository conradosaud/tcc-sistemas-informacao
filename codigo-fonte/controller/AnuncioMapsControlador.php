<?php

include_once("../../model/AnuncioMaps.php");
include_once("../../php/InterfaceREST.php");

class AnuncioMapsControlador implements InterfaceREST{
    
    // <editor-fold defaultstate="collapsed" desc="REST">
    
    public function delete($action, $obj) {
        $objFacebook = new AnuncioFacebook();
        $objFacebook = $objFacebook->remove($obj);
        return $objFacebook;
    }

    public function get($action, $obj) {
        switch($action){
            case "buscaPorIdEmpresa":
                $objMaps = new AnuncioMaps();
                $objMaps = $objMaps->buscaPorIdEmpresa($obj);
                return $objMaps;
            case "busca":
                $objMaps = new AnuncioMaps();
                $objMaps = $objMaps->busca($obj);
                return $objMaps;
            default:
                return false;
        }
        
    }

    public function post($action, $obj) {
        $objMaps = new AnuncioMaps();
        $objMaps = $objMaps->insere($obj);
        return $objMaps;
    }

    public function put($action, $objAtual, $objNovo) {
        $obj = new AnuncioMaps();
        $obj = $obj->altera(null, $objNovo);
        return $obj;
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
    
    public static function criaObj($IdMaps, $IdEmpresa, $IdEndereco, $Latitude, $Longitude, $Status){
        $obj = new AnuncioMaps();
        $obj->setIdMaps($IdMaps);
        $obj->setIdEmpresa($IdEmpresa);
        $obj->setIdEndereco($IdEndereco);
        $obj->setLatitude($Latitude);
        $obj->setLongitude($Longitude);
        $obj->setStatus($Status);
        
        return $obj;
    }
    
    public static function verificaExistente($IdEndereco){
        $obj = new AnuncioMaps();
        $obj = $obj->verificaExistente($IdEndereco);
        
        return $obj;
    }
    
    public static function criaObjJs($obj){
        $var = "";

        $var .= "[].p ";
        
            for($i = 0; $i < count($obj); $i++){
                $var .= '"{"';
                $var .= '"latitude":'; $var .= '"'.$obj[$i]->getLatitude().'",';
                $var .= '"longitude":'; $var .= '"'.$obj[$i]->getLongitude().'"';
                if($i == count($obj)-1){
                    $var .= "}";
                }else{
                    $var .= "},";
                }
                
            }
        
        $var .= "";
         
        return $var;
    }

    // </editor-fold>

}
