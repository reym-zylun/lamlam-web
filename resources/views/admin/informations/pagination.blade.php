<?php $link_limit = 11; ?>

    <ul class="pagination">
        @if(($pagination->current_page - 1) != null)
            <li>
                <a href="{{ route('admin.informations',array_merge($prev_search, ['page'=>($pagination->current_page - 1)])) }}">&laquo;</a>
            </li>
        @else
            <li class="disabled"><a>&laquo;</a></li>
        @endif

        @for($i = 1; $i <= $pagination->last_page; $i++)
            <?php
            $half_total_links = floor($link_limit / 2);
            $from = $pagination->current_page - $half_total_links;
            $to = $pagination->current_page + $half_total_links;
            if($pagination->current_page < $half_total_links) {
               $to += $half_total_links - $pagination->current_page;
            }
            if($pagination->last_page - $pagination->current_page < $half_total_links) {
                $from -= $half_total_links - ($pagination->last_page - $pagination->current_page) - 1;
            }
            ?>
            @if($from < $i && $i < $to)
                <li class="{{ $pagination->current_page == $i ? 'active' : false}}">
                    <a href="{{route('admin.informations',array_merge($prev_search, ['page'=>$i]))}}">{{$i}}</a>
                </li>
            @endif
        @endfor
        
        @if(($pagination->current_page + 1) <= $pagination->last_page)
            <li><a href="{{ route('admin.informations',array_merge($prev_search, ['page'=>($pagination->current_page + 1)])) }}">&raquo;</a></li>
        @else
            <li class="disabled"><a>&raquo;</a></li>
        @endif
    </ul>