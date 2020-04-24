<?php

include_once("../../model/AnuncioPromocao.php");
include_once("../../php/InterfaceREST.php");

class AnuncioPromocaoControlador implements InterfaceREST{
    
    // <editor-fold defaultstate="collapsed" desc="REST">
    
    public function delete($action, $obj) {
        // METODO NAO UTILIZADO NESTA CLASSE
        return false;
    }

    public function get($action, $obj) {
        switch($action){
            case "montaAnuncioCompleto":
                $objAnuncio = new Anuncio();
                $objAnuncio = $objAnuncio->buscaAnuncioCompletoPorEmpresa($obj);
                return $objAnuncio;
            case "buscaAnuncioPorEmpresa":
                $objAnuncio = new Anuncio();
                $objAnuncio = $objAnuncio->buscaAnuncioPorEmpresa($obj);
                return $objAnuncio;
            case "verificaAnuncioEmpresa":
                $objAnuncio = new Anuncio();
                $objAnuncio = $objAnuncio->verificaAnuncioEmpresa($obj["IdEmpresa"], $obj["IdAnuncio"]);
                return $objAnuncio;
            case "buscaTodosAnunciando":
                $objAnuncios = new Anuncio();
                $objAnuncios = $objAnuncios->buscaTodosAnunciando($obj);
                return $objAnuncios;
            case "buscaTodosPorIdAnuncio":
                $objAnuncio = new Anuncio();
                $objAnuncio = $objAnuncio->buscaTodosPorIdAnuncio($obj);
                return $objAnuncio;
            case "montaListaAlbum":
                return $this->montaListaAlbum($obj);
            case "buscaNav":
                return $this->buscaFiltroSimples($obj);
            case "buscaHome":
                return $this->buscaFiltroSimples($obj);
            case "buscaFiltro":
                return $this->buscaFiltro($obj);
            default:
                return false;
        }
        
    }

    public function post($action, $obj) {
        // CASE NAO APLICADO NA CLASSE
    }

