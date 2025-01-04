<style>
    .pagination2-outer{ text-align: center; }
    .pagination2{
        font-family: 'Raleway', sans-serif;
        display: inline-flex;
        position: relative;
    }
    .pagination2 li a.page-link2{
        color: #6E7EC7FF;
        background: transparent;
        font-size: 15px;
        font-weight: 700;
        text-align: center;
        line-height: 28px;
        height: 30px;
        width: 30px;
        padding: 0;
        margin: 0 4px;
        border: none;
        border-radius: 0;
        display: block;
        position: relative;
        z-index: 0;
        transition: all 0.5s ease 0s;
    }
    .pagination2 li:first-child a.page-link2,
    .pagination2 li:last-child a.page-link2{
        font-size: 23px;
        line-height: 27px;
    }
    .pagination2 li a.page-link2:hover,
    .pagination2 li a.page-link2:focus,
    .pagination2 li.active a.page-link2:hover,
    .pagination2 li.active a.page-link2{
        color: #fff;
        background: transparent;
    }
    .pagination2 li a.page-link2:before,
    .pagination2 li a.page-link2:after{
        content: '';
        height: 100%;
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 4px;
        opacity: 1;
        position: absolute;
        right: 0;
        bottom: 0;
        z-index: -1;
        transition: all 0.3s ease 0s;
    }
    .pagination2 li a.page-link2:after{
        border-radius: 0;
        background-color: #9FACE7FF;
        width: 0;
        border: none;
    }
    .pagination2 li a.page-link2:hover:before,
    .pagination2 li a.page-link2:focus:before,
    .pagination2 li.active a.page-link2:hover:before,
    .pagination2 li.active a.page-link2:before{
        transform: scaleY(1.4);
    }
    .pagination2 li a.page-link2:hover:after,
    .pagination2 li a.page-link2:focus:after,
    .pagination2 li.active a.page-link2:hover:after,
    .pagination2 li.active a.page-link2:after{
        width: 100%;
    }
    @media only screen and (max-width: 480px){
        .pagination2{
            font-size: 0;
            display: inline-block;
        }
        .pagination2 li{
            display: inline-block;
            vertical-align: top;
            margin: 0 0 15px;
        }
    }
</style>
<div class="demo">
    <nav class="pagination2-outer" aria-label="Page navigation">
        <ul class="pagination2">
            @if ($paginator->onFirstPage())
                <li disabled class="page-item"><a href="#" disabled class="page-link2"><span>«</span></a></li>
            @else
                <li class="page-item"><a href="{{ $paginator->previousPageUrl() }}" class="page-link2"><span>«</span></a></li>
            @endif
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link2">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><span class="page-link2">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a href="{{ $url }}" class="page-link2">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <li class="page-item"><a href="{{ $paginator->nextPageUrl() }}" class="page-link2"><span>»</span></a></li>
            @else
                <li disabled class="page-item"><a href="{{ $paginator->nextPageUrl() }}" disabled class="page-link2"><span>»</span></a></li>
            @endif
        </ul>
    </nav>
</div>
