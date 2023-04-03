<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\GetPopularWords;

final class DashboardController extends Controller
{
    public function index()
    {
        $words = GetPopularWords::run();

        return view('dashboard', [
            'words' => $words,
        ]);
    }
}
