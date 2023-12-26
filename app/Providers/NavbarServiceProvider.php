<?php

namespace App\Providers;

use App\Models\Announcement;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class NavbarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Using a view composer to share data with the navbar partial
        View::composer('layouts.partials.navbar', function ($view) {
            // Fetch the data
            $generated = Announcement::where('type', 'generated')->orderBy('updated_at', 'desc')->limit(7)->get();
            $created = Announcement::where('type', 'created')->orderBy('updated_at', 'desc')->limit(3)->get();
            $data = $generated->merge($created);

            // Pass the variable to the view
            $view->with('announcements', $data);
        });
    }
}
