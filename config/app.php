<?php

use App\Providers\provider;

return [
'app_title' => 'practice',
'base_url' => 'http://localhost:8000',
'base_dir' => str_replace('\\','/',dirname(__DIR__)),


'Providers' => [
    \App\Providers\SessionProvider::class,
    \App\Providers\AppServiceProvider::class
]

];



// $temperari = str_replace(base_url,'',explode('?',$_SERVER['REQUEST_URI']) [0]);

// $temperari === "/" ? $temperari = "" : $temperari = substr($temperari,1);


// define('CURRENT_ROUTE', $temperari);




?>