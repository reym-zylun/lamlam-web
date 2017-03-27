<div id="use-ticket1" class="stack1 modal hide fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="modal-title">{{ trans('custom.title.my-ticket-use') }}</h2>
            </div>
            <div class="modal-body">
                <span>{{ ucfirst(trans('custom.adult')) }}:&nbsp;<strong id="use-adult"></strong></span><br />
                <span>{{ ucfirst(trans('custom.child')) }}:&nbsp;<strong id="use-child"></strong></span><br />
                <p>{{ trans('custom.use-confirm') }}</p>
                <div class="centerWrap">
                    <button type="button" class="useTicket-btn" data-toggle="modal">{{ trans('custom.use') }}</button>
                    <button type="button" class="closeTicket-btn" data-dismiss="modal" aria-hidden="true">{{ trans('custom.cancel') }}</button>
                </div>
                <form method="post" action="">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
    </div>
</div>

<div id="use-ticket2" class="stack2 modal hide fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">{{ trans('custom.title.my-ticket-use') }}</h2>
            </div>
            <div class="modal-body">
                <p>{{ trans('custom.use-complete') }}</p>
                <div class="centerWrap">
                    <button type="button" class="closeTicket-btn">{{ trans('custom.title.my-ticket-show') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$('#use-ticket1 .useTicket-btn').click(function(event) {
    $('#use-ticket1 form').submit();
});
$('#use-ticket1 form').submit(function(event) {
    // HTMLでの送信をキャンセル
    event.preventDefault();
    // 操作対象のフォーム要素を取得
    var $form = $(this);
    // 送信
    $.ajax({
        url: $form.attr('action'),
        type: $form.attr('method'),
        data: $form.serialize(),
        timeout: 10000,  // 単位はミリ秒
        // 送信前
        beforeSend: function(xhr, settings) {
            // ボタンを無効化し、二重送信を防止
            $('#use-ticket1 .useTicket-btn').attr('disabled', true);
        },
        // 応答後
        complete: function(xhr, textStatus) {
            // ボタンを有効化し、再送信を許可
            $('#use-ticket1 .useTicket-btn').attr('disabled', false);
        },
        // 通信成功時の処理
        success: function(data) {
            $("#use-ticket2 .closeTicket-btn").attr('data-id', data.user_ticket.id);
            $("#use-ticket2").modal({
                keyboard: false,
                backdrop: "static",
            });
        },
        // 通信失敗時の処理
        error: function(data) {
            var res = $.parseJSON(data.responseText);
            var alertMsg = "";
            $.each(res.errors, function(index, value) {
                alertMsg += value['0'];
            });
            alert(alertMsg);
        }
    });
});
$('#use-ticket2 .closeTicket-btn').click(function(event) {
    var id = $("#use-ticket2 .closeTicket-btn").attr('data-id');
    location.href = "/users/{{ $user_id }}/tickets/" + id;
})
</script>
