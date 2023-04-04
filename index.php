<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Conversor de Dólar</title>
</head>
<body>
  <header>
    <h1>Conversor de Dólar</h1>
  </header>
  <main>
    <?php 
    //cotacao vinda da api do banco central
        $inicio = date("m-d-Y" ,strtotime("-7 days"));
        $fim = date("m-d-Y");
        $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''. $inicio.'\'&@dataFinalCotacao=\''. $fim .'\'&27&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';
        $dados = json_decode(file_get_contents($url), true);
        
        $cotacao =  $dados["value"][0]["cotacaoCompra"];
        $real = $_REQUEST["din"] ?? 0;
        $dolar = $real / $cotacao ;
      
     //formatação de moedas com internacionalização!
     $padrao = numfmt_create("pt-BR", NumberFormatter::CURRENCY); 
     echo "<br> Seus " . numfmt_format_currency($padrao,$real,"BRL") . " equivalem a  <strong>" . numfmt_format_currency($padrao, $dolar, "USD") . "</strong>";

    ?>
    <br>
    <br>
    <br>
          <button onclick="javascript:history.go(-1)">🔃 Voltar</button>
  </main>
</body>
</html>
