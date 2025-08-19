<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AlterArticlesName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Altera o nome de todos os registros de notícia para "noweb"';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $message = str_repeat('=', 40) . PHP_EOL;
        $message .= "   ALTERANDO NOME DE X REGISTROS" . PHP_EOL;
        $message .= str_repeat('=', 40) . PHP_EOL;
        $this->info($message);
    }
}
