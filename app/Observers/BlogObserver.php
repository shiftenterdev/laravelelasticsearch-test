<?php

namespace App\Observers;

use App\Jobs\IndexBlogElasticsearchJob;
use App\Jobs\RemoveBlogElasticsearchJob;
use App\Models\Blog;

class BlogObserver
{
    /**
     * Handle the Blog "created" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function created(Blog $blog)
    {
        if ($blog->is_active) {
            dispatch(new IndexBlogElasticsearchJob($blog));
        }
    }

    /**
     * Handle the Blog "updated" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function updated(Blog $blog)
    {
        if ($blog->is_active) {
            dispatch(new IndexBlogElasticsearchJob($blog));
        } else {
            dispatch(new RemoveBlogElasticsearchJob($blog->id));
        }
    }

    /**
     * Handle the Blog "deleted" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function deleted(Blog $blog)
    {
        dispatch(new RemoveBlogElasticsearchJob($blog->id));
    }

    /**
     * Handle the Blog "restored" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function restored(Blog $blog)
    {
        if ($blog->is_active) {
            dispatch(new IndexBlogElasticsearchJob($blog));
        }
    }

    /**
     * Handle the Blog "force deleted" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function forceDeleted(Blog $blog)
    {
        dispatch(new RemoveBlogElasticsearchJob($blog->id));
    }
}