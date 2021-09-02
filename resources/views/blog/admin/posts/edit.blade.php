<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Список статей') }}
        </h2>
    </x-slot>

    <x-slot name="scripts">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
        </script>
    </x-slot>

    <div class="container">
        @php
            /** @var Illuminate\Support\ViewErrorBag $errors */
        @endphp

        @include('blog.admin.posts.includes.result_msg')

        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('blog.admin.posts.includes.item_edit_main_column')
            </div>
            @if ($post->exists)
                <div class="col-md-4">
                    @include('blog.admin.posts.includes.item_edit_add_column')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
