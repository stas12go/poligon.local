<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Список категорий') }}
        </h2>
    </x-slot>

    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" href="#">Редактирование</a>
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
                    <input type="text" class="form-control" id="categoryTitle" value="{{ $category->title }}" required
                        name="title">
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
                        {{-- <option selected disabled>Open this select menu</option> --}}
                        @foreach ($categoriesList as $categoryOption)
                            <option value="{{ $categoryOption->id }}" @if ($categoryOption->id === $category->parent_id) selected @endif>
                                {{ $categoryOption->title }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="parentCategory" class="form-label">Создана</label>
                    <input class="form-control" type="text" value="{{ $category->created_at }}"
                        aria-label="Disabled input example" disabled readonly>
                </div>

                <div class="mb-3">
                    <label for="parentCategory" class="form-label">Обновлена</label>
                    <input class="form-control" type="text"
                        value="{{ $category->updated_at ?? 'Ещё не обновлялась' }}"
                        aria-label="Disabled input example" disabled readonly>
                </div>

                <div class="mb-3 form-check" style="color: red;">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Удалить</label>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

</x-app-layout>
