var success_message = 'Successfully Submitted';

var status_code_0 = `Unstable Network. Please try again`;
var status_code_403 = `You are Unauthorised.`;
var status_code_404 = `File Not Found`;
var status_code_500 = `Server Error. The Technical team is handling the error`;
var status_code_undefined = `An error occured. Please try again as we resolve it. `;
var status_code_duplicate_email = `Duplicate email`;
var short_password = `Password should not be less that six characters`;
var password_mismatch = `The passwords do not match`;

toastr.options = {
  closeButton: "true",
  progressBar:"true"
}

var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer);
    toast.addEventListener('mouseleave', Swal.resumeTimer);
  }
  });


  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-primary',
      cancelButton: 'btn btn-light'
    },
    buttonsStyling: false
  });


  $('.pesapal-payment-iframe').addClass('d-none');


  $(document).on('submit','.create-account-form', function(e){
      e.preventDefault();

      var form = $('.create-account-form');
      var form_url = 'controllers/Auth/auth.php';
      var form_ur11 = 'controllers/Auth/EmailController.php';
      var view = $('.verify-account-link');
      var view1 = $('.resend-verification-code-form');
  
      var form_method = 'POST';
      var form_data = form.serializeArray();
  
      form.on('submit', function(e){
        e.preventDefault();
      });
  
      $.ajax({
        data: form_data,
        url: form_url,
        method: form_method,
        beforeSend: function()
        {
          $('.btn-form').block({ message: null });
        },
        success: function(data)
        {
             $('.btn-form').unblock();
             if(data == "success")
             {
                toastr.success('Account Created Successfully. Check email for verification code');
                $(view).click();
  
                //start ajax send email
  
                $.ajax({
                  data:form_data,
                  url:form_ur11,
                  method: form_method,
  
                  success: function(data1)
                  {
                    if(data1 == 'success')
                    {
                      toastr.success('Email sent!');
                    }
                    else 
                    {
                      toastr.error('Failed to send email. Please resend');
                      $(view1).click();
                    }
                    
                  },
                  error: function()
                  {
                    toastr.error('Failed to send email. Please resend');
                    $(view1).click();
                  }
                })
  
  
                //end ajax send email
  
  
             }
             else if(data == "duplicate-email")
             {
               toastr.error(status_code_duplicate_email);
             }
             else if(data == "short-password")
             {
              toastr.error(short_password);
             }
             else if (data == 'password-mismatch')
             {
              toastr.error(password_mismatch);
             }
             else if(data == "403")
             {
               toastr.error(status_code_403);
             }
             else
             {
               toastr.error(status_code_undefined);
               console.log(data);
             }
  
        },
        error: function(xhr)
        {
          $('.btn-form').unblock();
          var status_code = xhr.status;
          if(status_code == "404")
          {
            toastr.error(status_code_404);
          }
          else if(status_code == "403")
          {
            toastr.error(status_code_403);
          }
          else if(status_code == "500")
          {
            toastr.error(status_code_500);
          }
          else if(status_code == "0")
          {
            toastr.error(status_code_0);
          }
          else
          {
            toastr.error(status_code_undefined);
          }
        }
    });

  });


  $(document).on('submit','.verify-account-form', function(e){
    e.preventDefault();

    var form = $('.verify-account-form');
    var form_url = 'controllers/Auth/auth.php';
    var view = $('.log-in-link');

    var form_method = 'POST';
    var form_data = form.serializeArray();

    form.on('submit', function(e){
      e.preventDefault();
    })

    $.ajax({
      data: form_data,
      url: form_url,
      method: form_method,
      beforeSend: function()
      {
        $('.btn-form').block({ message: null });
      },
      success: function(data)
      {
           $('.btn-form').unblock();
           if(data == "success")
           {
              toastr.success('Account Verified. You can now log in');
              $(view).click();

          }
          else if (data == 'invalid')
          {
            toastr.error('Invalid Verification Code. Please try again, or resend new verification code');
          }
          else if (data == 'already-verified')
          {
            toastr.error('Your account is already verified. Please log in');
          }

           else
           {
             toastr.error('An error occured. Please try again');
             console.log(data);
           }

      },
      error: function(xhr)
      {
        $('.btn-form').unblock();
        var status_code = xhr.status;
        if(status_code == "404")
        {
          toastr.error(status_code_404);
        }
        else if(status_code == "403")
        {
          toastr.error(status_code_403);
        }
        else if(status_code == "500")
        {
          toastr.error(status_code_500);
        }
        else if(status_code == "0")
        {
          toastr.error(status_code_0);
        }
        else
        {
          toastr.error(status_code_undefined);
        }
      }
  });

  });


  $(document).on('submit','.resend-verification-code-form', function(e){
    e.preventDefault();

    var form = $('.resend-verification-code-form');
    var form_url = 'controllers/Auth/EmailController.php';
    var view = $('.verify-account-link');

    var form_method = 'POST';
    var form_data = form.serializeArray();

    form.on('submit', function(e){
      e.preventDefault();
    })

    $.ajax({
      data: form_data,
      url: form_url,
      method: form_method,
      beforeSend: function()
      {
        $('.btn-form').block({ message: null });
      },
      success: function(data)
      {
           $('.btn-form').unblock();
           if(data == "success")
           {
              toastr.success('Verification Code sent! Please check your email');
              $(view).click();

          }
           else
           {
             toastr.error('Verification Code not sent. Please try again');
             console.log(data);
           }

      },
      error: function(xhr)
      {
        $('.btn-form').unblock();
        var status_code = xhr.status;
        if(status_code == "404")
        {
          toastr.error(status_code_404);
        }
        else if(status_code == "403")
        {
          toastr.error(status_code_403);
        }
        else if(status_code == "500")
        {
          toastr.error(status_code_500);
        }
        else if(status_code == "0")
        {
          toastr.error(status_code_0);
        }
        else
        {
          toastr.error(status_code_undefined);
        }
      }
  });


  });


  $(document).on('submit','.forgot-password-email-form', function(e){
    e.preventDefault();

    var form = $('.forgot-password-email-form');
    var form_url = 'controllers/Auth/EmailController.php';
    var view = $('.password-reset-link');

    var form_method = 'POST';
    var form_data = form.serializeArray();

    form.on('submit', function(e){
      e.preventDefault();
    })

    $.ajax({
      data: form_data,
      url: form_url,
      method: form_method,
      beforeSend: function()
      {
        $('.btn').block({ message: null });
      },
      success: function(data)
      {
           
           if(data == "success")
           {
            $('.btn').unblock();
              toastr.success('Password Reset Code sent! Please check your email');
              $(view).click();

          }
           else
           {
            $('.btn').unblock();
             toastr.error('Password Reset Code not sent. Please cross check your email and try again');
           }

      },
      error: function(xhr)
      {
        $('.btn').unblock();
        var status_code = xhr.status;
        if(status_code == "404")
        {
          toastr.error(status_code_404);
        }
        else if(status_code == "403")
        {
          toastr.error(status_code_403);
        }
        else if(status_code == "500")
        {
          toastr.error(status_code_500);
        }
        else if(status_code == "0")
        {
          toastr.error(status_code_0);
        }
        else
        {
          toastr.error(status_code_undefined);
        }
      }
  });


  });

  $(document).on('submit','.reset-password-form', function(e){
    e.preventDefault();

    var form = $('.reset-password-form');
    var form_url = 'controllers/Auth/auth.php';
    var form_url1 = 'controllers/Auth/EmailController.php';
    var view = $('.log-in-link');

    var form_method = 'POST';
    var form_data = form.serializeArray();

    form.on('submit', function(e){
      e.preventDefault();
    })

    $.ajax({
      data: form_data,
      url: form_url,
      method: form_method,
      beforeSend: function()
      {
        $('.btn').block({ message: null });
      },
      success: function(data)
      {
           $('.btn').unblock();
           if(data == "success")
           {
              toastr.success('Password Reset Successfully ! Use your new password to login');
              $(view).click();

              //start ajax send email

              $.ajax({
                data: form_data,
                url: form_url1,
                method: form_method,

                success: function(data1)
                {
                  if(data1 == 'success')
                  {
                    toast.success('You have been notified through email about the password change');
                  }
                  else 
                  {
                    toastr.error('Could not notify you through email. You can however use your new password');
                  }
                }
              })
  
                
               //end ajax send email



          }
           else if (data == 'no-code')
           {
             toastr.error('Invalid Verification Code. Cross-check the verification code or request for a new one');
           }
           else if (data == 'short-password')
           {
             toastr.error(short_password);
           }
           else if (data == 'password-mismatch')
           {
             toastr.error(password_mismatch);
           }
           else
           {
             toastr.error(toast_unknown_error);
           }

      },
      error: function(xhr)
      {
        $('.btn').unblock();
        var status_code = xhr.status;
        if(status_code == "404")
        {
          toastr.error(status_code_404);
        }
        else if(status_code == "403")
        {
          toastr.error(status_code_403);
        }
        else if(status_code == "500")
        {
          toastr.error(status_code_500);
        }
        else if(status_code == "0")
        {
          toastr.error(status_code_0);
        }
        else
        {
          toastr.error(status_code_undefined);
        }
      }
  });


  });


  
  $(document).on('submit','.update-user-password-form', function(e){
    e.preventDefault();

    var form = $('.update-user-password-form');
    var form_url = 'controllers/Account/AccountController.php';
    var form_url1 = 'controllers/Auth/EmailController.php';

    var form_method = 'POST';
    var form_data = form.serializeArray();

    form.on('submit', function(e){
      e.preventDefault();
    })

    $.ajax({
      data: form_data,
      url: form_url,
      method: form_method,
      beforeSend: function()
      {
        $('.btn').block({ message: null });
      },
      success: function(data)
      {
           $('.btn').unblock();
           if(data == "success")
           {
            $('.modal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            
              toastr.success('Password Reset Successfully ! Use your new password to login');

              //start ajax send email

              $.ajax({
                data: form_data,
                url: form_url1,
                method: form_method,

                success: function(data1)
                {
                  if(data1 == 'success')
                  {
                    toast.success('You have been notified through email about the password change');
                  }
                  else 
                  {
                    toastr.error('Could not notify you through email. You can however use your new password');
                  }
                }
              })
  
                
               //end ajax send email



          }
          else if (data == 'invalid-password')
          {
            toastr.error('Please enter the correct password');
          }
           else if (data == 'short-password')
           {
             toastr.error(short_password);
           }
           else if (data == 'password-mismatch')
           {
             toastr.error(password_mismatch);
           }
           else
           {
             toastr.error(toast_unknown_error);
           }

      },
      error: function(xhr)
      {
        $('.btn').unblock();
        var status_code = xhr.status;
        if(status_code == "404")
        {
          toastr.error(status_code_404);
        }
        else if(status_code == "403")
        {
          toastr.error(status_code_403);
        }
        else if(status_code == "500")
        {
          toastr.error(status_code_500);
        }
        else if(status_code == "0")
        {
          toastr.error(status_code_0);
        }
        else
        {
          toastr.error(status_code_undefined);
        }
      }
  });


  });


  function UpdateOrderStatus(id,status)
  {
    var form_url = 'controllers/AdminPanel/ManageOrdersController.php';
    var view = $('.admin-manage-orders-link');
    var status = status.value;

    var form_method = 'POST';
    var form_data = {
      'id': id,
      'status' : status,
      'admin_update_order' : 'admin_update_order'
    };

    $.ajax({
      data: form_data,
      url: form_url,
      method: form_method,
      beforeSend: function()
      {
        $('.order-status-'+id).block({ message: null });
      },
      success: function(data)
      {
           $('.order-status-'+id).unblock();
           if(data == "success")
           {
              toastr.success('Order Updated');
              $(view).click();
              SendEmailOnOrderUpdate(id,status)

          }
           else
           {
             toastr.error('Failed to Update Order. Please try again');
           }

      },
      error: function(xhr)
      {
        $('#order-status-'+id).unblock();
        var status_code = xhr.status;
        if(status_code == "404")
        {
          toastr.error(status_code_404);
        }
        else if(status_code == "403")
        {
          toastr.error(status_code_403);
        }
        else if(status_code == "500")
        {
          toastr.error(status_code_500);
        }
        else if(status_code == "0")
        {
          toastr.error(status_code_0);
        }
        else
        {
          toastr.error(status_code_undefined);
        }
      }
  });
  }

  function UpdatePaymentStatus(id,status)
  {
    var form_url = 'controllers/AdminPanel/ManagePaymentsController.php';
    var view = $('.admin-manage-payments-link');
    var status = status.value;

    var form_method = 'POST';
    var form_data = {
      'id': id,
      'status' : status,
      'admin_update_payment' : 'admin_update_payment'
    };

    $.ajax({
      data: form_data,
      url: form_url,
      method: form_method,
      beforeSend: function()
      {
        $('.payment-status-'+id).block({ message: null });
      },
      success: function(data)
      {
           $('.payment-status-'+id).unblock();
           if(data == "success")
           {
              toastr.success('Payment Updated');
              $(view).click();
              SendEmailOnOrderUpdate(id,status)

          }
           else
           {
             toastr.error('Failed to Update Payment. Please try again');
           }

      },
      error: function(xhr)
      {
        $('.payment-status-'+id).unblock();
        var status_code = xhr.status;
        if(status_code == "404")
        {
          toastr.error(status_code_404);
        }
        else if(status_code == "403")
        {
          toastr.error(status_code_403);
        }
        else if(status_code == "500")
        {
          toastr.error(status_code_500);
        }
        else if(status_code == "0")
        {
          toastr.error(status_code_0);
        }
        else
        {
          toastr.error(status_code_undefined);
        }
      }
  });
  }

  function SendEmailOnOrderUpdate(id,status)
  {
    var form_url = 'controllers/Orders/MailUpdates.php';
    var form_method = 'POST';
    var form_data = {
      'id': id,
      'status' : status,
      'email_update_on_order_update' : 'email_update_on_order_update'
    };

    $.ajax({
      data: form_data,
      url: form_url,
      method: form_method,
      success: function(data)
      {
           if(data == "success")
           {
              toastr.success('Email Notification Sent To User!');

          }
           else
           {
             console.log(data);
             toastr.error('Failed to send email notification. The user will have to check manually');
           }

      },
      error: function(xhr)
      {
        var status_code = xhr.status;
        if(status_code == "404")
        {
          toastr.error(status_code_404);
        }
        else if(status_code == "403")
        {
          toastr.error(status_code_403);
        }
        else if(status_code == "500")
        {
          toastr.error(status_code_500);
        }
        else if(status_code == "0")
        {
          toastr.error(status_code_0);
        }
        else
        {
          toastr.error(status_code_undefined);
        }
      }
  });
  }


  $(document).on('change','.image-input', function(e){
      e.preventDefault();

      var item = $('.item').val();

      if(item == 'product')
      {
        var view = $('.admin-manage-products-link');
      }
      else 
      {
        var view = $('.admin-manage-product-categories-link');
      }
      
      var form = $('.update-poster-form');
      var form_1 = $(form).get(0);
      var form_data = new FormData(form_1);
    
      var form_url = 'controllers/AdminPanel/ManageOrdersProfilePictureController.php';
      var form_method = 'POST';

    
      $.ajax({
      type: form_method,
      url: form_url,
      data: form_data,
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function(){
          $('.card').block({message : 'Changing..'});
      },
      success:function(data){
          $('.card').unblock();
          if(data == 'success')
          {
            toastr.success('Product picture updated successfully','Success');
            view.click();
            $('.modal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

    
          }
          else if(data == 'invalid-format')
          {
              toastr.error('Only Image Files are allowed','Failed');
          }
          else if(data == 'big-file')
          {
              toastr.error('Maximum file size is 5mb','Failed');
          }
          else if(data == 'error-uploading')
          {
              toastr.error('An error occured. Please try again');
          }
          else
          {
              toastr.error('Please try again or contact System Administrator','System Error');
          }
      },
      error: function(xhr)
      {
        $('.card').unblock();
        $('.modal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
      var status_code = xhr.status;
      if(status_code == "404")
      {
          toast_404();
      }
      else if(status_code == "403")
      {
          toast_403();
      }
      else if(status_code == "500")
      {
          
          toast_500();
      }
      else if(status_code == "0")
      {
          toast_0();
      }
      else
      {
          toast_unknown_error();
      }
      }
    });
  });


  


  function Logout()
  {

    var form_url = 'controllers/Auth/auth.php';

    var form_method = 'POST';
    var form_data = {
      'logout': 'logout'
    };

    $.ajax({
      data: form_data,
      url: form_url,
      method: form_method,
      beforeSend: function()
      {
        $('.btn-form').block({ message: null });
      },
      success: function(data)
      {
           $('.btn-form').unblock();
           if(data == "success")
           {
              location.reload();

          }
           else
           {
             toastr.error('Failed to logout. Please try again');
           }

      },
      error: function(xhr)
      {
        $('.btn-form').unblock();
        var status_code = xhr.status;
        if(status_code == "404")
        {
          toastr.error(status_code_404);
        }
        else if(status_code == "403")
        {
          toastr.error(status_code_403);
        }
        else if(status_code == "500")
        {
          toastr.error(status_code_500);
        }
        else if(status_code == "0")
        {
          toastr.error(status_code_0);
        }
        else
        {
          toastr.error(status_code_undefined);
        }
      }
  });


  }

  $(document).on("submit",".login-form", function(e){
    e.preventDefault();

    

    var form = $('.login-form');
    var form_url = 'controllers/Auth/auth.php';

    var form_method = 'POST';
    var form_data = form.serializeArray();

    form.on('submit', function(e){
      e.preventDefault();
    })

    $.ajax({
      data: form_data,
      url: form_url,
      method: form_method,
      beforeSend: function()
      {
        $('.btn-form').block({ message: null });
      },
      success: function(data)
      {
           $('.btn-form').unblock();
           if(data == "success")
           {
              location.reload();

          }
           else if(data == "invalid-credentials")
           {
             toastr.error('Invalid Credentials. Please try again, or reset your password');
           }
           else if(data == "user-not-verified")
           {
             toastr.error('You have not verified your account. Please check your email for verification code, or resend verification code');
           }
           else 
           {
            toastr.error('An error occured. Try again');
           }

      },
      error: function(xhr)
      {
        $('.btn-form').unblock();
        var status_code = xhr.status;
        if(status_code == "404")
        {
          toastr.error(status_code_404);
        }
        else if(status_code == "403")
        {
          toastr.error(status_code_403);
        }
        else if(status_code == "500")
        {
          toastr.error(status_code_500);
        }
        else if(status_code == "0")
        {
          toastr.error(status_code_0);
        }
        else
        {
          toastr.error(status_code_undefined);
        }
      }
  });

  });


  function AddToCart(product_id,amount)
  {
    var form_url = 'controllers/Orders/CartController.php';
    

    var form_method = 'POST';
    var form_data = {
      'product_id': product_id,
      'amount': amount,
      'add_product_to_cart': 'add_product_to_cart'
    };

    $.ajax({
      data: form_data,
      url: form_url,
      method: form_method,
      beforeSend: function()
      {
        $('.cart-btn').block({ message: null });
      },
      success: function(data)
      {
           $('.cart-btn').unblock();
           if(data == "success")
           {
             $('.cart-btn-'+product_id).removeClass('btn-danger').addClass('btn-success');
            toastr.success('Item added to cart successfully');
            CountCartItems();


          }
           else 
           {
            toastr.error('An error occured. Try again');
           }

      },
      error: function(xhr)
      {
        $('.btn-form').unblock();
        var status_code = xhr.status;
        if(status_code == "404")
        {
          toastr.error(status_code_404);
        }
        else if(status_code == "403")
        {
          toastr.error(status_code_403);
        }
        else if(status_code == "500")
        {
          toastr.error(status_code_500);
        }
        else if(status_code == "0")
        {
          toastr.error(status_code_0);
        }
        else
        {
          toastr.error(status_code_undefined);
        }
      }
  });
  }

function CountCartItems()
{
  var form_url = 'controllers/Orders/TotalCartItems.php';
  var form_method = 'POST';
  var form_data = {};

  $.ajax({
    data:form_data,
    url: form_url,
    method: form_method,

    success: function(data)
    {
      $('.cart-counter').html(data);
    },
    error: function(error)
    {
      toastr.error('Cart not updated. Please refresh page');
    }
  })
}

CountCartItems();

function ShowCartItems()
{
  var form_url = 'views/Orders/ShowCartItems.php';
  var form_method = 'POST';
  var form_data = {};

  $.ajax({
    data:form_data,
    url: form_url,
    method: form_method,
    beforeSend: function()
    {
      $('.cart-modal-content').html(spinner);
    },

    success: function(data)
    {
      $('.cart-modal-content').html(data);
    },
    error: function(error)
    {
      toastr.error('Cart not updated. Please refresh page');
    }
  })
}

function ShowOrderItems()
{
  var form_url = 'views/Orders/ShowOrderItems.php';
  var form_method = 'POST';
  var form_data = {};

  $.ajax({
    data:form_data,
    url: form_url,
    method: form_method,
    beforeSend: function()
    {
      $('.orders-modal-content').html(spinner);
    },

    success: function(data)
    {
      $('.orders-modal-content').html(data);
    },
    error: function(error)
    {
      toastr.error('Orders not updated. Please refresh page');
    }
  })
}

function RemoveProductFromCart(id)
{
  var form_url = 'controllers/Orders/CartController.php';
  var form_method = 'POST';
  var form_data = {
    'id': id,
    'remove_product_from_cart': 'remove_product_from_cart'
  };

  $.ajax({
    data:form_data,
    url: form_url,
    method: form_method,
    beforeSend: function()
    {
      $('.remove-btn').block({ message: null });
    },

    success: function(data)
    {
      $('.remove-btn').unblock();

      if(data == 'success')
      {
        toastr.success('Item removed');
         ShowCartItems();
         CountCartItems();
      }
      else 
      {
        toastr.error('Failed to remove product from cart. Please try again');
      }
      
    },
    error: function(error)
    {
      $('.remove-btn').unblock();
      toastr.error('Failed to remove product from cart. Please try again');
    }
  })
}

function UpdateCartProductQuantity(id)
{
  var quantity = $('#quantity-'+id).val();
  var form_url = 'controllers/Orders/CartController.php';
  var form_method = 'POST';
  var form_data = {
    'id': id,
    'quantity': quantity,
    'update_cart_product_quantity': 'update_cart_product_quantity'
  };


  $.ajax({
    data:form_data,
    url: form_url,
    method: form_method,
    beforeSend: function()
    {
      $('select').block({ message: null });
    },

    success: function(data)
    {
      $('select').unblock();

      if(data == 'success')
      {
         toastr.success('Cart Updated');
         ShowCartItems();
         CountCartItems();
      }
      else 
      {
        toastr.error('Failed to update cart. Please try again');
      }
      
    },
    error: function(error)
    {
      $('.remove-btn').unblock();
      toastr.error('Failed to update cart. Please try again');
    }
  })
}


function Checkout(payment_option)
{
  if(payment_option == 'cash')
  {
    $('.pesapal-payment-iframe').addClass('d-none');
    var option = 'Cash on Delivery';

    var swalWithPaymentButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-info btn-rounded',
        cancelButton: 'btn btn-light btn-rounded'
      },
      buttonsStyling: false
    });

  }
  else if (payment_option == 'eft')
  {

    var option = 'Electronic Funds Transfer';

    var swalWithPaymentButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success btn-rounded',
        cancelButton: 'btn btn-light btn-rounded'
      },
      buttonsStyling: false
    });

  }

  var form_data = {
    'payment_option' : payment_option
  };

  var form_url = 'controllers/Orders/OrderController.php';
  var form_method = 'POST';



  swalWithPaymentButtons.fire({
    title: 'CHECKOUT ORDER ?',
    html: 'You are about to checkout the order using <br/> <b>' + option + '</b> . <br/>Proceed?',
    icon: 'question',
    showCancelButton: true,
    allowOutsideClick: true,
    confirmButtonText: 'YES, CHECKOUT',
    cancelButtonText: 'NO, CANCEL!',
    reverseButtons: true,
    showClass: {
      popup: 'animate__animated animate__fadeInDown'
    },
    hideClass: {
      popup: 'animate__animated animate__fadeOutUp'
    },
  }).then((result) => {
    if (result.value) {

      $.ajax({
        data: form_data,
        url: form_url,
        method: form_method,
        beforeSend: function() {
          $('.btn').block({
            'message': null
          });

          if(payment_option == 'eft')
          {
            $('.pesapal-payment-iframe').removeClass('d-none');
          }
        },
        success: function(data) {
          $('.btn').unblock();

          if (payment_option == 'eft')
          {
            
            $('.pesapal-payment-iframe').html(data);
            //ShowCartItems();
            CountCartItems();

        
          }
          else if (payment_option == 'cash')
          {

              if (data == "success")
              {
                ShowCartItems();
                CountCartItems();
    
                Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: 'You have successfully checked out the order using ' + option + ' ',
                  showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                  },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                  }
    
                })
              } else
              {
                
                console.log(data);
    
                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: 'Failed to checkout order. Please try again',
                  showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                  },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                  }
    
                })
    
              }
          }



        },
        error: function(xhr) {
          $('.btn').unblock();
          var status_code = xhr.status;
          Swal.fire({
            icon: 'error',
            title: 'Error '+status_code,
            text: 'Failed to checkout order. Please try again',
            showClass: {
              popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
              popup: 'animate__animated animate__fadeOutUp'
            }
  
          })
        }

      });

    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {

    }
  });

}

