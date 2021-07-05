

<x-app-layout>
    @livewire('new-post' , ['authId' => Auth::id() ])
    @livewire('get-posts' , ['authId' => Auth::id() ])
</x-app-layout>


