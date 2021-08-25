<?php

namespace App\Observers;

use App\Models\BlogPost;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class BlogPostObserver
{
    /**
     * @param BlogPost $blogPost
     * 
     * @return void/false
     */
    public function creating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);

        $this->setSlug($blogPost);

        $this->setHtml($blogPost);

        $this->setUser($blogPost);
    }

    /**
     * Создание HTML из сырой статьи
     * 
     * @param BlogPost $blogPost
     * 
     * @return void
     */
    protected function setHtml(BlogPost $blogPost)
    {
        if ($blogPost->isDirty('content_raw')) {
            // TODO тут должна быть генерация markdown -> HTML
            $blogPost->content_html = $blogPost->content_raw;
        }
    }

    protected function setUser(BlogPost $blogPost)
    {
        $blogPost->user_id = auth()->id() ?? BlogPost::UNKNOWN_USER;
    }

    /**
     * Handle the BlogPost "created" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }

    /**
     * @param BlogPost $blogPost
     * 
     * @return void/false
     */
    public function updating(BlogPost $blogPost)
    {
        // $test[] = $blogPost->isDirty();
        // $test[] = $blogPost->isDirty('is_published');
        // $test[] = $blogPost->isDirty('user_id');
        // $test[] = $blogPost->getAttribute('is_published');
        // $test[] = $blogPost->is_published;
        // $test[] = $blogPost->getOriginal('is_published');
        // dd($test);

        $this->setPublishedAt($blogPost);

        $this->setSlug($blogPost);
    }

    /**
     * Handle the BlogPost "updated" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        //
    }

    /**
     * @param BlogPost $blogPost
     * 
     * @return void
     */
    protected function setPublishedAt(BlogPost $blogPost)
    {
        $needSetPublished = empty($blogPost->published_at) && $blogPost['is_published'];

        if ($needSetPublished) {
            $data['published_at'] = Carbon::now();
        }
    }

    /**
     * @param BlogPost $blogPost
     * 
     * @return void
     */
    protected function setSlug(BlogPost $blogPost)
    {
        if (!$blogPost['slug']) {
            $blogPost['slug'] = Str::slug($blogPost['title']);
        }
    }

    /**
     * Handle the BlogPost "deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "restored" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "force deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }
}
