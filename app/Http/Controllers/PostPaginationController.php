<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PostPaginationController extends Controller
{
    public function normal(): View
    {
        return $this->render('normal');
    }

    public function quick(): View
    {
        return $this->render('quick');
    }

    private function render(string $mode): View
    {
        $queryCount = 0;

        DB::listen(function () use (&$queryCount): void {
            $queryCount++;
        });

        $startedAt = hrtime(true);
        $query = $this->postsQuery();

        $posts = $mode === 'quick'
            ? $query->quickPaginate(50)
            : $query->paginate(50);

        $elapsedMilliseconds = (hrtime(true) - $startedAt) / 1_000_000;

        return view('posts.pagination', [
            'elapsedMilliseconds' => $elapsedMilliseconds,
            'mode' => $mode,
            'posts' => $posts,
            'queryCount' => $queryCount,
        ]);
    }

    /**
     * @return Builder<Post>
     */
    private function postsQuery(): Builder
    {
        return Post::query()
            ->select(['id', 'title', 'author', 'body', 'created_at'])
            ->latest('id');
    }
}