$(document).on('submit', '.add-product-form', function(e){
  e.preventDefault();

  var form = $('.add-product-form');

  var form_url = 'controllers/AdminPanel/ManageProductsController.php';
  var form_method = 'POST';
  var form_data = form.serializeArray();

  $.ajax({
      data:form_data,
      url: form_url,
      method: form_method,
      beforeSend: function()
      {
      $('.btn').block({ message: null });
      },

      success: function(data)
      {
      $('.btn').unblock();
      $('.modal').modal('hide');
       $('body').removeClass('modal-open');
       $('.modal-backdrop').remove();

      if(data == 'success')
      {
          toastr.success('Product Added Successfully');
          $('.admin-manage-products-link').click();
      }
      else 
      {
          toastr.error('Failed to add product. Please try again');
      }
      
      },
      error: function(error)
      {
          $('.btn').unblock();
          $('.modal').modal('hide');
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
          toastr.error('Failed to add product. Please try again');
      }
  })
});

$(document).on('submit', '.edit-product-form', function(e){
  e.preventDefault();

  var form = $('.edit-product-form');

  var form_url = 'controllers/AdminPanel/ManageProductsController.php';
  var form_method = 'POST';
  var form_data = form.serializeArray();

  $.ajax({
      data:form_data,
      url: form_url,
      method: form_method,
      beforeSend: function()
      {
      $('.btn').block({ message: null });
      },

      success: function(data)
      {
      $('.btn').unblock();
      $('.modal').modal('hide');
       $('body').removeClass('modal-open');
       $('.modal-backdrop').remove();

      if(data == 'success')
      {
          toastr.success('Product Updated Successfully');
          $('.admin-manage-products-link').click();
      }
      else 
      {
          toastr.error('Failed to update  product. Please try again');
      }
      
      },
      error: function(error)
      {
          $('.btn').unblock();
          $('.modal').modal('hide');
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
          toastr.error('Failed to update product. Please try again');
      }
  })
});

