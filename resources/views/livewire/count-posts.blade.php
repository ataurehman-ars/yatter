

<div class="">

    @php 
        $count = $count_posts ? ((int)$count_posts === 1 ? '' : 's') : 's';
    @endphp 

    <p class="text-center font-bold text-gray-800">
        <i class="fas fa-pen count"></i>
        {{ $count_posts . __(' post') . $count }}
    </p>
</div>



