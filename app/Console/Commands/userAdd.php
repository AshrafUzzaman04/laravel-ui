<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use PhpParser\Node\Stmt\For_;

class userAdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user {count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate new user';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $user = $this->argument("count");
        for ($i = 0; $i < $user; $i++) {
            User::factory()->create();
        }
    }
}
