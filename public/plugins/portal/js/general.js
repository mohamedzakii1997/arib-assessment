/***
 * Filter/View Data in the bootstrap table.
 *
 * */
function render(url) {
    $('#data-table-body').css({display: "none"});
    $('#spinner').css({display: "table-row-group"});
    $.ajax({
        url: url,
        method: "get",
        dataType: 'JSON',
        success: function (data) {
            $('#data-table-body').css({display: "table-row-group"}).html(data.result);
            $('#spinner').css({display: "none"});
            $('#paginationLinksContainer').html(data.links)
            if (data.type == 'pos'){

                $('#default').css('display', 'none');
                $('#hotel').css('display', 'none');
                $('#pos').css('display', 'table-row');
                $('#gate').css('display', 'none');
            }else if(data.type == 'hotel'){

                $('#default').css('display', 'none');
                $('#hotel').css('display', 'block');
                $('#pos').css('display', 'none');
                $('#gate').css('display', 'none');
            }

            else if(data.type == 'gate'){

                $('#default').css('display', 'none');
                $('#hotel').css('display', 'none');
                $('#pos').css('display', 'none');
                $('#gate').css('display', 'block');
            }
            else{
                $('#default').css('display', 'block');
                $('#hotel').css('display', 'none');
                $('#pos').css('display', 'none');
                $('#gate').css('display', 'none');

            }
            if(data.finalTotal){
                $('#finalTotal').text('المجموع الكلي: '+data.finalTotal);
            }

        },
        error: function (data)
        {
            if (data.responseJSON.errors) {
                Object.keys(data.responseJSON.errors).forEach(function (key, index) {
                    data.responseJSON.errors[key].forEach(function (err) {
                        toastr.error(err);
                    })
                });
            }
            else if (data.responseJSON.error)
                toastr.error(data.responseJSON.error);
            $('#spinner').css({display: "none"});

        }
    });
}



















/***
 * Inject The data to bootstrap modals.
 *
 * */
function injectModalData(resource_id, URL,form_id, method ,items=null)
{
    var formElement = document.getElementById(form_id);
    if(items){
        console.log(items);
        var div = formElement.querySelector('#itemList');
        var temp='';
        items.forEach(function(item, index) {
            // Create a new div element for each item


            // Set the innerHTML of the div to display the item details
            temp=temp + `
                <p>ID: ${item.id}</p>
                <p>Item ID: ${item.item_id}</p>
                <!-- Add more details as needed -->
            `;

            // Append the div to the document body or another container
            //formElement.insertBefore(div, formElement.querySelector('#actions'));
        });
        div.innerHTML = temp;
    }
    document.querySelector('#record_resource_id').value = resource_id;
    document.querySelector('#action_method').value = method;

    if (formElement) {
        document.getElementById(form_id).setAttribute('action', URL);
    } else {
        console.error('Element with ID ' + form_id + ' not found');
    }

}
/***
 * Trash, restore or destroy a record
 *
 * */
$(document).on('submit', '#delete-ing-form', function(event)
{
    event.preventDefault();
    var url      = $(this).attr('action');
    var record   = document.getElementById('record_resource_id').value;
    var password = document.getElementById('inputAdminPassword').value;
    var _method  = document.getElementById('action_method').value;
    var token    = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: url,
        method: _method,
        data: {
            _token:token,
            resource_id:record,
            admin_password:password
        },
        dataType: 'JSON',
        success: function (data) {
            if (data['code']===200)
            {
                $('#delete-ing-modal').modal('toggle');
                toastr.success(data['message']);
                location.reload();
            }
            if (data['code']===500)
                toastr.error(data['message']);
            if (data['code']===101)
                toastr.error(data['message']);
        },
        error: function (data) {
            if (data.responseJSON.errors) {
                Object.keys(data.responseJSON.errors).forEach(function (key, index) {
                    data.responseJSON.errors[key].forEach(function (err) {
                        toastr.error(err);
                    })
                });
            }
            else
                toastr.error('Failed, Please try again later.');
        }
    });
});

