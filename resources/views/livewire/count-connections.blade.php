

<div class="">

    @php 
        $count = $count_connections ? ((int)$count_connections === 1 ? '' : 's') : 's';
    @endphp 

    <p class="text-center font-bold text-gray-800">
        <i class="fas fa-user-friends count"></i>
        {{ $count_connections . __(' connection') . $count }}
    </p>
</div>



