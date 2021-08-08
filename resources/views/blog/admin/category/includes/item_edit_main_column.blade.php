<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Редактирование</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <h5 class="card-title">Редактирование категории</h5>

                <form action="{{ route('blog.admin.categories.update', $category->id) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="mb-3">
                        <label for="categoryTitle" class="form-label">Название</label>
                        <input type="text" class="form-control" id="categoryTitle" value="{{ $category->title }}"
                            required name="title">
                    </div>
                    <div class="mb-3">
                        <label for="categorySlug" class="form-label">Ссылка</label>
                        <input type="text" class="form-control" id="categorySlug" value="{{ $category->slug }}"
                            name="slug">
                    </div>

                    <div class="mb-3">
                        <label for="parentCategory" class="form-label">Родитель</label>
                        <select class="form-control" id="parentCategory" aria-label="Default select example"
                            name="parent_id">
                            @foreach ($categoriesList as $categoryOption)
                                <option value="{{ $categoryOption->id }}" @if ($categoryOption->id === $category->parent_id) selected @endif>
                                    {{ $categoryOption->title }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 form-check" style="color: red;">
                        <input type="checkbox" class="form-check-input" id="deleteCheck" name="deleteCheckbox">
                        <label class="form-check-label" for="deleteCheck">Удалить</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
</div>
