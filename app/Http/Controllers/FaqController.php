<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function faqs(Request $request)
    {
        $faqs = Faq::where('is_active', 'Y')->get();
        return view('faqs', compact('faqs'));
    }
}