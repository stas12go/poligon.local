<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Blog\BaseController;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Http\Request;
use Str;

// use App\Models\BlogCategory;

/**
 * Управление категориями блога
 * 
 * @package App\Http\Controllers\Blog\Admin
 */
class CategoryController extends BaseController
{
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $paginator = BlogCategory::paginate(15);
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(5);

        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new BlogCategory();
        $categoriesList = $this->blogCategoryRepository->getForCombobox();

        return view('blog.admin.categories.edit', compact('category', 'categoriesList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input();

        /* Ушло в обсервер
        if (!$data['slug']) {
            $data['slug'] = Str::slug($data['title']);
        }
        */

        $category = (new BlogCategory())->create($data);

        if ($category) {
            return redirect()
                ->route('blog.admin.categories.edit', [$category->id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }

        // dd($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, BlogCategoryRepository $categoryRepository)
    {
        // $category = BlogCategory::findOrFail($id);
        // $categoriesList = BlogCategory::all();

        $category = $this->blogCategoryRepository->getEdit($id);
        if (!$category) {
            abort(404);
        }
        $categoriesList = $this->blogCategoryRepository->getForCombobox();

        return view('blog.admin.categories.edit', compact('category', 'categoriesList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BlogCategoryUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        /*$rules = [
            'title' => 'required|min:5|max:80',
            'slug' => 'max:100',
            'parent_id' => 'required|integer|exists:blog_categories,id',
        ];
        $validatedData = $this->validate($request, $rules);*/

        $category = $this->blogCategoryRepository->getEdit($id);

        if (!$category) {
            return back()
                ->withErrors(['msg' => "Запись id = [{$id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();

        /* Ушло в обсервер
        if (!$data['slug']) {
            $data['slug'] = Str::slug($data['title']);
        }
        */

        $result = $category->update($data);

        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', [$category->id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }
}
