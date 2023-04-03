<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\GetPopularWords;
use Illuminate\View\View;

final class DashboardController extends Controller
{
    public function index(): View
    {
        $words = GetPopularWords::run();

        return view('dashboard', [
            'words' => $words,
        ]);
    }
}
