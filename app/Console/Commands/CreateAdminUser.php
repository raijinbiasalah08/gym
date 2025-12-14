<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or update admin user account';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = 'admin@gym.com';
        
        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '+1234567890',
                'is_active' => true,
                'approval_status' => 'approved',
            ]
        );

        $this->info('Admin user created/updated successfully!');
        $this->info('Email: ' . $user->email);
        $this->info('Password: password');
        $this->info('Role: ' . $user->role);
        $this->info('Active: ' . ($user->is_active ? 'Yes' : 'No'));
        $this->info('Approval Status: ' . $user->approval_status);
        
        // Test password
        if (Hash::check('password', $user->password)) {
            $this->info('✓ Password hash verified successfully');
        } else {
            $this->error('✗ Password hash verification failed');
        }

        return 0;
    }
}
