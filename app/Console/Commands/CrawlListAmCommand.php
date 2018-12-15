<?php

namespace App\Console\Commands;

use App\Models\Item;
use App\Models\User;
use Illuminate\Console\Command;
use Goutte\Client;

class CrawlListAmCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'listam:crawl-list {--category= : the category id which to crawl}';

    private $_client;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawls a list of advertisements from list.am website';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_client = new Client();
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $category_id = $this->option('category');
        $user = User::firstOrFail();
        $crawler = $this->_client->request('get', 'https://www.list.am/category/' . $category_id);
        $crawler->filter('.dl tr.action')->each(function($crawler) use ($user) {
            $title = $crawler->filter('.t a')->text();
            $price = '';
            if ($crawler->filter('.p')->count()) {
                $price = $crawler->filter('.p')->text();
            }
            $user->items()->create([
                'title' => $title,
                'content' => $price,
                'owner_id' => 1,
            ]);
        });
    }
}
