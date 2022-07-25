<x-layout.header>
    <x-slot name="title">List</x-slot>
    <x-slot name="main_content">
        <x-list.All_List :columns="$columns" :values="$values" :urls="$urls"/>
    </x-slot>
</x-layout.header>