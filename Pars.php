<html>
    <head>
    </head>

    <body>
     <br> Температура в городе Ростов-на-Дону :

<?php
include 'simple_html_dom.php';


$html = file_get_html('https://www.gismeteo.by/weather-rostov-na-donu-5110/10-days');
//#forecastTable > tbody:nth-child(1) > tr:nth-child(6) > td:nth-child(2) > div:nth-child(1) > b:nth-child(1)
$temp = $html->find('div[class="chart ten-days"]', 0);
$today = $temp->find('span[class="unit unit_temperature_c"]', 0)->innertext;
$tomorrow = $html->find('div [class="value style_size_m"]', 1)->find('span[class="unit unit_temperature_c"]', 0)->innertext;

echo "$today";

$day = "<br> Завтра:";
echo "$day $tomorrow";




?>




    </body>

</html>
