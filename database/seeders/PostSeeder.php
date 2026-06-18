<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    use WithoutModelEvents;

    private const TargetCount = 5_000_000;

    private const ChunkSize = 5_000;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $existingPosts = Post::query()->count();
        $remainingPosts = max(0, self::TargetCount - $existingPosts);

        if ($remainingPosts === 0) {
            $this->command->info('The posts table already has at least 5,000,000 records.');

            return;
        }

        $this->command->info("Creating {$remainingPosts} posts...");

        $now = now();

        for ($offset = 0; $offset < $remainingPosts; $offset += self::ChunkSize) {
            $recordsInChunk = min(self::ChunkSize, $remainingPosts - $offset);
            $posts = [];

            for ($index = 1; $index <= $recordsInChunk; $index++) {
                $number = $existingPosts + $offset + $index;

                $posts[] = [
                    'title' => "Benchmark post {$number}",
                    'author' => 'Author '.(($number % 1000) + 1),
                    'body' => "This is dummy body content for benchmark post {$number}. It exists to compare normal pagination with quick pagination on a large posts table.",
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            DB::table((new Post)->getTable())->insert($posts);

            $this->command->info('Inserted '.min($existingPosts + $offset + $recordsInChunk, self::TargetCount).' / '.self::TargetCount.' posts.');
        }
    }
}
