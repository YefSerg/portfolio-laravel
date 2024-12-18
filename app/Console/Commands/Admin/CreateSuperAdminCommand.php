<?php

namespace App\Console\Commands\Admin;

use App\Enums\UserRoles;
use App\Models\User;
use Illuminate\Console\Command;

class CreateSuperAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-super-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create super admin';
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $password = $this->secret('What is the password?');

        $data = [
            'name' => 'root',
            'role' => UserRoles::SUPER_ADMIN,
            'email' => 'root@root.com',
            'password' => $password,
        ];

        User::create($data);
    }
}
