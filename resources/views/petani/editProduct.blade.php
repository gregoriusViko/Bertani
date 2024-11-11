<x-layout>
    <x-slot:title>Edit Produk-Bertani.com</x-slot:title>
    <div
        class="font-libre-franklin font-bold mx-auto max-w-7xl px-4 mt-5 mb-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <h1 class="text-xl md:text-3xl font-bold tracking-tight text-gray-900">Edit Produk</h1>

    </div>
    <x-product-form :mode="'edit'" />
</x-layout>