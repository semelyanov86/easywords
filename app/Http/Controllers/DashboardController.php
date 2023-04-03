<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Actions\GetPopularWords;

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
