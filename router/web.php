<?php

use App\Http\Controller\HomepageController;
use Progress\Facade\Router;

Router::get('/', [HomepageController::class, 'index']);
Router::put('/', [HomepageController::class, 'update']);
