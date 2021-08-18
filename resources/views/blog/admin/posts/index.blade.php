<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Список постов') }}
        </h2>
    </x-slot>

    <x-slot name="nav">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page"
                    href="{{ route('blog.admin.posts.create') }}">Написать</a>
            </li>
        </ul>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Автор</th>
                                    <th>Категория</th>
                                    <th>Заголовок</th>
                                    <th>Дата публикации</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    /** @var App\Models\BlogPost $post */
                                @endphp
                                @foreach ($paginator as $post)
                                    <tr @if (!$post->is_published) style="background-color: #ccc;" @endif>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>{{ $post->category->title }}</td>
                                        <td><a href="{{ route('blog.admin.posts.edit', $post->id) }}">
                                                {{ $post->title }}
                                            </a>
                                        </td>
                                        <td>{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d M H:i') : '' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    {{ $paginator->links() }}
</x-app-layout>