$(document).on('submit', '#confirm-password-form', function(event)
{
    event.preventDefault();
    var url      = $(this).attr('action');
    var record   = document.getElementById('record_resource_id').value;
    var password = document.getElementById('inputAdminPass').value;
    var _method  = document.getElementById('action_method').value;
    var token    = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: url,
        method: _method,
        data: {
            _token:token,
            resource_id:record,
            admin_password:password
        },
        dataType: 'JSON',
        success: function (data) {
            if (data['code']===200)
            {
                $('#confirm-password-modal').modal('toggle');
                toastr.success(data['message']);
                $('#tableRecord-' + data['item']).remove();
                $('#module-' + data['data']['module']).html(data['data']['trashesCount']).hide().fadeIn('slow');
            }
            if (data['code']===500)
                toastr.error(data['message']);
            if (data['code']===101)
                toastr.error(data['message']);
        },
        error: function (data) {
            if (data.responseJSON.errors) {
                Object.keys(data.responseJSON.errors).forEach(function (key, index) {
                    data.responseJSON.errors[key].forEach(function (err) {
                        toastr.error(err);
                    })
                });
            }
            else
                toastr.error('Failed, Please try again later.');
        }
    });
});

$(document).on('submit', '#confirm-rentPayment-form', function(event)
{
    event.preventDefault();
    var url      = $(this).attr('action');
    var record   = document.getElementById('record_resource_id').value;
    var password = document.getElementById('inputAdminPass').value;
    var payment  = document.getElementById('paymentType').value;
    var _method  = document.getElementById('action_method').value;
    var token    = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: url,
        method: _method,
        data: {
            _token:token,
            resource_id:record,
            payment_type:payment,
            admin_password:password
        },
        dataType: 'JSON',
        success: function (data) {
            if (data['code']===200)
            {
                $('#confirm-rent-payment-modal').modal('toggle');
                toastr.success(data['message']);
                $('#tableRecord-' + data['item']).remove();
                $('#module-' + data['data']['module']).html(data['data']['trashesCount']).hide().fadeIn('slow');
            }
            if (data['code']===500)
                toastr.error(data['message']);
            if (data['code']===101)
                toastr.error(data['message']);
        },
        error: function (data) {
            if (data.responseJSON.errors) {
                Object.keys(data.responseJSON.errors).forEach(function (key, index) {
                    data.responseJSON.errors[key].forEach(function (err) {
                        toastr.error(err);
                    })
                });
            }
            else
                toastr.error('Failed, Please try again later.');
        }
    });
});

$(document).on('submit', '#change-reservation-form', function(event)
{
    event.preventDefault();
    var url      = $(this).attr('action');
    var record   = document.getElementById('record_resource_id').value;
    var password = document.getElementById('inputAdminPassword').value;
    var reservation  = document.getElementById('reservation').value;
    var _method  = document.getElementById('action_method').value;
    var token    = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: url,
        method: _method,
        data: {
            _token:token,
            resource_id:record,
            reservation_id:reservation,
            admin_password:password
        },
        dataType: 'JSON',
        success: function (data) {
            if (data['code']===200)
            {
                $('#change-invoice-reservation-modal').modal('toggle');
                toastr.success(data['message']);
                location.reload();
            }
            if (data['code']===500)
                toastr.error(data['message']);
            if (data['code']===101)
                toastr.error(data['message']);
        },
        error: function (data) {
            if (data.responseJSON.errors) {
                Object.keys(data.responseJSON.errors).forEach(function (key, index) {
                    data.responseJSON.errors[key].forEach(function (err) {
                        toastr.error(err);
                    })
                });
            }
            else
                toastr.error('Failed, Please try again later.');
        }
    });
});

/***
 * Upload Multiple Files using dropzone js library.
 *
 * */
 function uploadMultipleFiles(url, token)
 {
     Dropzone.options.myDropzone =
     {
       url: url,
       sending: function(data, xhr, formData) {
         formData.append('_token',token);
       }      ,
       paramName: "files",
       uploadMultiple: true,
       parallelUploads: 2,
       maxFiles:50,
       maxFilesize: 50,
       addRemoveLinks: true,
       dictFileTooBig: 'Image is larger than 50MB',
       timeout: 10000,
       acceptedFiles: ".jpeg,.jpg,.png,.gif",
       success: function(file, done)
       {
         if(done['code']==200)
             $('#data-table-body').html(done['data']['results']).hide().fadeIn('slow');
         else
             toastr.error('Failed, Try upload files later.');
       }
     };
 }


function setUrl(routeUrl) {
    url = routeUrl; // Store the URL for later use
}

function submitPassword() {
    let form = document.getElementById('confirm-password-form');
    let formData = new FormData(form);

    $.ajax({
        url: url,  // Adjust to your actual route
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if(response.success) {
                // Perform your logic after successful password verification
                window.location.href = response.redirect_url;
            } else {
                alert('Invalid password');
            }
        },
        error: function(xhr, status, error) {
            console.error('An error occurred:', error);
        }
    });
}
