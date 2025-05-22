<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $faqs = Faq::orderBy('id', 'desc')->paginate(25);
        $total = $faqs->total();

        return view('admin-views.faq.index', [
            'faqs' => $faqs,
            'total' => $total,
        ]);
    }

    public function create(Request $request)
    {
        return view('admin-views.faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|array',
            'question.*' => 'required|string',
            'answer' => 'required|array',
            'answer.*' => 'required|string',
        ]);

        try {
            foreach ($request->question as $index => $question) {
                $faq = new Faq();
                $faq->question = $question;
                $faq->answer = $request->answer[$index];
                $faq->slug = Str::slug(Str::limit($question, 50));
                $faq->is_active = $request->is_active[$index] ?? 'Y';
                $faq->save();
            }

            Toastr::success('FAQs have been added successfully');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong. Try again.');
            return back();
        }

        return redirect()->route('admin.faq.index');
    }


    public function edit(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin-views.faq.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        try {
            $faq = Faq::findOrFail($id);
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->slug = Str::slug(Str::limit($request->question, 50));
            $faq->is_active = $request->is_active ?? 'Y';
            $faq->save();

            Toastr::success('FAQ has been updated successfully');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong. Try again.');
            return back();
        }

        return redirect()->route('admin.faq.index');
    }

    // public function destroy($id)
    // {
    //     try {
    //         Faq::findOrFail($id)->delete();
    //         Toastr::success('FAQ has been deleted successfully');
    //     } catch (\Exception $e) {
    //         Toastr::error('Something went wrong.');
    //     }

    //     return back();
    // }
}
