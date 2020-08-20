<?php $this->site_title('Access Restricted');  ?>
<?php $this->start('body');  ?>
<h1 class="text-center red">You do not have permission to access this page.</h1>
<?php

header('Location: home');

?>



<?php $this->end() ?>

