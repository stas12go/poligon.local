<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Blog\BaseController;
use App\Http\Requests\BlogPostCreateRequest;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Models\BlogPost;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogPostRepository;

/**
 * PostController
 */
class PostController extends BaseController
{
    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;

    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    /**
     * PostController constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->blogPostRepository->getAllWithPaginate();

        return view('blog.admin.posts.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new BlogPost();
        $categoriesList = $this->blogCategoryRepository->getForCombobox();

        return view('blog.admin.posts.edit', compact('post', 'categoriesList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BlogPostCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogPostCreateRequest $request)
    {
        $data = $request->input();

        $post = (new BlogPost())->create($data);

        if ($post) {
            return redirect()
                ->route('blog.admin.posts.edit', [$post->id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd(__METHOD__, $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->blogPostRepository->getEdit($id);
        if (!$post) {
            abort(404);
        }
        $categoriesList = $this->blogCategoryRepository->getForCombobox();

        return view('blog.admin.posts.edit', compact('post', 'categoriesList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPostUpdateRequest $request, $id)
    {
        $post = $this->blogPostRepository->getEdit($id);

        if (empty($post)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена."])
                ->withInput();
        }

        $data = $request->all();

        /* Ушло в обсервер
        if (!$data['slug']) {
            $data['slug'] = Str::slug($data['title']);
        }

        if (!$post->published_at && $data['is_published']) {
            $data['published_at'] = Carbon::now();
        }
        */

        $result = $post->update($data);

        if (!$result) {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }

        return redirect()
            ->route('blog.admin.posts.edit', $post->id)
            ->with(['success' => 'Успешно сохранено']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd(__METHOD__, $id, request()->all());
    }
}
