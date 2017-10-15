<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create 
                            {--name=}
                            {--email=}
                            {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Simple user create command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       $name = $this->option('name');
       $email = $this->option('email');
       $password = $this->option('password');

        if (empty($name) || empty($email) || empty($password)) {
            $this->error("You miss some parameters. Try something like:\nphp artisan user:create --name=Admin --email=admin --password=123456") ;
        }

        $user = new \App\User();
        $user->name = $name;
        $user->email = trim($email);
        $user->password = bcrypt(trim($password));
        $user->save();

        if ($user->id) {
            $this->info("User with id {$user->id} was created.");
            return;
        }

        $this->error('Cant create user');
    }
}