    public function put($action, $objAtual, $objNovo) {
        switch($action){
            case "anuncioApresentacao":
                $objAnuncioApresentacao = new AnuncioApresentacao();
                $objAnuncioApresentacao = $objAnuncioApresentacao->altera($objAtual, $objNovo);
                return $objAnuncioApresentacao;
            case "anuncioContato":
                $objAnuncioContato = new AnuncioContato();
                $objAnuncioContato = $objAnuncioContato->altera($objAtual, $objNovo);
                return $objAnuncioContato;
            case "anuncioContatoTelefone":
                $objAnuncioContato = new AnuncioContato();
                $objAnuncioContato = $objAnuncioContato->alteraTelefone($objAtual, $objNovo);
                return $objAnuncioContato;
            case "anuncioContatoEmail":
                $objAnuncioContato = new AnuncioContato();
                $objAnuncioContato = $objAnuncioContato->alteraEmail($objAtual, $objNovo);
                return $objAnuncioContato;
            case "anuncioEndereco":
                $objAnuncioEndereco = new AnuncioEndereco();
                $objAnuncioEndereco = $objAnuncioEndereco->altera($objAtual, $objNovo);
                return $objAnuncioEndereco;
            case "anuncioInfo":
                $objAnuncioInfo = new AnuncioInfo();
                $objAnuncioInfo = $objAnuncioInfo->altera($objAtual, $objNovo);
                return $objAnuncioInfo;
            case "anuncioIntegracao":
                $objAnuncioIntegracao = new AnuncioIntegracao();
                $objAnuncioIntegracao = $objAnuncioIntegracao->altera($objAtual, $objNovo);
                return $objAnuncioIntegracao;
            case "anuncioIntegracaoFacebook":
                $objAnuncioIntegracao = new AnuncioIntegracao();
                $objAnuncioIntegracao = $objAnuncioIntegracao->alteraFacebook($objAtual, $objNovo);
                return $objAnuncioIntegracao;
            case "anuncioIntegracaoMaps":
                $objAnuncioIntegracao = new AnuncioIntegracao();
                $objAnuncioIntegracao = $objAnuncioIntegracao->alteraMaps($objAtual, $objNovo);
                return $objAnuncioIntegracao;
            case "alterarImgPerfil":
                include_once("../../model/AnuncioApresentacao.php");
                $objAnuncio = new AnuncioApresentacao();
                $objAnuncio = $objAnuncio->alteraImgPerfil($objAtual, $objNovo);
                return $objAnuncio;
            case "alterarImgAlbum":
                include_once("../../model/AnuncioApresentacao.php");
                $objAnuncioApresentacao = new AnuncioApresentacao();
                $objAnuncioApresentacao = $objAnuncioApresentacao->alteraImgAlbum($objAtual, $objNovo);
                return $objAnuncioApresentacao;
            case "removerAlbum":
                include_once("../../model/AnuncioApresentacao.php");
                $objAnuncioApresentacao = new AnuncioApresentacao();
                $objAnuncioApresentacao = $objAnuncioApresentacao->removeImgAlbum($objAtual, $objNovo);
                return $objAnuncioApresentacao;
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
    
    public static function criaObjJs($tipo, $obj){
        $var = "";

        $var .= "{";
         
        switch($tipo){
            case "anuncio":
                $var .= '"IdAnuncio": ' . $obj['Anuncio']->getIdAnuncio().', ';
                $var .= '"IdEmpresa": ' . $obj['Anuncio']->getIdEmpresa().' ';
                break;
            case "apresentacao":
                $var .= '"NomeExibicao": "' . $obj->getNomeExibicao().'", ';
                $var .= '"Descricao": "' . $obj->getDescricao().'", ';
                $var .= '"ImgPerfil": "' . $obj->getImgPerfil().'", ';
                $var .= '"ImgAlbum": "' . $obj->getImgAlbum().'", ';
                $var .= '"ObservacaoApresentacao": "' . $obj->getObservacao().'" ';
                break;
            case "horarios":
                $var .= '"HorarioFuncionamento": "' . $obj->getHorarioFuncionamento().'" ';
                break;
            case "info":
                $var .= '"EntregaDomicilio": "' . $obj->getEntregaDomicilio().'", ';
                $var .= '"AtendeLocal": "' . $obj->getAtendeLocal().'", ';
                $var .= '"ObservacaoInfo": "' . $obj->getObservacao().'" ';
                break;
            case "enderecos":
                
                 $var .= '"Rua": "' . $obj->getRua().'", ';
                $var .= '"Bairro": "' . $obj->getBairro().'", ';
                $var .= '"Complemento": "' . $obj->getComplemento().'", ';
                $var .= '"Cep": "' . $obj->getCep().'", ';
                $var .= '"Numero": "' . $obj->getNumero().'", ';
                $var .= '"ObservacaoEndereco": "' . $obj->getObservacao().'" ';
                break;
            case "telefones":
                $var .= '"Telefone1": "' . $obj->getTelefone1().'", ';
                $var .= '"Telefone2": "' . $obj->getTelefone2().'", ';
                $var .= '"Email1": "' . $obj->getEmail1().'", ';
                $var .= '"Email2": "' . $obj->getEmail2().'", ';
                $var .= '"Celular1": "' . $obj->getCelular1().'", ';
                $var .= '"Celular2": "' . $obj->getCelular2().'" ';
                break;
            case "telefones":
                $var .= '"Email1": "' . $obj->getEmail1().'", ';
                $var .= '"Email2": "' . $obj->getEmail2().'" ';
                break;
            case "outros":
                $var .= '"Site": "' . $obj->getSite().'", ';
                $var .= '"ObservacaoContato": "' . $obj->getObservacao().'" ';
                break;
            case "facebook":
                $var .= '"FacebookPagina": "' . $obj->getFacebookPagina().'", ';
                $var .= '"FacebookCurtidas": "' . $obj->getFacebookCurtidas().'", ';
                $var .= '"FacebookComentarios": "' . $obj->getFacebookComentarios().'" ';
                break;
            case "maps":
                $var .= '"GoogleMaps": "' . $obj->getGoogleMaps().'" ';

                break;
        }
        
         $var .= "}";
         
        return $var;
    }
    
    public static function criaObjetoAnuncio($IdAnuncio, $IdEmpresa){
        return Anuncio::criaObjetoAnuncio($IdAnuncio, $IdEmpresa);
    }
    
    public static function criaObjetoApresentacao($NomeExibicao, $Descricao, $ImgPerfil, $ImgAlbum, $Observacao, $objAnuncio){
        return AnuncioApresentacao::criaObjetoApresentacao($NomeExibicao, $Descricao, $ImgPerfil, $ImgAlbum, $Observacao, $objAnuncio);
    }
    
    public static function criaObjetoFuncionamento($HorarioFuncionamento){
        return AnuncioInfo::criaObjetoInfo(null, $HorarioFuncionamento, null, null);
    }
    
    public static function criaObjetoInfo($AtendeLocal, $EntregaDomicilio){
        return AnuncioInfo::criaObjetoInfo($EntregaDomicilio, null, $AtendeLocal, null);
    }
    
    public static function criaObjetoEndereco($Rua, $Bairro, $Numero, $Cep, $Complemento, $Observacao){
        return AnuncioEndereco::criaObjetoEndereco($Rua, $Bairro, $Numero, $Complemento, $Cep, $Observacao);
    }
    
    public static function criaObjetoTelefone($Telefone1, $Telefone2, $Celular1, $Celular2){
        return AnuncioContato::criaObjetoContato($Telefone1, $Telefone2, $Celular1, $Celular2, null, null, null, null);
    }
    
    public static function criaObjetoEmail($Email1, $Email2){
        return AnuncioContato::criaObjetoContato(null, null, null, null, $Email1, $Email2, null, null);
    }
    
    public static function criaObjetoFacebook($FacebookPagina, $IdFacebookPagina, $FacebookCurtidas, $FacebookComentarios){
        return AnuncioIntegracao::criaObjetoIntegracao($FacebookPagina, $IdFacebookPagina, $FacebookCurtidas, $FacebookComentarios, null, null);
    }
    
    public static function criaObjetoMaps($GoogleMaps){
        return AnuncioIntegracao::criaObjetoIntegracao(null, null, null, $GoogleMaps, null);
    }

    // </editor-fold>

}
