<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Список категорий') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('blog.admin.category.includes.item_edit_main_column')
            </div>
            <div class="col-md-4">
                @include('blog.admin.category.includes.item_edit_add_column')

            </div>
        </div>
    </div>
</x-app-layout>
