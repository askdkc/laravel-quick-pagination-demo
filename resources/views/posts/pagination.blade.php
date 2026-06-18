<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ $mode === 'quick' ? 'Quick pagination' : 'Normal pagination' }} - {{ config('app.name', 'Laravel') }}</title>
        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-white font-sans text-neutral-950 antialiased">
        <main class="mx-auto flex min-h-screen w-full max-w-7xl flex-col gap-6 px-4 py-6 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
            <div class="flex flex-col gap-2">
                <p class="text-sm font-medium text-neutral-500">Benchmark results</p>
                <h1 class="text-2xl font-semibold text-neutral-950">
                    {{ $mode === 'quick' ? 'Quick pagination' : 'Normal pagination' }}
                </h1>
            </div>

            <div class="flex gap-2">
                <a
                    href="{{ route('posts.pagination.normal') }}"
                    class="inline-flex h-10 items-center rounded-md border px-4 text-sm font-medium {{ $mode === 'normal' ? 'border-neutral-900 bg-neutral-900 text-white' : 'border-neutral-200 text-neutral-700 hover:bg-neutral-100' }}"
                >
                    Normal pagination
                </a>
                <a
                    href="{{ route('posts.pagination.quick') }}"
                    class="inline-flex h-10 items-center rounded-md border px-4 text-sm font-medium {{ $mode === 'quick' ? 'border-neutral-900 bg-neutral-900 text-white' : 'border-neutral-200 text-neutral-700 hover:bg-neutral-100' }}"
                >
                    Quick pagination
                </a>
            </div>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <div class="rounded-lg border border-neutral-200 p-4">
                <p class="text-sm text-neutral-500">Elapsed</p>
                <p class="mt-2 text-2xl font-semibold text-neutral-950">
                    {{ number_format($elapsedMilliseconds, 2) }} ms
                </p>
            </div>
            <div class="rounded-lg border border-neutral-200 p-4">
                <p class="text-sm text-neutral-500">SQL queries</p>
                <p class="mt-2 text-2xl font-semibold text-neutral-950">{{ $queryCount }}</p>
            </div>
            <div class="rounded-lg border border-neutral-200 p-4">
                <p class="text-sm text-neutral-500">Total posts</p>
                <p class="mt-2 text-2xl font-semibold text-neutral-950">{{ number_format($posts->total()) }}</p>
            </div>
        </div>

        <div class="overflow-hidden rounded-lg border border-neutral-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-neutral-200">
                    <thead class="bg-neutral-50">
                        <tr>
                            <th class="w-24 px-4 py-3 text-left text-xs font-semibold uppercase text-neutral-500">ID</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-neutral-500">Title</th>
                            <th class="w-48 px-4 py-3 text-left text-xs font-semibold uppercase text-neutral-500">Author</th>
                            <th class="w-44 px-4 py-3 text-left text-xs font-semibold uppercase text-neutral-500">Created</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-200 bg-white">
                        @foreach ($posts as $post)
                            <tr>
                                <td class="px-4 py-3 text-sm text-neutral-500">{{ $post->id }}</td>
                                <td class="px-4 py-3">
                                    <div class="max-w-xl">
                                        <p class="truncate text-sm font-medium text-neutral-950">{{ $post->title }}</p>
                                        <p class="mt-1 line-clamp-1 text-sm text-neutral-500">{{ $post->body }}</p>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm text-neutral-700">{{ $post->author }}</td>
                                <td class="px-4 py-3 text-sm text-neutral-500">{{ $post->created_at?->format('Y-m-d H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            {{ $posts->links() }}
        </div>
        </main>
    </body>
</html>
