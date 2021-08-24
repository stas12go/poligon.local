<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                        aria-controls="nav-home" aria-selected="true">Основные</a>
                    <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                        aria-controls="nav-profile" aria-selected="false">Дополнительные</a>
                </div>
            </div>

            <div class="card-body">
                <h5 class="card-title">Редактирование {{ $post->is_published ? 'публикации' : 'черновика' }}</h5>

                @if ($post->exists)
                    <form action="{{ route('blog.admin.categories.update', $post->id) }}" method="POST">
                        @method('PATCH')
                    @else
                        <form action="{{ route('blog.admin.categories.store', $post->id) }}" method="POST">
                @endif
                @csrf

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="mb-3">
                            <label for="categoryTitle" class="form-label">Заголовок</label>
                            <input type="text" class="form-control" id="categoryTitle" value="{{ $post->title }}"
                                required name="title">
                        </div>
                        <div class="mb-3">
                            <label for="categoryTitle" class="form-label">Текст</label>
                            <textarea class="form-control" name="title" id="categoryTitle" cols="30"
                                rows="10">{{ $post->content_raw }}</textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="mb-3">
                            <label for="parentCategory" class="form-label">Категория</label>
                            <select class="form-control" id="parentCategory" aria-label="Default select example"
                                name="parent_id">
                                @foreach ($categoriesList as $categoryOption)
                                    <option value="{{ $categoryOption->id }}" @if ($categoryOption->id === $post->category_id) selected @endif>
                                        {{ $categoryOption->id_title }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="publishCheck" name="publishCheckbox">
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
