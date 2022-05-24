<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Throwable;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryStoreRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return to_route('category.index')->with('status', 'Categorie aangemaakt');
    }

    /**
     * Display the specified resource.
     *
     * @param  Category  $category
     * @return View
     */
    public function show(Category $category): View
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category  $category
     * @return Response
     */
    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryUpdateRequest  $request
     * @param  Category  $category
     * @return RedirectResponse
     */
    public function update(CategoryUpdateRequest $request, Category $category): RedirectResponse
    {
        $category->name = $request->name;
        $category->save();

        return to_route('category.index')->with('status', 'Categorie gewijzigd');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category  $category
     * @return View
     */
    public function delete(Category $category): View
    {
        return view('admin.categories.delete', compact('category'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category  $category
     * @return RedirectResponse
     */
    public function destroy(Category $category):RedirectResponse
    {
        try{
            $category->delete();
        }catch (Throwable $error)
        {
            report($error);
            return to_route('category.index')->with('status', 'Categorie is niet leeg.
            Er mogen geen producten meer in de categorie staan wanneer deze verwijderd wordt.');
        }
        return to_route('category.index')->with('status', 'Categorie verwijderd');
    }
}
