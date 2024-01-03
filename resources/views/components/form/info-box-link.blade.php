
<div class="col-lg-3 col-md-6 col-xs-6">
    <a href="{{isset($link) ? $link : "#"}}">
        <div class="info-box">
            <span class="info-box-icon {{$bgClass}}"><i class="{{$icon}}"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"> {{$title}}</span>
                <span class="info-box-number">{{$description}}</span>
            </div>
        </div>
    </a>
</div>

