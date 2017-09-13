<?php

require_once __DIR__.'/conf/init.php';

die(var_dump($request));

die(var_dump($router->match($request->getUrl())));
