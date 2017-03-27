<div id="split-ticket1" class="stack1 modal hide fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="modal-title">{{ trans('custom.title.my-ticket-split') }}</h2>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="width50">
                        <label for="adult">{{ ucfirst(trans('custom.adult')) }}</label>
                        <select id="adult" class="pure-u-23-24" name="adult_num">
                            <option>0</option>
                        </select>
                    </div>
                    <div class="width50">
                        <label for="children">{{ ucfirst(trans('custom.child')) }}</label>
                        <select id="children" class="pure-u-23-24" name="child_num">
                            <option>0</option>
                        </select>
                    </div>
                </form>
                <p>{{ trans('custom.split-confirm') }}</p>
                <div class="centerWrap">
                    <button type="button" class="division-btn" data-toggle="modal">{{ trans('custom.split') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="split-ticket2" class="stack2 modal hide fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">{{ trans('custom.title.my-ticket-split') }}</h2>
            </div>
            <div class="modal-body">
                <div class="confirmedNote">
                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                    <p>{{ trans('custom.split-complete') }}</p>
                    <span class="tixNoCode"></span>
                    <span class="tixNo">{{ trans('custom.ticket-no') }}</span>
                    <div class="centerWrap">
                        <button type="button" class="back-btn">{{ trans('custom.back') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$('#split-ticket1 .division-btn').click(function(event) {
    $('#split-ticket1 form').submit();
});
$('#split-ticket1 form').submit(function(event) {
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
            $('#split-ticket1 .division-btn').attr('disabled', true);
        },
        // 応答後
        complete: function(xhr, textStatus) {
            // ボタンを有効化し、再送信を許可
            $('#split-ticket1 .division-btn').attr('disabled', false);
        },
        // 通信成功時の処理
        success: function(data) {
            //var res = $.parseJSON(data.responseText);
            $("#split-ticket2 .tixNoCode").html(data.receive_key);
            $("#split-ticket2").modal({
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
$('#split-ticket2 .back-btn').click(function(event) {
    location.reload();
})
</script>
