<div class="row h-100">
    <div class="col-md-12">
        <p class="h5">Общая информация</p>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">ID: {{ $post->id }}</li>
            <li class="list-group-item">Автор: {{ $post->user_id }}</li>
        </ul>
    </div>
    <br>
    <div class="col-md-12 align-self-end">
        <p class="h5">Ключевые даты</p>
        <ul class="list-group list-group-flush">
            <!-- TODO отформатировать дату -->
            <li class="list-group-item">Создание: {{ $post->created_at }}</li>
            <li class="list-group-item">Обновление: {{ $post->updated_at ?? 'Ещё не обновлялась' }}</li>
            <li class="list-group-item">Публикация: {{ $post->published_at ?? 'Не опубликована' }}</li>
            <li class="list-group-item">Удаление: {{ $post->deleted_at ?? 'Не удалена' }}</li>
        </ul>
    </div>
</div>
