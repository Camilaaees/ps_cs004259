<p>Olá, estamos na homepage</p>
<ul>
<?php

foreach($estados as $e) {
    echo "<li>{$e['estado']}</li>";
}

?>
</ul>