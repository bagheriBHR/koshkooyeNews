<div class="text-right">
    @if ($errors->any())
    <div class="alert mb-0 py-0">
        <ul class="pr-2 m-0">
            @foreach ($errors->all() as $error)
                 <li class="text-danger" style="list-style: disc;font-size: 0.8rem !important;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <br />
    @endif
</div>
