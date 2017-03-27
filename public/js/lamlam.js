'use strict';
var LAMLAM = LAMLAM || {
    'informations' : {},
    'tickets'      : {},
    'passcodes'    : {}
};

// INFORMATIONS
LAMLAM.informations = function(){
    var toDelete_infoId = false;
    // view information register modal
    $('#information-register-modal').on('show.bs.modal', function(e) {
          var $modal = $(this);
          var esseyId = e.relatedTarget.id;
    });    
    // trigger register button from form 
    $('#information-register').submit(function(event){      
       event.preventDefault(); // Stop form from submitting normally
       var form_data = [
            {name: '_token', value: $('#_token').val()},
            {name: 'comment_en', value: $('#reg_comment_en').val()},
            {name: 'comment_ja', value: $('#reg_comment_ja').val()},
            {name: 'open_date', value: $('#reg_open_date').val()},
            {name: 'close_date', value: $('#reg_close_date').val()},
        ];
        $.ajax({
            data: form_data,
            url: '/admin/informations/create',
            type: 'POST',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', form_data[0].value);
            },
            success: function(response){
                if(response.errors) {
                    $("#errors h3").remove();  
                    $("#errors h5").remove(); 
                    $("#errors p").remove();  
                    $('#information-fail-modal').modal('show');
                    $("#errors").append('<h3>' + response.message + '</h3');

                    for (var property in response.errors) {
                        $("#errors").append('<h5><strong>*' + property + '</strong></h5');
                        for(var i=0; i<response.errors[property].length; i++) {
                            $("#errors").append('<p>- ' + response.errors[property][i] + '</p');
                        }
                    } 
                } else {
                    $('#information-success-modal').modal('show');    
                    $('#success-heading').text('Registration completed'); 
                }
            }
        })
    });
    // information modal view / update
    $('#view-information-modal').on('show.bs.modal', function(e) {
        var $modal = $(this);
        var infoId = e.relatedTarget.id;
        toDelete_infoId = infoId;
        $.ajax({
            url: '/admin/informations/' + infoId,
            data: {format: 'json'},
            type: 'GET',
            dataType: 'json',
            success: function(response){
               var info = response.information;
               $("#comment_en").val(info.comments_en);
               $("#comment_ja").val(info.comments_ja);
               $("#open_date").val(info.open_date);
               $('#close_date').val(info.close_date);
            }
        });
    });  
    // edit button clicked
    $('#edit_information').click(function(event){
        event.preventDefault();
        var form_data = [
            {name: '_token', value: $('#_token').val()},
            {name: 'comment_en', value: $('#comment_en').val()},
            {name: 'comment_ja', value: $('#comment_ja').val()},
            {name: 'open_date', value: $('#open_date').val()},
            {name: 'close_date', value: $('#close_date').val()},
        ];
        $.ajax({
            data: form_data,
            url: '/admin/informations/' + toDelete_infoId,
            type: 'PUT',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $('#_token').val());
            },
            success: function(response){
                if(response.errors) {
                    $("#errors h3").remove();  
                    $("#errors h5").remove(); 
                    $("#errors p").remove();  
                    $('#information-fail-modal').modal('show');
                    $("#errors").append('<h3>' + response.message + '</h3');
                    for (var property in response.errors) {
                        $("#errors").append('<h5><strong>*' + property + '</strong></h5');
                        for(var i=0; i<response.errors[property].length; i++) {
                            $("#errors").append('<p>- ' + response.errors[property][i] + '</p');
                        }
                    } 
                } else {
                    $('#information-success-modal').modal('show'); 
                    $('#success-heading').text(response.message); 
                }
            }
        })
    });    
    $('#information-success-modal').on('hidden.bs.modal', function(e){
        window.location.reload(true);
    });
    // delete button clicked
    $('#delete_information').click(function(event){
        event.preventDefault();
        $('#information-prompt-delete-modal').modal('show');
    });
    // delete yes confirmation clicked
    $('#confirmedDelete').click(function(event){   	
        $.ajax({
            url: '/admin/informations/' + toDelete_infoId + '/delete',
            data: {format: 'json'},
            type: 'DELETE',
            dataType: 'json',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $('#_token').val());
            },
            success: function(response){
                $('#view-information-modal').modal('hide');
                $('#information-prompt-delete-modal').modal('hide');
                $('#information-prompt-success-delete-modal').modal('show');
            }
        });

    });
    $('#ok-delete').click(function(event){
        window.location.reload(true);
    });
};
// end informations

