@foreach ($item as $sub)
    <div style="margin-left:{{ 20 * $sub['level'] }}px;" class="comment_box sub" data-id="{{ $sub['id'] }}">
        <div class="bd-callout-info comment">
            <div class="user_info">
                <span class="name">{{ $sub['full_name'] }}</span>
            </div>
            <div class="message">{{ $sub['message'] }}</div>
            @auth
                <div class="tools">
                    <div class="answer">
                        Ответить
                    </div>
                    @if ($sub['user_id'] == $user_id)
                        <div class="redact">
                            Редактировать
                        </div>
                    @endif
                </div>
            @endauth
        </div>
    </div>
    @isset($sub['subcategory'])
        @include('content/sub', ["item" => $sub['subcategory']])
    @endisset
@endforeach
