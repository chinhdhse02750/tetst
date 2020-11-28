@if ($paginator->hasPages())
    <nav class="shop-pagination">
        <ul>
            @if ($paginator->onFirstPage())
                <li class="disabled">
                    <button class="no-round-btn smooth">
                        <i class="arrow_carrot-2left"></i>
                    </button>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <button class="no-round-btn smooth">
                            <i class="arrow_carrot-2left"></i>
                        </button>
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <button class="no-round-btn smooth active"><span>{{ $page }}</span></button>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}">
                                    <button class="no-round-btn smooth"><span>{{ $page }}</span></button>
                                </a>
                            </li>

                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="prev">
                        <button class="no-round-btn smooth">
                            <i class="arrow_carrot-2right"></i>
                        </button>
                    </a>
                </li>
            @else
                <li class="disabled">
                    <button class="no-round-btn smooth">
                        <i class="arrow_carrot-2right"></i>
                    </button>
                </li>
            @endif
        </ul>
    </nav>
@endif