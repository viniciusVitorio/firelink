@extends('layout')

@section('content')
<main class="min-h-screen bg-[#0b0d10] text-slate-200">
    <header class="mx-auto flex max-w-5xl items-center justify-between px-6 py-6">
        <a href="/" class="text-sm font-semibold tracking-wide">
            <span class="text-orange-500">Fire</span><span class="text-slate-300">link</span>
        </a>

        <nav class="hidden items-center gap-6 text-sm text-slate-500 md:flex">
            <a href="#" class="transition hover:text-slate-200">Docs</a>
            <a href="#" class="transition hover:text-slate-200">Ember</a>
            <a href="#" class="transition hover:text-slate-200">GitHub</a>
        </nav>
    </header>

    <section class="mx-auto max-w-5xl px-6 pt-20 pb-16">
        <div class="max-w-3xl">
            <p class="mb-5 text-sm font-medium text-orange-500">
                PHP framework study project
            </p>

            <h1 class="text-4xl font-semibold tracking-tight text-slate-100 md:text-6xl">
                A tiny framework to learn how PHP really works
            </h1>

            <p class="mt-6 max-w-2xl text-base leading-7 text-slate-400 md:text-lg">
                Firelink is a lightweight educational framework built from scratch,
                with routing, controllers, views and a Blade-inspired template engine
                called Ember.
            </p>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                <a href="#"
                   class="rounded-lg bg-orange-600 px-5 py-3 text-sm font-medium text-white transition hover:bg-orange-500">
                    Read the docs
                </a>

                <a href="https://github.com/viniciusVitorio/firelink"
                   class="rounded-lg border border-slate-800 px-5 py-3 text-sm font-medium text-slate-300 transition hover:border-slate-700 hover:bg-slate-900">
                    View source
                </a>
            </div>
        </div>
</main>
@endsection