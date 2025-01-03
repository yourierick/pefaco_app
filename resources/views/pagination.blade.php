<style>
    .pagination-outer{ text-align: center; }
    .pagination{
        font-family: 'Raleway', sans-serif;
        display: inline-flex;
        position: relative;
    }
    .pagination li a.page-link{
        color: #0D31D1FF;
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
    .pagination li:first-child a.page-link,
    .pagination li:last-child a.page-link{
        font-size: 23px;
        line-height: 27px;
    }
    .pagination li a.page-link:hover,
    .pagination li a.page-link:focus,
    .pagination li.active a.page-link:hover,
    .pagination li.active a.page-link{
        color: #fff;
        background: transparent;
    }
    .pagination li a.page-link:before,
    .pagination li a.page-link:after{
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
    .pagination li a.page-link:after{
        border-radius: 0;
        background-color: #0D31D1FF;
        width: 0;
        border: none;
    }
    .pagination li a.page-link:hover:before,
    .pagination li a.page-link:focus:before,
    .pagination li.active a.page-link:hover:before,
    .pagination li.active a.page-link:before{
        transform: scaleY(1.4);
    }
    .pagination li a.page-link:hover:after,
    .pagination li a.page-link:focus:after,
    .pagination li.active a.page-link:hover:after,
    .pagination li.active a.page-link:after{
        width: 100%;
    }
    @media only screen and (max-width: 480px){
        .pagination{
            font-size: 0;
            display: inline-block;
        }
        .pagination li{
            display: inline-block;
            vertical-align: top;
            margin: 0 0 15px;
        }
    }
</style>
<div class="demo">
    <nav class="pagination-outer" aria-label="Page navigation">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li disabled class="page-item"><a href="#" disabled class="page-link" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
            @else
                <li class="page-item"><a href="{{ $paginator->previousPageUrl() }}" class="page-link" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
            @endif
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <li class="page-item"><a href="{{ $paginator->nextPageUrl() }}" class="page-link" aria-label="Next"><span aria-hidden="true">»</span></a></li>
            @else
                <li disabled class="page-item"><a href="{{ $paginator->nextPageUrl() }}" disabled class="page-link" aria-label="Next"><span aria-hidden="true">»</span></a></li>
            @endif
        </ul>
    </nav>
</div>
