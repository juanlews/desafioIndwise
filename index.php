<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

         <title>Teste</title>
		<meta name="theme-color" content="#2e4677">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="css/materialize.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">    
		
		<link href="css/font-awesome.min.css " rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
		<link href="http://allfont.net/allfont.css?fonts=raleway-black-italic" rel="stylesheet" type="text/css" />
		<link href="http://allfont.net/allfont.css?fonts=raleway-medium-italic" rel="stylesheet" type="text/css" />		
		<link href="css/responsive.css " rel="stylesheet">
		
        <!-- Theme Styles -->
        <link href="css/alpha.css " rel="stylesheet" type="text/css"/>
       
        <!-- GENTELELLA -->        
        <!-- Bootstrap -->
        <link href="https://colorlib.com/polygon/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="https://colorlib.com/polygon/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="https://colorlib.com/polygon/vendors/nprogress/nprogress.css" rel="stylesheet">
    
        <!-- Custom Theme Style -->
        <link href="https://colorlib.com/polygon/build/css/custom.min.css" rel="stylesheet">
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <!-- Styles -->
        <link href="css/custom.css" rel="stylesheet">   
    </head>
    
    <body>
        <div class="loader-bg"></div>
        <div class="loader">
            <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-orange">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
        <nav style="display:none;" id="nav">
            <div class="nav-wrapper"  >
                <a href="#" class="brand-logo">IndWise</a>               
            </div>
        </nav>
        
        <div class="col-s12-m12" id="msg" hidden=true style="padding: 5px" >
            <div class="content" id="grafico">                 
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel" style="width: 100vh">
                    <div class="x_title">
                    
                    <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: block;"><iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
                    <canvas id="lineChart" height="261" width="523" style="width: 419px; height: 209px;"></canvas>
                    </div>
                </div>
              </div>       
            </div>
            <div class="col-s12-m12" id="msg2" >
                
                <div class="content">
                    <script type="text/javascript" src="ajax.js"></script>
                    <div id="Container">
                        <div id="Pesquisar" >
                            <input type="button"  class="btn-large waves-effect waves-light" name="btnPesquisar" value="Carregar" onclick="getDados();"/>
                        </div>
                        <hr/>        
                            <div id="Resultado" onchange="grafico(this);" style="display: none;"></div>
                        <hr>
                    </div>
                </div>    
            </div>
            
        </div>
        
     <!-- Javascripts -->
     
        <script type="text/javascript" src="js/jquery-2.2.0.min.js"></script>
        <script type="text/javascript" src="js/chart.min.js"></script>
        <script type="text/javascript" src="js/materialize.js"></script>
        <script type="text/javascript" src="js/materialPreloader.min.js"></script>
		
        
        <script type="text/javascript">
        
            $(window).load(function(){

                $('.preloader-wrapper').addClass('animate-in');
                $('#nav').show();
                $('#msg').show();
                $('.preloader-wrapper').remove();
               
            });
            
            $(document).ready(function() {
                $('#Resultado').bind("DOMSubtreeModified",function(){
                    alert('carregando graficos');
                    txt = $('#Resultado').text();
                    console.log(txt.replace(/},{/g, ','));
                    var obj = JSON.parse(txt.replace(/},{/g, ',').replace('[', '').replace(']',''));
                    //console.log()
                    grafico(obj);
                });
                grafico(null);
            });
            
            function grafico(dados){
                var valores = [];
                var datas = [];
                if(dados != null){               
                    for(var it in dados ){
                        console.log( "myObj["+it+"] = " + dados[it] );
                        console.log('tipo' + datas.push(it));
                        valores.push(dados[it]);
                    }
                    console.log(datas, valores);
                    var ctx = document.getElementById("lineChart");
                    var linechart = new Chart(ctx, {
                        type: 'bar',
                        data:{
                            labels:datas,
                            datasets:[{                        
                                label:"Produção",
                                backgroundColor:"rgba(38,166,154, 0.41)",
                                data:valores
                            }]
                        },
                        options:{
                            scales:{
                                yAxes:[{
                                    ticks:{
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
    
                    $('#grafico').show();                    
    
                } else {
                    var ctx = document.getElementById("lineChart");
                    var linechart = new Chart(ctx, {
                        type: 'bar',
                        data:{
                            labels:[0, 0, 0, 0, 0, 0],
                            datasets:[{                        
                                label:"Produção",
                                backgroundColor:"rgba(38,185,0, 0.31)",
                                data:[0 , 0 , 0, 0, 0, 0]                        
                            }]
                        },
                        options:{
                            scales:{
                                yAxes:[{
                                    ticks:{
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                }
            }
            
        </script>     
    </body>
</html>
