<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index()
    {
        $successMessage = Session::get('success');
        $errorMessage = Session::get('error');
        $categories = Category::orderByDesc('id')->get();
        return view('admin.categories.index', compact(
            'categories',
            'successMessage',
            'errorMessage'
        ));
    }


    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(StoreCategoryRequest $request)
    {
        DB::transaction(function () use ($request) {

            $validated = $request->validated();

            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('icons', 'public');
                $validated['icon'] = $iconPath;
            } else {
                $iconPath = 'images/icon-default.png';
            }

            $validated['slug'] = Str::slug($validated['name']);

            $category = Category::create($validated);
        });
        Session::flash('success', 'Category has been created successfully');
        return redirect()->route('admin.categories.index');
    }

    public function show(Category $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        DB::transaction(function () use ($request, $category) {

            $validated = $request->validated();

            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('icons', 'public');
                $validated['icon'] = $iconPath;
            }

            $validated['slug'] = Str::slug($validated['name']);

            $category->update($validated);
        });
        Session::flash('success', 'Category has been updated successfully');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        DB::beginTransaction();
        try {
            $category->delete();
            DB::commit();
            Session::flash('success', 'Category has been deleted successfully');
            return redirect()->route('admin.categories.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'System error! ' . $e->getMessage());
            return redirect()->route('admin.categories.index');
        }
    }
}
