<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Список категорий') }}
        </h2>
    </x-slot>

    <x-slot name="nav">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page"
                    href="{{ route('blog.admin.categories.create') }}">Добавить</a>
            </li>
        </ul>
    </x-slot>

    <table class="table table-hover table-bordered" style="margin-bottom: 0;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Категория</th>
                <th scope="col">Родитель</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paginator as $item)
                @php
                    /** @var \App\Models\BlogCategory $item */
                @endphp

                <tr>
                    <td>{{ $item->id }}</td>
                    <td>
                        <a href="{{ route('blog.admin.categories.edit', $item->id) }} ">
                            {{ $item->title }}
                        </a>
                    </td>
                    <td @if (in_array($item->parent_id, [0, 1])) style="color: rgb(130,130,130);" @endif>
                        {{ $item->parent_id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
    {{ $paginator->links() }}
</x-app-layout>
