@if ($category->exists)
    <div class="row h-100">
        <div class="col-md-12">
            <p class="h5">Общая информация</p>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">ID: {{ $category->id }}</li>
            </ul>
        </div>
        <br>
        <div class="col-md-12 align-self-end">
            <p class="h5">Ключевые даты</p>
            <ul class="list-group list-group-flush">
                <!-- TODO отформатировать дату -->
                <li class="list-group-item">Создана: {{ $category->created_at }}</li>
                <li class="list-group-item">Обновлена: {{ $category->updated_at ?? 'Ещё не обновлялась' }}</li>
                <li class="list-group-item">Удалена: {{ $category->deleted_at ?? 'Не удалена' }}</li>
            </ul>
        </div>
    </div>
@endif
