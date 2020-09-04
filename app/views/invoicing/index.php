<?php

use Core\H;
use App\Models\Invoicing;
use App\Models\Users;




echo $this->start('head');  ?>
<script type="text/javascript">
    function geoFindMe() {
        function success(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            // document.getElementById("lat").value = latitude;
            // document.getElementById("lon").value = longitude;
            //alert(a);
            /*AJAX*/


            /*Ennd AJAX*/
        }

        function error() {
            document.getElementById("err_msg").value = 'Unable to retrieve your location';
        }

        if (!navigator.geolocation) {
            document.getElementById("err_msg").value = 'Geolocation is not supported by your browser';
        } else {
            navigator.geolocation.getCurrentPosition(success, error);

        }
    }
</script>
<?php echo $this->end(); ?>

<?php echo $this->start('body');  ?>


<?php
// CONTROLLER
// GET FROM QUERY
$counter = 0;
foreach ($this->invoicing as $key => $value) {
    $counter++;
}
echo $counter;
?>

<?php
if (!empty($_GET['town'])) {
    $api_key = '5561898f0f5bb504a13c9152d077f7da';
    $town = $_GET['town'];
    // http://api.openweathermap.org/data/2.5/forecast?appid=&q=Sofia
    // $todays_weather = 'http://api.openweathermap.org/data/2.5/weather?lat=' . $lat . '&lon=' . $lon . '&appid=' . $api_key;
    $todays_weather = 'http://api.openweathermap.org/data/2.5/weather?q=' . $town . '&appid=' . $api_key;
    $forecast = 'http://api.openweathermap.org/data/2.5/forecast?appid=' . $api_key . '&q=' . $town;

    $json_todays_weather = file_get_contents($todays_weather);
    $json_forecast = file_get_contents($forecast);


    $data = json_decode($json_todays_weather, true); //todays data
    $data_forecast = json_decode($json_forecast, true); //forecat data

    $temp = $data['main']['temp'];
    $sunrise = $data['sys']['sunrise'];
    $sunset = $data['sys']['sunset'];
?>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-3">
                <form action="" method="get">
                    <select id="town" name="town">
                        <option value="sofia">sofia</option>
                        <option value="varna">varna</option>
                        <option value="plovdiv">plovdiv</option>
                        <option value="ruse">ruse</option>
                    </select>
                    <input type="submit" value="search">
                </form>
                <h2>
                    <?php echo $data['name'] . ', ' . $data['sys']['country'] ?>
                    <img id="img" src="http://openweathermap.org/img/w/<?php echo $data['weather'][0]['icon'] ?>.png" width="50px" height="50px">
                </h2>
                <h3>
                    <?php echo $data['weather'][0]['main'] ?><span> Wind <?php echo $data['wind']['speed'] ?>km/h <span class="dot">•</span> Humidity
                        <?php echo $data['main']['humidity'] ?>%</span><span><?php echo gmdate("l", $sunrise + 2000); ?></span>
                </h3>
                <h1>
                    <?php echo ((int)$temp - 273.15) ?>°
                </h1>
            </div>
        </div>
    </div>

<?php
} else {
    echo "<form action='' method='get'>
                    <select id='town' name='town'>
                        <option value='sofia'>sofia</option>
                        <option value='varna'>varna</option>
                        <option value='plovdiv'>plovdiv</option>
                        <option value='ruse'>ruse</option>
                    </select>
                <input type='submit'>
                </form>";
}
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
                            $html .= '<td>' . Invoicing::weather($item['wind']['deg'])  . '</td>';

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

<?php


// GET FROM MODEL
$counter = 0;
foreach ($this->books as $key => $value) {
    $counter++;
}

echo $counter;


?>

<?php echo $this->end();  ?>