<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFAQRequest;
use App\Models\FAQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FAQController extends Controller
{
    public function index(Request $request)
    {
        $successMessage = Session::get('success');
        $errorMessage = Session::get('error');

        $search = $request->input('search');
        $query = FAQ::orderBy('id', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('question', 'like', '%' . $search . '%')
                    ->orWhere('answer', 'like', '%' . $search . '%');
            });
        }

        $faqs = $query->paginate(4);
        return view('admin.faqs.index', compact('faqs', 'successMessage', 'errorMessage', 'search'));
    }


    public function create()
    {
        return view('admin.faqs.create');
    }


    public function store(StoreFAQRequest $request)
    {
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            FAQ::create($validated);
        });
        Session::flash('success', 'FAQ has been created successfully');
        return redirect()->route('admin.faqs.index');
    }


    public function show(FAQ $fAQ)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FAQ $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }


    public function update(StoreFAQRequest $request, FAQ $faq)
    {
        DB::transaction(function () use ($request, $faq) {
            $validated = $request->validated();
            $faq->update($validated);
        });
        Session::flash('success', 'FAQ has been updated successfully');
        return redirect()->route('admin.faqs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FAQ $faq)
    {
        try {
            DB::transaction(function () use ($faq) {
                $faq->delete();
            });

            Session::flash('success', 'FAQ has been deleted successfully');
            return redirect()->route('admin.faqs.index');
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect()->route('admin.faqs.index');
        }
    }
}
