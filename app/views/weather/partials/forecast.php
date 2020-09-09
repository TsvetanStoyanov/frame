<?php

use App\Models\Weather;
use Core\H;

$api_key = '5561898f0f5bb504a13c9152d077f7da';
@$town = $_GET['town'];
$forecast = 'http://api.openweathermap.org/data/2.5/forecast?appid=' . $api_key . '&q=' . $town;

if (empty($_GET['town'])) {
    @$lat = $_GET['lat'];
    @$lon = $_GET['lon'];
    @$todays_weather = 'http://api.openweathermap.org/data/2.5/weather?lat=' . $lat . '&lon=' . $lon . '&appid=' . $api_key;
    @$forecast = 'http://api.openweathermap.org/data/2.5/forecast?lat=' . $lat . '&lon=' . $lon . '&appid=' . $api_key;

    @$json_todays_weather = file_get_contents($todays_weather);
    @$json_forecast = file_get_contents($forecast);
} else {
    @$todays_weather = 'http://api.openweathermap.org/data/2.5/weather?q=' . $town . '&appid=' . $api_key;
    @$json_todays_weather = file_get_contents($todays_weather);
}


$json_todays_weather = file_get_contents($todays_weather);
$json_forecast = file_get_contents($forecast);


$data = json_decode($json_todays_weather, true); //todays data
$data_forecast = json_decode($json_forecast, true); //forecat data
?>


<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2">
            <table class="table">
                <tr>
                    <th>Day (Hour)</th>
                    <th>Temperature (C°)</th>
                    <th>Feels like (C°)</th>
                    <th>Forecast</th>
                    <th>Speed</th>
                    <th>Wind</th>
                    <?php



                    if ($data_forecast) {


                        $html = '';
                        foreach ($data_forecast['list'] as $key => $item) {
                    ?>
                <tr>

            <?php

                            $day = substr(gmdate("l", ((int)$item['dt'] + 2000)), 0, 3);
                            $html = '<td>' . $day . substr($item['dt_txt'], 10, 6) . '</td>';
                            $html .= '<td>' . ((int)$item['main']['temp'] - 273.15) . ' C°' . '</td>';
                            $html .= '<td>' . ((int)$item['main']['feels_like'] - 273.15) . ' C°' . '</td>';
                            $html .= '<td>' . "<img src='http://openweathermap.org/img/w/" . $item['weather'][0]['icon'] . ".png'>" .  $item['weather'][0]['description'] . '</td>';
                            $html .= '<td>' . $item['wind']['speed'] . '</td>';
                            $html .= '<td>' . Weather::weather($item['wind']['deg'])  . '</td>';

                            echo $html;
                        }
                    } else {
                        echo '<h1>Please select town</h1>';
                    }
            ?>
                </tr>
                </tr>
            </table>
        </div>
    </div>
</div>