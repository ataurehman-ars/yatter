
<x-main-header />


    <x-app-layout>
        @livewire('show-shared-posts' , [ 'author_id' => $author_id  ])
    </x-app-layout>

<x-main-footer />

<x-message-listener />
