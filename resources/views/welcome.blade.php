<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-white font-sans text-neutral-950 antialiased">
        <main class="mx-auto flex min-h-screen w-full max-w-5xl flex-col justify-center gap-8 px-4 py-10 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-3">
                <p class="text-sm font-medium text-neutral-500">Pagination benchmark</p>
                <h1 class="text-3xl font-semibold text-neutral-950 sm:text-4xl">Laravel pagination comparison</h1>
                <p class="max-w-2xl text-base text-neutral-600">
                    Compare the standard paginator and cached quick paginator against the five million row posts table.
                </p>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <a
                    href="{{ route('posts.pagination.normal') }}"
                    class="group rounded-lg border border-neutral-200 p-5 transition hover:border-neutral-400 hover:bg-neutral-50"
                >
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex flex-col gap-2">
                            <h2 class="text-lg font-semibold text-neutral-950">Normal pagination</h2>
                            <p class="text-sm text-neutral-600">Runs Laravel's regular <code class="rounded bg-neutral-100 px-1 py-0.5 text-neutral-800">paginate(50)</code>.</p>
                        </div>
                        <span class="text-2xl leading-none text-neutral-400 transition group-hover:translate-x-1 group-hover:text-neutral-700">&rarr;</span>
                    </div>
                </a>

                <a
                    href="{{ route('posts.pagination.quick') }}"
                    class="group rounded-lg border border-neutral-200 p-5 transition hover:border-neutral-400 hover:bg-neutral-50"
                >
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex flex-col gap-2">
                            <h2 class="text-lg font-semibold text-neutral-950">Quick pagination</h2>
                            <p class="text-sm text-neutral-600">Runs the package macro <code class="rounded bg-neutral-100 px-1 py-0.5 text-neutral-800">quickPaginate(50)</code>.</p>
                        </div>
                        <span class="text-2xl leading-none text-neutral-400 transition group-hover:translate-x-1 group-hover:text-neutral-700">&rarr;</span>
                    </div>
                </a>
            </div>
        </main>
    </body>
</html>
