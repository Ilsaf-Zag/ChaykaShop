<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Faq;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Inertia\Inertia;


class FaqController extends Controller
{
    public function index()
    {

        $faqs = Faq::all();

        return Inertia::render('Users/FaqView',compact('faqs'));
    }
}
