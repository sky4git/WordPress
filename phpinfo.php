<?php
print_r($_SERVER);
print_r(opcache_get_configuration ());
print_r(get_loaded_extensions());
phpinfo();