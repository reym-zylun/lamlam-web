<div id="ticket-register-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="deleteModal">Register</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="ticket-register">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" id="_token" />
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="name_en">Name (en)</label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control" name="name_en" id="name_en">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="name_ja">Name (ja)</label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control" name="name_ja" id="name_ja">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="description_en">Description (en)</label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control" name="description_en" id="description_en">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="description_ja">Description (ja)</label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control" name="description_ja" id="description_ja">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="color">Color</label>
                        <div class="col-xs-10">
                            <select class="form-control" name="color" id="color">
                                @foreach(config('define.colors') as $color)
                                    <option value="{{$color}}">{{ucfirst($color)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- file here -->
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="adult_price">Image</label>
                        <div class="col-xs-10">
                            <input type="file" class="form-input" name="image_file" id="image_file" accept="image/*">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-2" for="adult_price">Adult Price</label>
                        <div class="col-xs-10">
                            <input type="number" step="any" class="form-control" min="0" name="adult_price" id="adult_price">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="child_price">Child Price</label>
                        <div class="col-xs-10">
                            <input type="number" step="any" class="form-control" min="0" name="child_price" id="child_price">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="type">Type</label>
                        <div class="col-xs-3">
                            <label class="radio-inline" for="type_day">
                              <input type="radio" name="type" id="type_day" value="day" checked>Day
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="type" id="type_time" value="time">Time
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="duration">Duration</label>
                        <div class="col-xs-4">
                            <input type="number" class="form-control" min="0" name="duration" id="duration">
                        </div>
                        <label class="control-label" id="lbl_type"></label>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-3">
                            <label for="recommended">
                                <span>Recommended</span>
                            </label>
                            <input type="checkbox" id="recommended" name="recommended" value="1" class="form-input style-2 pull-right">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-success pull-right">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#lbl_type').text('days'); //set default

    $('input[id="type_day"]').click(function() {
        if(this.checked) {
            $('#lbl_type').text('days');
        }
    });
    $('input[id="type_time"]').click(function() {
        if(this.checked) {
            $('#lbl_type').text('hours');
        }
    });

    $(document).ready(function() {
        $( "#child_price, #adult_price, #duration" ).keydown(function(e) {
            if(!((e.keyCode > 95 && e.keyCode < 106)
              || (e.keyCode > 47 && e.keyCode < 58) 
              || e.keyCode == 8)) {
                e.preventDefault();
            }
        });
    });
</script>