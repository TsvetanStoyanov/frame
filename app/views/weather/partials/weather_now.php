<?php

use App\Models\Weather;
use Core\H;

$api_key = '5561898f0f5bb504a13c9152d077f7da';

@$town = $_GET['town'];

if (empty($_GET['town'])) {
    @$lat = $_GET['lat'];
    @$lon = $_GET['lon'];

    @$todays_weather = 'http://api.openweathermap.org/data/2.5/weather?lat=' . $lat . '&lon=' . $lon . '&appid=' . $api_key;
    @$json_todays_weather = file_get_contents($todays_weather);
} else {
    @$todays_weather = 'http://api.openweathermap.org/data/2.5/weather?q=' . $town . '&appid=' . $api_key;
    @$json_todays_weather = file_get_contents($todays_weather);
}

@$data = json_decode($json_todays_weather, true); //todays data

@$temp = $data['main']['temp'];
@$feels_like = $data['main']['feels_like'];
@$sunrise = $data['sys']['sunrise'];
@$sunset = $data['sys']['sunset'];


?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3">
            <form action="" method="GET">
                <input type='hidden' value='' id='lon' name='lon'>
                <input type='hidden' value='' id='lat' name='lat'>
                <input name="town" id="town" type="text" value="">
                <input type="submit" value="search">
                <p id='err_msg' class="hidden"></p>
            </form>
            <?php
            if ($data) {
            ?>
                <h4>
                    <?= $data['name'] . ', ' . $data['sys']['country'] ?>
                </h4>
                <h1>
                    <img id="img" src="http://openweathermap.org/img/w/<?= @$data['weather'][0]['icon'] ?>.png" width="50px" height="50px">
                    <?= ((int)$temp - 273); ?>
                </h1>
                <b>
                    <i class="fa fa-thermometer-quarter"><?= ' Feels like ' . (@(int)$feels_like - 273) . '°C.' ?></i>
                    <?= ucfirst(@$data['weather'][0]['description']) ?>
                </b>
                <p>
                    <i class="fa fa-location-arrow fa-rotate"> <?= @$data['wind']['speed'] ?>m/s</i>
                    <?= @Weather::weather($data['wind']['deg']) ?></span>
                    <i class="fa fa-tachometer"> <?= ucfirst(@$data['main']['pressure']) ?>hPa</i>
                    <i class="fa  fa-tint"> <?= ucfirst(@$data['main']['humidity']) ?>%</i>
                    <i class="fa fa-eye"> <?= (@$data['visibility']) / 1000.0 ?>km</i>
                </p>
        </div>
    </div>
</div>


<?php $this->partial('weather', 'forecast') ?>

<?php

            }

?>