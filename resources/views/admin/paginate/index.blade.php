@if ($paginator->hasPages())
    <table class="table">
        <tbody>
            <tr>
                <td>
                    @if ($paginator->onFirstPage())
                        <td><span>&laquo;</span></td>
                    @else
                        <td><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></td>
                    @endif
                </td>
                <td>
                    @if ($paginator->hasMorePages())
                        <td><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></td>
                    @else
                        <td class="disabled"><span>&raquo;</span></td>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
@endif
