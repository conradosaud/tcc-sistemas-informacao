$(document).ready(function(){
    
    // Variáveis globais com o obj de cada relatório
    // ----
    
    // primeira função a ser chamada quando o script é carregado
    function iniciaScript(){
        imgCarregando(true);
        buscaToken();
    }
    
    // caso haja algum erro ao carregar tokens/relatorio
    function erroRelatorio(){
        $(".carregado").hide();
        
        var html = '';
        html += '<div class="text-center" style="color:#D9534F;">';
        html +=     '<span><i class="fa fa-thumbs-o-down fa-3x"></i></span><br><br>';
        html +=     '<span>Houve um erro ao carregar relatórios.<br>Por favor, tente novamente mais tarde.</span>';
        html += '</div>';
        
        $(".carregando").html(html);
    }
    
    // insere imagens de carregamento
    function imgCarregando(carregando){
        if(carregando){
            $(".carregando").fadeIn(200);
        }else{
            $(".carregando").fadeOut(200);
        }
    }
    
    // busca token de acesso
    function buscaToken(dataInput){
        $.ajax({
            type: "POST",
            url: "../php/oauth2/oauth2.php",
            data: "getAccessToken=true",
            success: function (data) {
                var token = data;
                
                if(dataInput){
                    montaRelatorios(token, dataInput);
                }else{
                    montaRelatorios(token, {start:"7daysAgo", end:"yesterday"});
                }
            },
            error: function () {
                console.log("ERRO BUSCA TOKEN");
                erroRelatorio();
            }
        });
    }
    
    // monta os dados do analytics par serem importados nos graficos
    function montaRelatorios(token, data){
        var urlVisualizacoes = "https://www.googleapis.com/analytics/v3/data/ga?ids=ga%3A133616224&start-date="+data.start+"&end-date="+data.end+"&metrics=ga%3ApercentNewSessions%2Cga%3AavgSessionDuration%2Cga%3Apageviews&dimensions=ga%3ApagePath%2Cga%3Amonth%2Cga%3Aday&filters=ga%3ApagePath%3D%3D%2Fartigo%2F38&access_token="+token;
        var urlUsuarios = "https://www.googleapis.com/analytics/v3/data/ga?ids=ga%3A133616224&start-date="+data.start+"&end-date="+data.end+"&metrics=ga%3Ausers&dimensions=ga%3AuserGender&access_token="+token;
        var urlNovasSessoes = "https://www.googleapis.com/analytics/v3/data/ga?ids=ga%3A133616224&start-date="+data.start+"&end-date="+data.end+"&metrics=ga%3ApercentNewSessions&filters=ga%3ApagePath%3D%3D%2Fartigo%2F38&access_token="+token;
        var urlDispositivos = "https://www.googleapis.com/analytics/v3/data/ga?ids=ga%3A133616224&start-date="+data.start+"&end-date="+data.end+"&metrics=ga%3Asessions&dimensions=ga%3AdeviceCategory&access_token="+token;
        var urlTempoMedio = "https://www.googleapis.com/analytics/v3/data/ga?ids=ga%3A133616224&start-date="+data.start+"&end-date="+data.end+"&metrics=ga%3AavgSessionDuration&filters=ga%3ApagePath%3D%3D%2Fartigo%2F38&access_token="+token;
        
        // visualizacoes
        $.ajax({
            type: "GET",
            url: urlVisualizacoes,
            success: function (data) {
                // [0] = nome | [1] = mes | [2] = dia | [3] % nova sessao | [4] tempo medio | [5] n° visualizacoes
                if(typeof data.rows == "undefined"){
                    semDados("chart1");
                }else if(data.rows == 0){
                    console.log("rows 0");
                }else{
                    var dia = [], view = [];
                    for (var i = 0; i < data.rows.length; i++) {
                        dia.push(data.rows[i][2]+"/"+data.rows[i][1]);
                        view.push(data.rows[i][5]);
                    }

                    relatVisualizacoes = {"dias":dia, "views":view};
                    montaGraficos("visualizacoes");
                }
            },
            error: function () {
                console.log("ERRO AO IMPORTAR VISUALIZAÇÕES");
                erroRelatorio();
            }
        });
        
        // novas sessões
        $.ajax({
            type: "GET",
            url: urlNovasSessoes,
            success: function (data) {
                if(typeof data.rows == "undefined"){
                    semDados("chart2");
                }else{
                    var aux = data.rows[0][0];
                    relatNovasSessoes = {novos: parseInt(aux), recorrentes: parseInt(100-aux)};

                    montaGraficos("novasSessoes");
                }
            },
            error: function () {
                console.log("ERRO AO IMPORTAR USUARIOS");
                erroRelatorio();
            }
        });
        
        // tempo médio
        $.ajax({
            type: "GET",
            url: urlTempoMedio,
            success: function (data) {

                $(".carregando5").hide();
                
                if(typeof data.rows == "undefined"){
                    $("#semRegistros5").show();
                    $(".carregado5").hide();
                }else if(data.rows == 0){
                    console.log("rows 0 (tempo medio)");
                }else{
                    var aux = data.rows[0];
                    var date = new Date(null);
                    date.setSeconds(aux);
                    aux = date.toISOString().substr(14, 5);
                    $("#spanTempoMedio").text(aux);
                    
                    $(".carregado5").show();
                    $("#semRegistros5").hide();
                }
            },
            error: function () {
                console.log("ERRO AO IMPORTAR TEMPO MÉDIO");
                erroRelatorio();
            }
        });
        
        // sexo usuario
        $.ajax({
            type: "GET",
            url: urlUsuarios,
            success: function (data) {
                
                $(".carregando6").hide();
                
                if(typeof data.rows == "undefined"){
                    $("#semRegistros6").show();
                    $(".carregado6").hide();
                }else if(data.rows == 0){
                    console.log("rows 0");
                }else{
                    var usuarios = data.rows;
                    
                    if(usuarios.length == 1){
                        if(usuarios[0][0]=="male"){
                            usuarios = {homens: "100%", mulheres: "0%"};
                        }else{
                            usuarios = {homens: "0%", mulheres: "100%"};
                        }
                    }else{
                        var total = parseInt(usuarios[0][1]) + parseInt(usuarios[1][1]);
                        usuarios = {mulheres: parseFloat((usuarios[0][1]/total)*100).toFixed(1)+"%", homens: parseFloat((usuarios[1][1]/total)*100).toFixed(1)+"%"};
                        
                    }
                    
                    $("#spanSexoF").text(usuarios.mulheres);
                    $("#spanSexoM").text(usuarios.homens);
                        
                    $(".carregado6").show();
                    $("#semRegistros6").hide();
                }
            },
            error: function () {
                console.log("ERRO AO IMPORTAR SEXO");
                erroRelatorio();
            }
        });
        
        // dispositivos
        $.ajax({
            type: "GET",
            url: urlDispositivos,
            success: function (data) {
                
                $(".carregando7").hide();
                
                if(typeof data.rows == "undefined"){
                    $("#semRegistros7").show();
                    $(".carregado7").hide();
                }else if(data.rows == 0){
                    console.log("rows 0");
                }else{
                    var devices = data.rows;
                    var total = 0;
                    var mobile = 0;
                    var desktop = 0;
                    
                    for (var i = 0; i < devices.length; i++) {
                        if(devices[i][0]=="desktop"){
                            desktop += parseInt(devices[i][1]);
                        }else{
                            mobile += parseInt(devices[i][1]);
                        }
                    }
                    
                    total = mobile + desktop;
                    
                    devices = {mobile: (mobile>0?parseFloat((mobile/total)*100).toFixed(1)+"%":"0%"), desktop: (desktop>0?parseFloat((desktop/total)*100).toFixed(1)+"%":"0%")};
                    $("#spanDispositivoMobile").text(devices.mobile);
                    $("#spanDispositivoDesktop").text(devices.desktop);
                    
                    $(".carregado7").show();
                    $("#semRegistros7").hide();
                }
            },
            error: function () {
                console.log("ERRO AO IMPORTAR DISPOSITIVOS");
                erroRelatorio();
            }
        });
              
    }
    
    function semDados(chart){
        switch(chart){
            case "chart1":
                $("#semRegistros1").fadeIn(300);
                $("#chart1").hide();
                break;
            case "chart2":
                $("#semRegistros2").fadeIn(300);
                $("#chart2").hide();
                break;
            case "chartTempoMedio":
                $("#semRegistros3").fadeIn(300);
                $(".carregado5").hide();
                break;
            case "chartSexo":
                $("#semRegistros4").fadeIn(300);
                $(".carregado6").hide();
                break;
            case "chartDispositivos":
                $("#semRegistros5").fadeIn(300);
                $(".carregado7").hide();
                break;
        }
    }
    
    function montaDataChart(){
        var array = [];
        for (var i = 0; i < relatVisualizacoes.views.length; i++) {
            array.push({dia:relatVisualizacoes.dias[i], view: relatVisualizacoes.views[i]});
        }
        
        return array;
    }
    
    // monta e exibe os gráficos na tela
    function montaGraficos(grafico){
        
        if(grafico == "visualizacoes"){
            
            $("#chart1").text("");
            
            // chart 1 (visualizações)
            var html = new Morris.Line({
              // ID of the element in which to draw the chart.
              element: 'chart1',
              // Chart data records -- each entry in this array corresponds to a point on
              // the chart.
              data: montaDataChart(),
              // The name of the data record attribute that contains x-values.
              xkey: 'dia',
              // A list of names of data record attributes that contain y-values.
              ykeys: ['view'],
              // Labels for the ykeys -- will be displayed when you hover over the
              // chart.
              labels: ['Visualizações'],
              parseTime:false
            });
            
            $("#semRegistros1").hide();
            $(".carregando2").hide();
            $("#chart1").fadeIn(300);
        }
        if(grafico == "novasSessoes"){
        
        $("#chart2").text("");
        
        var html = new Morris.Donut({
            element: 'chart2',
            data: [
              {label: "Novos visitantes", value: relatNovasSessoes.novos, formatted: relatNovasSessoes.novos+'%'},
              {label: "Visitantes recorrentes", value: relatNovasSessoes.recorrentes, formatted: relatNovasSessoes.recorrentes+'%'}
            ],
            formatter: function (x, data) { return data.formatted; }
          });
        
        /*
            // chart 2 (novasSessoes)
            // Load Charts and the corechart package.
            google.charts.load('current', {'packages':['corechart']});

            // Draw the pie chart for Sarah's pizza when Charts is loaded.
            google.charts.setOnLoadCallback(drawSarahChart);

            // Callback that draws the pie chart for Sarah's pizza.
            function drawSarahChart() {

              // Create the data table for Sarah's pizza.
              var data = new google.visualization.DataTable();
              data.addColumn('string', 'Novos');
              data.addColumn('number', 'Recorrentes');
              data.addRows([
                ['Novos visitantes', relatNovasSessoes.novos],
                ['Visitantes recorrentes', relatNovasSessoes.recorrentes]
              ]);

              // Set options for Sarah's pie chart.
              var options = {title:null,
                             width:300,
                             height: 200,
                            margin: 0 0 0 -15,
                            padding: 0};

              // Instantiate and draw the chart for Sarah's pizza.
              var chart = new google.visualization.PieChart(document.getElementById('chart2'));
              chart.draw(data, options);
            }
            
        */
           
           $("#semRegistros2").hide();
            $(".carregando3").hide();
            $("#chart2").fadeIn(300);
        }
        
    }
    
    function filtrarData(data){
        var range = {start: "yesterday", end: "yesterday"};
        switch(data){
            case "ontem":
                range.start = "2daysAgo";
                return range;
            case null:
                range.start = "7daysAgo";
                return range;
            case "semana":
                range.start = "7daysAgo";
                return range;
            case "mes":
                range.start = "28daysAgo";
                return range;
            default:
                range.start = $("#dateInicio").val();
                range.end = $("#dateFim").val();
                return range;
        }
    }
    
    $("#btnAtualizar").click(function(){
        buscaToken(filtrarData("custom"));
    });
    
    $(".btnData").click(function(){
        buscaToken(filtrarData($(this).attr("name")));
    });

    iniciaScript();
    
});