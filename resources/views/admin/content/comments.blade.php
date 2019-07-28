@foreach ($comment as $item)
    <div class="comment_box" data-id="{{ $item['id'] }}">
        <div class="bd-callout-info comment">
            <div class="user_info">
                <span class="name">{{ $item['full_name'] }}</span>
            </div>
            <div class="message">{{ $item['message'] }}</div>
            <div class="tools">
                <div class="drop">
                    <a href="{{ route("admin.comment_drop",$item['id']) }}">Удалить</a>
                </div>
                <div class="redact">
                    Редактировать
                </div>
            </div>
        </div>
    </div>
    @isset($item['subcategory'])
        @include('admin/content/sub',["item" => $item['subcategory']])
    @endisset
@endforeach
<script>
    handel.answer();
    handel.redact();
</script>
