<style>
    .breadcrumbs {
        border: 1px solid #cbd2d9;
        border-radius: 0.3rem;
        display: inline-flex;
        overflow: hidden;
    }

    .breadcrumbs__item {
        background: #fff;
        color: #333;
        outline: none;
        padding: 0.10em 0.25em 0.10em 1.25em;
        position: relative;
        text-decoration: none;
        transition: background 0.2s linear;
    }

    .breadcrumbs__item:hover:after,
    .breadcrumbs__item:hover {
        background: #edf1f5;
    }

    .breadcrumbs__item:focus:after,
    .breadcrumbs__item:focus,
    .breadcrumbs__item.is-active:focus {
        background: #323f4a;
        color: #fff;
    }

    .breadcrumbs__item:after,
    .breadcrumbs__item:before {
        background: white;
        bottom: 0;
        clip-path: polygon(50% 50%, -50% -50%, 0 100%);
        content: "";
        left: 100%;
        position: absolute;
        top: 0;
        transition: background 0.2s linear;
        width: 1em;
        z-index: 1;
    }

    .breadcrumbs__item:before {
        background: #cbd2d9;
        margin-left: 1px;
    }

    .breadcrumbs__item:last-child {
        border-right: none;
    }

    .breadcrumbs__item.is-active {
        background: #edf1f5;
    }
</style>

<nav class="breadcrumbs">
    @foreach($breadcrumbs as $breadcrumb)
    @if(!$loop->last)
    <a href="{{ $breadcrumb['url'] }}" class="breadcrumbs__item"><span class="{{ $breadcrumb['icon'] }}"></span> {{
        $breadcrumb['label'] }}</a>
    @else
    <a disabled class="breadcrumbs__item is-active"><span class="{{ $breadcrumb['icon'] }}"></span> {{
        $breadcrumb['label'] }}</a>
    @endif
    @endforeach
</nav>