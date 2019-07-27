@foreach ($item as $sub)
    <div style="margin-left:{{ 20 * $sub['level'] }}px;" class="comment_box sub" data-id="{{ $sub['id'] }}">
        <div class="bd-callout-info comment">
            <div class="user_info">
                <span class="name">{{ $sub['full_name'] }}</span>
            </div>
            <div class="message">{{ $sub['message'] }}</div>
            <div class="tools">
                <div class="drop">
                    <a href="{{ route("admin.comment_drop",$sub['id']) }}">Удалить</a>
                </div>
                <div class="redact">
                    Редактировать
                </div>
            </div>
        </div>
    </div>
    @isset($sub['subcategory'])
        @include('admin/content/sub', ["item" => $sub['subcategory']])
    @endisset
@endforeach
