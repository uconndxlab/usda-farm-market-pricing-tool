<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create
                            {--name= : The administrator name}
                            {--email= : The administrator email address}';

    protected $description = 'Create or promote an administrator user';

    public function handle(): int
    {
        $name = $this->option('name') ?: $this->ask('Name');
        $email = $this->option('email') ?: $this->ask('Email');

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Please provide a valid email address.');

            return self::FAILURE;
        }

        $user = User::where('email', $email)->first();

        if ($user) {
            $user->forceFill(['is_admin' => true])->save();
            $this->info("{$user->email} is now an administrator.");

            return self::SUCCESS;
        }

        $password = $this->secret('Password');
        $confirmation = $this->secret('Confirm password');

        if ($password !== $confirmation || $password === '') {
            $this->error('The passwords do not match or are empty.');

            return self::FAILURE;
        }

        User::forceCreate([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'email_verified_at' => now(),
            'is_admin' => true,
        ]);

        $this->info("Administrator {$email} created.");

        return self::SUCCESS;
    }
}