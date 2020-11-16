<?php

namespace App\Jobs;

use App\Models\Blog;
use Elasticsearch\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IndexBlogElasticsearchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $blog;

    /**
     * IndexBlogElasticsearchJob constructor.
     * @param Blog $blog
     */
    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    /**
     * Execute the job.
     * @param Client $client
     */
    public function handle(Client $client)
    {
        $params = [
            'index' => 'blogs',
            'id' => $this->blog->id,
            'body' => $this->blog->toArray(),
        ];

        $client->index($params);
    }
}