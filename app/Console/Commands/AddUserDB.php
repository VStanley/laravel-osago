<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AddUserDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:user {login} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add user in DB';

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
        $login = $this->argument('login');
        $password = $this->argument('password');

        $fields = [
            'login'=>$login,
            'password'=>bcrypt($password)
        ];

        try{
            $user = new User();
            $user->add($fields);
        } catch (\Exception $exception){
            $this->error($exception->getMessage());
        }
    }
}