$(document).on('submit', '.add-product-category-form', function(e){
  e.preventDefault();

  var form = $('.add-product-category-form');

  var form_url = 'controllers/AdminPanel/ManageProductsController.php';
  var form_method = 'POST';
  var form_data = form.serializeArray();

  $.ajax({
      data:form_data,
      url: form_url,
      method: form_method,
      beforeSend: function()
      {
      $('.btn').block({ message: null });
      },

      success: function(data)
      {
      $('.btn').unblock();
      $('.modal').modal('hide');
       $('body').removeClass('modal-open');
       $('.modal-backdrop').remove();

      if(data == 'success')
      {
          toastr.success('Product Category Added Successfully');
          $('.admin-manage-product-categories-link').click();
      }
      else 
      {
          toastr.error('Failed to add product category. Please try again');
      }
      
      },
      error: function(error)
      {
          $('.btn').unblock();
          $('.modal').modal('hide');
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
          toastr.error('Failed to add product category. Please try again');
      }
  })
});

$(document).on('submit', '.edit-product-category-form', function(e){
  e.preventDefault();

  var form = $('.edit-product-category-form');

  var form_url = 'controllers/AdminPanel/ManageProductsController.php';
  var form_method = 'POST';
  var form_data = form.serializeArray();

  $.ajax({
      data:form_data,
      url: form_url,
      method: form_method,
      beforeSend: function()
      {
      $('.btn').block({ message: null });
      },

      success: function(data)
      {
      $('.btn').unblock();
      $('.modal').modal('hide');
       $('body').removeClass('modal-open');
       $('.modal-backdrop').remove();

      if(data == 'success')
      {
          toastr.success('Product Category Edited Successfully');
          $('.admin-manage-product-categories-link').click();
      }
      else 
      {
          toastr.error('Failed to edit product category. Please try again');
      }
      
      },
      error: function(error)
      {
          $('.btn').unblock();
          $('.modal').modal('hide');
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
          toastr.error('Failed to edit product category. Please try again');
      }
  })
});

