<div id="passcode-register-modal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="deleteModal">Passcode Issue</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="passcode-register">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" id="_token" />
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="reg_ticket_id">Ticket</label>
                        <div class="col-xs-10">
                           <select id="reg_ticket_id" class="form-control" style="width:100%;"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="adult_num">Adult Num</label>
                        <div class="col-xs-5">
                           <input type="number" id="adult_num" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="child_num">Child Num</label>
                        <div class="col-xs-5">
                           <input type="number" id="child_num" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="issue_num">The number of issued</label>
                        <div class="col-xs-5">
                           <input type="number" id="issue_num" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <button type="button" class="btn btn-success pull-right" id="btnIssue">Issue</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

