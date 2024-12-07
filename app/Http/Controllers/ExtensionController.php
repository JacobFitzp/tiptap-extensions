<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class ExtensionController extends Controller
{
    public function submit(): Response
    {
        return Inertia::render('');
    }
}
