<?php

/******************************************************************************
 * Copyright (c) 2022. Justin Erdmier - All Rights Reserved                   *
 * Licensed under the MIT License - See LICENSE in repository root.           *
 ******************************************************************************/

declare(strict_types = 1);

namespace WebUI\Controllers;

use PhpDotNet\Builder\WebApplication;
use PhpDotNet\Http\Attributes\HttpGet;
use PhpDotNet\MVC\ControllerBase;
use PhpDotNet\MVC\View;
use WebUI\Models\ManageModel;

class HomeController extends ControllerBase {

    #[HttpGet('/')]
    public function index(): View {
        return $this->view(view:'Home/Index');
    }

    #[HttpGet('/Manage/{name}')]
    public function manage(string $name): View {
        WebApplication::$app->logger->info('Home/Manage/Manage route parameter: $name => {name}', ['name' => $name]);
        $model = new ManageModel($name);
        return $this->view('Home/Manage/Manage', $model);
    }

    #[HttpGet('/NotFound')]
    public function notFound(): View {
        return $this->view('Shared/NotFound');
    }

    #[HttpGet('/Error')]
    public function error(string $message): View {
        WebApplication::$app->logger->info('Error view parameter: $message => {message}', ['message' => $message]);
        return $this->view('Shared/Error');
    }
}