// TICKETS
LAMLAM.tickets = function(){
    var toDelete_ticketId = false;
    $('#ticket-register').submit(function(event){      
       event.preventDefault(); // Stop form from submitting normally
       var form_data = new FormData($('#ticket-register')[0]);
        $.ajax({
            data: form_data,
            url: '/admin/tickets/create',
            type: 'POST',
            contentType: false,
            processData: false,
            enctype: "multipart/form-data",
            files: true,
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $('#_token').val());
            },
            success: function(response){
                if(response.errors) {
                    $("#errors h3").remove();  
                    $("#errors h5").remove(); 
                    $("#errors p").remove();  
                    $('#ticket-fail-modal').modal('show');
                    $("#errors").append('<h3>' + response.message + '</h3');

                    for (var property in response.errors) {
                        $("#errors").append('<h5><strong>*' + property + '</strong></h5');
                        for(var i=0; i<response.errors[property].length; i++) {
                            $("#errors").append('<p>- ' + response.errors[property][i] + '</p');
                        }
                    } 
                } else {
                    $('#ticket-success-modal').modal('show');    
                    $('#success-heading').text(response.message); 
                }
            }
        });
    });

    $('#view-ticket-modal').on('show.bs.modal', function(e) {
        var $modal = $(this);
        var ticketId = e.relatedTarget.id;
        toDelete_ticketId = ticketId;
        $.ajax({
            url: '/admin/tickets/' + ticketId,
            data: {format: 'json'},
            type: 'GET',
            dataType: 'json',
            success: function(response){
               var ticket = response;
               $("#edit_name_en").val(ticket.name_en);
               $("#edit_name_ja").val(ticket.name_ja);
               $("#edit_description_en").val(ticket.description_en);
               $("#edit_description_ja").val(ticket.description_ja);
               $("#edit_color").val(ticket.color);
               $("#img_url").attr('src',ticket.image_url);
               $("#edit_adult_price").val(ticket.adult_price);
               $("#edit_child_price").val(ticket.child_price);
               $("#edit_type_"+ticket.type).prop("checked", true);
               $("#edit_duration").val(ticket.duration);
               if(ticket.recommended == 1) {
                    $("#edit_recommended").prop("checked", true);
               } else {
                    $("#edit_recommended").prop("checked", false);
               }
            }
        });
    });

    $('#edit_ticket').submit(function(event){
        event.preventDefault();
        var input_data = new FormData($('#edit_ticket')[0]);
        $.ajax({
            url: '/admin/tickets/' + toDelete_ticketId,
            data: input_data,
            type: 'POST',
            contentType: false,
            processData: false,
            enctype: "multipart/form-data",
            files: true,
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $('#_token').val());
            },
            success: function(response){
                if(response.errors) {
                    $("#errors h3").remove();  
                    $("#errors h5").remove(); 
                    $("#errors p").remove();  
                    $('#ticket-fail-modal').modal('show');
                    $("#errors").append('<h3>' + response.message + '</h3');
                    for (var property in response.errors) {
                        $("#errors").append('<h5><strong>*' + property + '</strong></h5');
                        for(var i=0; i<response.errors[property].length; i++) {
                            $("#errors").append('<p>- ' + response.errors[property][i] + '</p');
                        }
                    } 
                } else {
                    $('#ticket-success-modal').modal('show'); 
                    $('#success-heading').text(response.message); 
                }
            }
        })
    });

    $('#ticket-success-modal').on('hidden.bs.modal', function(e){
        window.location.reload(true);
    });
    // delete button clicked
    $('#delete_ticket').click(function(event){
        event.preventDefault();
        $('#ticket-prompt-delete-modal').modal('show');
    });
    // delete yes confirmation clicked
    $('#confirmedDelete').click(function(event){    
        $.ajax({
            url: '/admin/tickets/' + toDelete_ticketId + '/delete',
            data: {format: 'json'},
            type: 'DELETE',
            dataType: 'json',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $('#_token').val());
            },
            success: function(response){
                $('#view-ticket-modal').modal('hide');
                $('#ticket-prompt-delete-modal').modal('hide');
                $('#ticket-prompt-success-delete-modal').modal('show');
            }
        });

    });
    $('#ok-delete').click(function(event){
        window.location.reload(true);
    });
};


