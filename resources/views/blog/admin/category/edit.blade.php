<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Список категорий') }}
        </h2>
    </x-slot>

    <div class="container">
        @php
            /** @var Illuminate\Support\ViewErrorBag $errors */
        @endphp

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif


        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('blog.admin.category.includes.item_edit_main_column')
            </div>
            @if ($category->exists)
                <div class="col-md-4">
                    @include('blog.admin.category.includes.item_edit_add_column')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
