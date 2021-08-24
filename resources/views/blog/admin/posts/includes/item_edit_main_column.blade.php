<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="nav-main-tab" data-toggle="tab" href="#nav-main" role="tab"
                        aria-controls="nav-main" aria-selected="true">Основные</a>
                    <a class="nav-link" id="nav-additional-tab" data-toggle="tab" href="#nav-additional" role="tab"
                        aria-controls="nav-additional" aria-selected="false">Дополнительные</a>
                </div>
            </div>

            <div class="card-body">
                <h5 class="card-title">Редактирование {{ $post->is_published ? 'публикации' : 'черновика' }}</h5>

                @if ($post->exists)
                    <form action="{{ route('blog.admin.posts.update', $post->id) }}" method="POST">
                        @method('PATCH')
                    @else
                        <form action="{{ route('blog.admin.posts.store', $post->id) }}" method="POST">
                @endif
                @csrf

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-main" role="tabpanel" aria-labelledby="nav-main-tab">
                        <div class="mb-3">
                            <label for="postTitle" class="form-label">Заголовок</label>
                            <input type="text" class="form-control" id="postTitle" value="{{ $post->title }}"
                                name="title">
                        </div>
                        <div class="mb-3">
                            <label for="postText" class="form-label">Текст</label>
                            <textarea class="form-control" name="content_raw" id="postText" cols="30"
                                rows="10">{{ $post->content_raw }}</textarea>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-additional" role="tabpanel" aria-labelledby="nav-additional-tab">
                        <div class="mb-3">
                            <label for="postSlug" class="form-label">Идентификатор</label>
                            <input type="text" class="form-control" id="postSlug" value="{{ $post->slug }}"
                                name="slug">
                        </div>

                        <div class="mb-3">
                            <label for="postCategory" class="form-label">Категория</label>
                            <select class="form-control" id="postCategory" aria-label="Default select example"
                                name="category_id">
                                @foreach ($categoriesList as $categoryOption)
                                    <option value="{{ $categoryOption->id }}" @if ($categoryOption->id === $post->category_id) selected @endif>
                                        {{ $categoryOption->id_title }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="hidden" class="form-check-input" id="publishCheck" name="is_published" value="0">
                    <input type="checkbox" class="form-check-input" id="publishCheck" name="is_published" value="1"
                        @if ($post->is_published) {
                    checked = 'checked';
                    }
                    @endif
                    <label class="form-check-label" for="publishCheck">Опубликовать</label>
                </div>

                <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
                <hr>
                @if ($post->exists)
                    <form action="{{ route('blog.admin.posts.destroy', $post->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