$(document).on('submit', '.update-profile-form', function(e){
  e.preventDefault();

  var form = $('.update-profile-form');

  var form_url = 'controllers/Account/AccountController.php';
  var form_method = 'POST';
  var form_data = form.serializeArray();

  $.ajax({
      data:form_data,
      url: form_url,
      method: form_method,
      beforeSend: function()
      {
      $('.btn').block({ message: null });
      },

      success: function(data)
      {
      $('.btn').unblock();
      $('.modal').modal('hide');
       $('body').removeClass('modal-open');
       $('.modal-backdrop').remove();

      if(data == 'success')
      {
          toastr.success('Profile Updated');
          $('.user-account-link').click();
      }
      else 
      {
          toastr.error('Failed to update profile. Please try again');
      }
      
      },
      error: function(error)
      {
          $('.btn').unblock();
          $('.modal').modal('hide');
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
          toastr.error('Failed to update profile. Please try again');
      }
  })
});



$(document).on('submit','.admin-create-account-form', function(e){
  e.preventDefault();

  var form = $('.admin-create-account-form');
  var form_url = 'controllers/Auth/auth.php';
  var form_ur11 = 'controllers/Auth/EmailController.php';
  var view = $('.admin-manage-users-link');
  var form_method = 'POST';
  var form_data = form.serializeArray();

  form.on('submit', function(e){
    e.preventDefault();
  });

  $.ajax({
    data: form_data,
    url: form_url,
    method: form_method,
    beforeSend: function()
    {
      $('.btn-form').block({ message: null });
    },
    success: function(data)
    {
         $('.btn-form').unblock();
         $('.btn').unblock();
         $('.modal').modal('hide');
         $('body').removeClass('modal-open');
         $('.modal-backdrop').remove();

         if(data == "success")
         {
            toastr.success('Account Created Successfully. Check email for verification code');
            $(view).click();

            //start ajax send email

            $.ajax({
              data:form_data,
              url:form_ur11,
              method: form_method,

              success: function(data1)
              {
                if(data1 == 'success')
                {
                  toastr.success('Email sent!');
                }
                else 
                {
                  toastr.error('Failed to send email. Please resend');
                  $(view1).click();
                }
                
              },
              error: function()
              {
                toastr.error('Failed to send email. Please resend');
                $(view1).click();
              }
            })


            //end ajax send email


         }
         else if(data == "duplicate-email")
         {
           toastr.error(status_code_duplicate_email);
         }
         else if(data == "403")
         {
           toastr.error(status_code_403);
         }
         else
         {
           toastr.error(status_code_undefined);
           console.log(data);
         }

    },
    error: function(xhr)
    {
      $('.btn-form').unblock();
      $('.btn').unblock();
      $('.modal').modal('hide');
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
      var status_code = xhr.status;
      if(status_code == "404")
      {
        toastr.error(status_code_404);
      }
      else if(status_code == "403")
      {
        toastr.error(status_code_403);
      }
      else if(status_code == "500")
      {
        toastr.error(status_code_500);
      }
      else if(status_code == "0")
      {
        toastr.error(status_code_0);
      }
      else
      {
        toastr.error(status_code_undefined);
      }
    }
});

});




