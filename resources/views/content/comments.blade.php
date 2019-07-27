@foreach ($comment as $item)
    <div class="comment_box" data-id="{{ $item['id'] }}">
        <div class="bd-callout-info comment">
            <div class="user_info">
                <span class="name">{{ $item['full_name'] }}</span>
            </div>
            <div class="message">{{ $item['message'] }}</div>
            @auth
            <div class="tools">
                <div class="answer">
                    Ответить
                </div>
                @if ($item['user_id'] == $user_id)
                    <div class="redact">
                        Редактировать
                    </div>
                @endif
            </div>
            @endauth
        </div>
    </div>
    @isset($item['subcategory'])
        @include('content/sub',["item" => $item['subcategory']])
    @endisset
@endforeach
<script>
    handel.answer();
    handel.redact();
</script>
