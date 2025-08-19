<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
        // Article::factory()->count(10)->create();
        $articles_count = Article::all()->count();
        $message = str_repeat('=', 40) . PHP_EOL;
        $message .= "   ALTERANDO NOME DE $articles_count REGISTROS" . PHP_EOL;
        $message .= str_repeat('=', 40) . PHP_EOL;
        $this->info($message);

        $old_names = Article::pluck('title');

        DB::table('articles')->update([
            'title' => 'noweb'
        ]);

        $new_names = Article::pluck('title');

        $this->line('| Nome Antigo | Novo Nome |');
        for($i = 0; $i < $articles_count; $i++){
            $this->line("| {$old_names[$i]} | {$new_names[$i]}");
        }
    }
}