$(document).on('submit','.admin-update-account-form', function(e){
  e.preventDefault();

  var form = $('.admin-update-account-form');
  var form_url = 'controllers/AdminPanel/ManageUsersController.php';
  var form_ur11 = 'controllers/Auth/EmailController.php';
  var view = $('.admin-manage-users-link');
  var form_method = 'POST';
  var form_data = form.serializeArray();

  form.on('submit', function(e){
    e.preventDefault();
  });

  $.ajax({
    data: form_data,
    url: form_url,
    method: form_method,
    beforeSend: function()
    {
      $('.btn').block({ message: null });
    },
    success: function(data)
    {
         $('.btn').unblock();
         $('.modal').modal('hide');
         $('body').removeClass('modal-open');
         $('.modal-backdrop').remove();

         if(data == "success")
         {
            toastr.success('Account Updated Successfully');
            $(view).click();

         }
         else if(data == "duplicate-email")
         {
           toastr.error(status_code_duplicate_email);
         }
         else if(data == "403")
         {
           toastr.error(status_code_403);
         }
         else
         {
           toastr.error(status_code_undefined);
           console.log(data);
         }

    },
    error: function(xhr)
    {
      $('.btn').unblock();
      $('.modal').modal('hide');
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
      var status_code = xhr.status;
      if(status_code == "404")
      {
        toastr.error(status_code_404);
      }
      else if(status_code == "403")
      {
        toastr.error(status_code_403);
      }
      else if(status_code == "500")
      {
        toastr.error(status_code_500);
      }
      else if(status_code == "0")
      {
        toastr.error(status_code_0);
      }
      else
      {
        toastr.error(status_code_undefined);
      }
    }
});

});