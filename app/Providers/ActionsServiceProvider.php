<?php

namespace App\Providers;

use App\Actions\Admin\Project\DestroyAction;
use App\Actions\Admin\User\StoreAction;
use App\Actions\Admin\User\UpdateAction;
use App\Contracts\Actions\Admin\Project\DestroyActionContract;
use App\Contracts\Actions\Admin\User\StoreActionContract;
use App\Contracts\Actions\Admin\User\UpdateActionContract;
use Illuminate\Support\ServiceProvider;

class ActionsServiceProvider extends ServiceProvider
{
    public $bindings = [
        StoreActionContract::class => StoreAction::class,
        UpdateActionContract::class => UpdateAction::class,
        \App\Contracts\Actions\Admin\Project\StoreActionContract::class => \App\Actions\Admin\Project\StoreAction::class,
        \App\Contracts\Actions\Admin\Project\UpdateActionContract::class => \App\Actions\Admin\Project\UpdateAction::class,
        DestroyActionContract::class => DestroyAction::class,
    ];
}
