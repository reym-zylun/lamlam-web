<div id="view-information-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Information Detail</h4>
            </div>
            <div class="modal-body">
                 <form class="form-horizontal">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" id="_token"/>
                    <div class="form-group">
                        <label class="control-label col-xs-2">Comment (en)</label>
                        <div class="col-xs-10">
                            <textarea class="form-control" style="resize:none" rows="5" name="comment_en" id="comment_en"></textarea >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">Comment (ja)</label>
                        <div class="col-xs-10">
                            <textarea class="form-control" style="resize:none" rows="5" name="comment_ja" id="comment_ja"></textarea >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="open_date" class="control-label col-xs-2">Open Date</label>
                        <div class="col-xs-10">
                            <input type="text" autocomplete="off" class="form-control" readonly style="background-color:#fff" name="open_date" id="open_date">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="close_date" class="control-label col-xs-2">Close Date</label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control" name="close_date" readonly style="background-color:#fff"  id="close_date">
                        </div>
                    </div>

                    <div class="form-group">
                      <div class="col-xs-12">
                          <div><button type="submit" class="btn btn-success pull-right" id="edit_information">Edit</button></div>
                          <div><button  class="btn btn-danger pull-right" id="delete_information">Delete</a></div>                      
                      </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- script -->
<script type="text/javascript">
    $('#open_date, #close_date').datetimepicker({
        timeFormat: "HH:mm:ss",
        dateFormat: "yy-mm-dd"
    });
</script>
