<div class="row">
    @foreach ($images as $item)
        <div class="col-lg-12">
            <a href="{{ url('storage/' . $item->image) }}" target="blank"><img
                    src="{{ url('storage/' . $item->image) }}" width="100%"></a>
        </div>
    @endforeach
</div>
