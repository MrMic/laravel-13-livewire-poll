# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

A Laravel 13 + Livewire 4 poll application. Currently a near-fresh skeleton: the
poll feature is **not built yet**. Stack: PHP 8.3, Livewire v4, Tailwind v4
(Vite), SQLite.

## Commands

```bash
composer setup          # first-time: install, .env, key, migrate, npm build
composer dev            # run everything: php serve + queue + pail logs + vite (concurrently)
composer test           # clears config, then artisan test
php artisan test --filter=SomeTest   # single test
./vendor/bin/pint       # format / lint (Laravel Pint)
php artisan make:livewire PollName   # scaffold a Livewire component
```

There is no `npm run test`. Tests are PHPUnit (`tests/Unit`, `tests/Feature`),
run through `artisan test`. Test DB is in-memory SQLite (see `phpunit.xml`).

## Architecture notes

- **Livewire 4**: components live in `app/Livewire/` with Blade views in
  `resources/views/livewire/`. Neither exists yet — `make:livewire` creates them.
  Livewire is the primary UI layer; prefer full-stack Livewire components over
  controllers + JS for interactive poll behavior (vote, live counts).
- **Layout**: `resources/views/app.blade.php` is the intended layout and defines
  Tailwind `.btn` / `label` / `input` / `.error` component classes inline. Note
  it currently pulls Tailwind from a **CDN `<script>`** even though Tailwind v4
  is also wired through Vite (`vite.config`, `package.json`) — pick one before
  building UI; the Vite path is the real build.
- **Routing mismatch**: `routes/web.php` `/` returns `view('welcome')`, but only
  `app.blade.php` exists (no `welcome.blade.php`). This route will 500 until a
  view is added or the route is pointed at a real view/Livewire component.
- **Database**: SQLite at `database/database.sqlite`. Only Laravel's default
  migrations exist (users, cache, jobs). Poll/vote tables and models still need
  creating.
- **Queue + logs**: `composer dev` runs a queue listener and `pail` log tailer,
  so background jobs and real-time log viewing work out of the box in dev.

## Conventions

- Format with Pint before committing.
- Livewire v4 syntax/APIs differ from v3 — verify against v4 docs when unsure.
