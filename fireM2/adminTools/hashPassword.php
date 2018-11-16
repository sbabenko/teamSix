<?php

$passHash = password_hash($argv[1], PASSWORD_BCRYPT);

echo $passHash;

?>