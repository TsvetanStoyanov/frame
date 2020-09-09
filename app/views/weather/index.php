<?php

use Core\H;
use App\Models\Weather;
use App\Models\Users;

echo $this->start('head');  ?>
<script type="text/javascript">
    function getLocation() {
        function success(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            document.getElementById("lat").value = latitude;
            document.getElementById("lon").value = longitude;
            /*AJAX*/


            /*Ennd AJAX*/
        }

        function error() {
            document.getElementById("err_msg").value = 'Unable to retrieve your location';
        }

        if (!navigator.geolocation) {
            document.getElementById("err_msg").value = 'Geolocation is not supported by your browser';
        } else {
            document.getElementById("err_msg").value = 'Locating…';
            navigator.geolocation.getCurrentPosition(success, error);
        }

    }
</script>
<?php echo $this->end(); ?>

<?php echo $this->start('body');  ?>

<?php
// CONTROLLER
// GET FROM QUERY
// $counter = 0;
// foreach ($this->weather as $key => $value) {
//     $counter++;
// }
// echo $counter;
?>

<?php

if (empty($_GET['town'])) {
    $this->partial('weather', 'weather_now');
}


if (!empty($_GET['town'])) {
    $this->partial('weather', 'weather_now');
    $this->partial('weather', 'forecast');
}


// // GET FROM MODEL
// $counter = 0;
// foreach ($this->books as $key => $value) {
//     $counter++;
// }

// echo $counter;




?>


<?php echo $this->end();  ?>