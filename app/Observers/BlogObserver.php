<?php

// app/Observers/BlogObserver.php

namespace App\Observers;

use App\Models\Blog;

class BlogObserver
{
    /**
     * Handle the Blog "deleting" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function deleting(Blog $blog)
    {
        $blog->slug = null;
        $blog->save();
    }
}
