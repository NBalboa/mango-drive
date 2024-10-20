@props(['total', 'color', 'title'])

<div class="col-lg-3 col-6">
    <div class="small-box {{ $color }}">
        <div class="inner">
            <h3>{{ $total }}</h3>
            <p>{{ $title }}</p>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
