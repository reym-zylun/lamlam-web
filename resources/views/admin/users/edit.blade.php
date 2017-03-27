<div id="edit-user-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">User Detail</h4>
            </div>
            <div class="modal-body">
                 <form class="form-horizontal">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" id="_token"/>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Name</label>
                        <div class="col-xs-9">
                            <input type="text" autocomplete="off" class="form-control" name="name" id="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Email Address</label>
                        <div class="col-xs-9">
                            <input type="text" autocomplete="off" class="form-control" name="email" id="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Email Address (confirmation)</label>
                        <div class="col-xs-9">
                            <input type="text" autocomplete="off" class="form-control" name="email_confirm" id="email_confirm">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Password</label>
                        <div class="col-xs-9">
                            <input type="password" autocomplete="off" class="form-control" name="password" id="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Password (confirmation)</label>
                        <div class="col-xs-9">
                            <input type="password" autocomplete="off" class="form-control" name="password_confirm" id="password_confirm">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="subscribe" class="control-label col-xs-3">Subscribe News</label>
                        <div class="col-xs-9">
                            <input type="checkbox" id="subscribe" name="email_magazine_subscribed">
                        </div>
                    </div>


                    <div class="form-group">
                      <div class="col-xs-12">
                          <div><button type="submit" class="btn btn-success pull-right" id="edit_user">Edit</button></div>
                      </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
