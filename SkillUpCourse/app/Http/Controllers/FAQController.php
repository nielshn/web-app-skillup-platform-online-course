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
    public function index()
    {
        
        $faqs = FAQ::orderBy('id', 'desc')->get();
        return view('admin.faq.index', compact('faqs'));
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
        Session::flash('success', 'Category has been created successfully');
        return redirect()->route('admin.faqs.index');
    }


    public function show(FAQ $fAQ)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FAQ $fAQ)
    {
        return view('admin.faqs.edit', compact('fAQ'));
    }


    public function update(Request $request, FAQ $fAQ)
    {
        DB::transaction(function () use ($request, $fAQ) {
            $validated = $request->validated();
            $fAQ->update($validated);
        });
        Session::flash('success', 'FAQ has been updated successfully');
        return redirect()->route('admin.faqs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FAQ $fAQ)
    {
        DB::transaction();
        try {
            $fAQ->delete();
            DB::commit();
            Session::flash('success', 'FAQ has been deleted successfully');
            return redirect()->route('admin.faqs.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('error', $th->getMessage());
            return redirect()->route('admin.faqs.index');
        }
    }
}