// PASSCODES
LAMLAM.passcodes = function(){
    var toDelete_passcodeId = false;
    
    $("#btnIssue").click(function(){
        $('#passcode-prompt-issue-modal').modal('show');  
    });

    $('#passcode-prompt-issue-modal').on('show.bs.modal', function(e) { // dont proceed if input is empty
        if( $("#issue_num").val().length > 0 ){
          $("#modal-body").text('Are you sure to issue '+$("#issue_num").val()+' sheets?');
        } else {
            e.preventDefault();
        }
        
    });

    $('#confirmedIssue').click(function(event){
        $('#passcode-prompt-issue-modal').modal('hide');
        event.preventDefault(); // Stop form from submitting normally
        var form_data = [
            {name: '_token', value: $('#_token').val()},
            {name: 'ticket_id', value: $('#reg_ticket_id option:selected').val()},
            {name: 'adult_num', value: $('#adult_num').val()},
            {name: 'child_num', value: $('#child_num').val()},
            {name: 'issue_num', value: $('#issue_num').val()}
        ];
        $.ajax({
            data: form_data,
            url: '/admin/passcodes/create',
            type: 'POST',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $('#_token').val());
            },
            success: function(response){
                if(response.errors) {
                    $("#errors h3").remove();  
                    $("#errors h5").remove(); 
                    $("#errors p").remove();  
                    $('#passcode-fail-modal').modal('show');
                    $("#errors").append('<h3>' + response.message + '</h3');

                    for (var property in response.errors) {
                        $("#errors").append('<h5><strong>*' + property + '</strong></h5');
                        for(var i=0; i<response.errors[property].length; i++) {
                            $("#errors").append('<p>- ' + response.errors[property][i] + '</p');
                        }
                    } 
                } else {
                    $('#passcode-success-modal').modal('show');    
                    $('#success-heading').text(response.message); 
                }
            },
            errors: function(response) {
                console.log(response);
            }
        });
    });

    $('#passcode-success-modal').on('hidden.bs.modal', function(e){
        window.location.reload(true);
    });

    $('#passcode-prompt-delete-modal').on('show.bs.modal', function(e) {
        var $modal = $(this);
        var passcodeId = e.relatedTarget.id;
        toDelete_passcodeId = passcodeId;
    });

    // delete yes confirmation clicked
    $('#confirmedDelete').click(function(event){    
        $.ajax({
            url: '/admin/passcodes/' + toDelete_passcodeId + '/delete',
            data: {format: 'json'},
            type: 'DELETE',
            dataType: 'json',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $('#_token').val());
            },
            success: function(response){
                $('#passcode-prompt-delete-modal').modal('hide');
                $('#passcode-prompt-success-delete-modal').modal('show');
            }
        });
    });
    $('#ok-delete').click(function(event){
        window.location.reload(true);
    });
};

// INFORMATIONS
LAMLAM.users = function(){
    var userId = false;
    // information modal view / update
    $('#edit-user-modal').on('show.bs.modal', function(e) {
        var $modal = $(this);
        userId = e.relatedTarget.id;
        $.ajax({
            url: '/admin/users/' + userId,
            data: {format: 'json'},
            type: 'GET',
            dataType: 'json',
            success: function(response){
               var user = response.user;
               $('#name').val(user.name);
               $('#email').val(user.email);
               if(user.email_magazine_subscribed == 1) {
                 $('#subscribe').prop('checked', true);
               } else {
                 $('#subscribe').prop('checked', false);
               }
            }
        });
    });
    $('#edit_user').click(function(event){
        event.preventDefault();
        $('#user-prompt-edit-modal').modal('show');
    });
    // edit button clicked
    $('#confirmedUpdate').click(function(event){
        event.preventDefault();
        var form_data = [
            {name: '_token', value: $('#_token').val()},
            {name: 'name', value: $('#name').val()},
            {name: 'email', value: $('#email').val()},
            {name: 'email_confirm', value: $('#email_confirm').val()},
            {name: 'password', value: $('#password').val()},
            {name: 'password_confirm', value: $('#password_confirm').val()},
            {name: 'email_magazine_subscribed', value: $('#subscribe').prop("checked") == true?"1":"0"},
            {name: '_edittype', value: 'Save'},
        ];
        $.ajax({
            data: form_data,
            url: '/admin/users/' + userId,
            type: 'PUT',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $('#_token').val());
            },
            success: function(response){
                if(response.errors) {
                    $("#errors h3").remove();  
                    $("#errors h5").remove(); 
                    $("#errors p").remove();  
                    $('#user-fail-modal').modal('show');
                    $("#errors").append('<h3>' + response.message + '</h3');
                    for (var property in response.errors) {
                        $("#errors").append('<h5><strong>*' + property + '</strong></h5');
                        for(var i=0; i<response.errors[property].length; i++) {
                            $("#errors").append('<p>- ' + response.errors[property][i] + '</p');
                        }
                    }
                    $('#user-prompt-edit-modal').modal('hide');
                } else {
                    $('#user-success-modal').modal('show'); 
                    $('#success-heading').text(response.result); 
                    $('#user-prompt-edit-modal').modal('hide');
                }
            }
        })
    });
    $('#user-success-modal').on('hidden.bs.modal', function(e){
        window.location.reload(true);
    });
}; // end users