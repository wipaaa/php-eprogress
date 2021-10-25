<?php

use App\Http\Controller\Auth\{SignInController, SignOutController};
use App\Http\Controller\Main\{DashboardController, StudentController};

use Progress\Facade\Router;

Router::get('/signin', [SignInController::class, 'index'])->setName('auth.get.signin');
Router::post('/signin', [SignInController::class, 'store'])->setName('auth.post.signin');
Router::get('/signout', [SignOutController::class, 'index'])->setName('auth.get.signout');

Router::get('/dashboard', [DashboardController::class, 'indexMain'])->setName('main.get.dashboard');
Router::get('/dashboard/profile', [DashboardController::class, 'indexProfile'])->setName('main.get.profile');
Router::get('/dashboard/create', [DashboardController::class, 'indexCreate'])->setName('main.get.create');
Router::post('/dashboard/create', [StudentController::class, 'store'])->setName('main.post.create');

Router::get('/dashboard/m/{id}/details', [StudentController::class, 'indexDetails'])->setName('main.get.user.details');
Router::get('/dashboard/m/{id}/update', [StudentController::class, 'indexUpdate'])->setName('main.get.user.update');
Router::put('/dashboard/m/{id}/update', [StudentController::class, 'update'])->setName('main.put.user.update');
Router::get('/dashboard/m/{id}/delete', [StudentController::class, 'destroy'])->setName('main.get.user.delete');
