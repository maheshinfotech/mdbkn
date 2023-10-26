
$(document).ready(function () {

      /**element initialization */

      $.ajaxSetup({
            beforeSend : function(){
                  // $('.ajax-loader').show();
                  One.loader('show')
            } ,
            complete : function(){
                  // $('.ajax-loader').hide();
                  One.loader('hide')
            },
            headers: {
                  'Accept' : 'application/json',
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      $('.delete-record').click(function(){

            let context =  $(this);

            Swal.fire({

                  title: "Are you sure?",
                  text:  `You want to delete this record?`,
                  icon: "warning",
                  showCancelButton : true ,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'

            }).then((willDelete) => {

                  if (willDelete.isConfirmed) {
                        $.ajax({
                              url : `${base}/${$(context).data('module')}/${$(context).data('id')}` ,
                              data : '' ,
                              method : 'DELETE',
                              success : function(res){
                                    if(res.status){
                                          $(context).parents('tr').first().remove();
                                          showError(res.message , 'success')
                                    }else{
                                          showError(res.message , 'error')
                                    }
                                    return;
                              },

                        });
                  }
            });

      })
      // $('.edit-record').click(function(){
      //       let context =  $(this);

      // });
      //updatte categories


      $('.update-user-credentials').click(function(){
            let context = $(this);
            $('#pass_user_id').val(context.data('id'));
      })

      $('.nav-main-link-submenu').click(function(){
            $(this).parents('li').first().toggleClass('open');
      });

      $('#page-header-user-dropdown').click(function(){
            $('#page-header-user-dropdown').toggleClass('show');
            $('#page-header-user-dropdown').next('.dropdown-menu').toggleClass('show');
      });

      $('select').select2();

      $('.datepicker').datepicker();

      // let myDropzone = $(".file-upload").Dropzone();

      function showError(message = '' , toastType = 'danger'){
            if(toastType=='error'){
                  toastType = 'danger';
            }
            if(!message)
                  return;

            One.helpers('jq-notify', {type: toastType , message: message});

      }

      let showAlert = show_alert || '';

      showError(showAlert.message , showAlert.class );

      $('#list-view-btn').click(function(){
            $('#grid-view').hide();
            $('#list-view').show();
      });

      $('#grid-view-btn').click(function(){
            $('#grid-view').show();
            $('#list-view').hide();
      });

      if($('.validateform').length){
            $('.validateform').validate({
                  rules: {
                      '.required': {
                          required: true,
                      }
                  },
                  highlight: function(element, errorClass, validClass) {
                        $(element).css('border-color','red');
                  },
                  unhighlight: function(element, errorClass, validClass) {
                        $(element).css('border-color','#dfe3ea');
                  }
            });
      }

      $('.open-qr-modal').click(function (event) {
                  let context = $(this);
                  $('.qr-modal-body').html(context.html());
                  $('.machinery-modal-title').text(context.data('machine'));
      })

      $('.print-qr').click(function (event){

            var prtContent = $(".qr-modal-body").clone();

            prtContent.find('svg').css({height : '300px' , width : '300px' });

            console.log(prtContent);

            var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');

            WinPrint.document.write(prtContent.html());

            // WinPrint.document.close();

            WinPrint.focus();

            WinPrint.print();

            // WinPrint.close();

      })

      $('.triggger-role').change(function(){

            console.log("Hello World how are you");

            let context = $(this);

            let type = $(this).find(":selected").attr('is_manager');

            if( type == '1' ){

                  $('.machine-box').hide();

            }else{

                  $('.machine-box').show();

            }
      });

      $('.triggger-role').trigger('change');

});
function callAjax(url, dataset, callbackfun, async_type = false) {
      $.ajax({
          type: "POST",
          url: url,
          data: dataset,
          async: async_type,
          success: function(response) {
              callbackfun(response);
          }
      });
  }

  function edit_category(id)
  {
        console.log(id);
        $.ajax({
            url: "/category/" + id + "/edit",
            type: "GET",
            data: { category: id },
            success: function (data) {
                console.log(data);
                $("#category_form_heading").text("Edit Category");
                $("#categoty_form_button").text("Update");
                $("#category_method").val("PUT");
                $("#category_form").attr("action", "/category/" + data.data.id);
                //input value insert
                $("input[name=name]").val(data.data.name);
                $("input[name=facility]").val(data.data.facility);
                $('input[name=description]').val(data.data.description);
                $("input[name=normalrent]").val(data.data.normal_rent);
                $("input[name=patientrent]").val(data.data.patient_rent);




            },
        });

  }




  function room_edit(id)
  {
        console.log(id);
        $.ajax({
            url: "/room/" + id + "/edit",
            type: "GET",
            data: { room: id },
            success: function (data) {
                console.log(data);
                $("#room_form_heading").text("Edit Room");
                $("#room_form_button").text("Update");
                $("#room_method").val("PUT");
                $("#room_form").attr("action", "/room/" + data.id);
                //input value insert
                $("#floor_number").val(data.floor_number);
                $("#room_number").val(data.room_number);
                $('#category').val(data.category.id).change();
                $("#remarks").val(data.extra_remark);
                $("#capacity").val(data.guest_capacity);
                $("#status").val(data.room_status).change();





            },
        });

  }
