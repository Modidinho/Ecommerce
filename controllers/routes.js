//this file listens to onclick events and responds to the necessary view
var static_page_title = " | TAITAN FARM ";

var status_code_0 = `Unstable Network. Please try again`;
var status_code_404 = `File Not Found`;
var status_code_500 = `Server Error. The Technical team is handling the error`;
var status_code_undefined = `Undefined Error. The Technical team is handling the error `;
toastr.options = {
  closeButton: "true",
  progressBar:"true"
}

$(document).ajaxStart(function() { Pace.restart(); });

$(document).ajaxError(function() { Pace.stop(); });

$(document).on("click",".link", function(){

  if ($(this).hasClass( "log-in-link" )) {
    var form_url = 'views/Auth/LogInForm.php';
    var form_data = {};
  }

  else if ($(this).hasClass( "forgot-password-email-link" )) {
    var form_url = 'views/Auth/ForgotPasswordEnterEmailForm.php';
    var form_data = {};
  }

  else if ($(this).hasClass( "password-reset-link" )) {
    var form_url = 'views/Auth/PasswordResetForm.php';
    var form_data = {};
  }


  else if ($(this).hasClass( "create-account-link" )) {
    var form_url = 'views/Auth/CreateAccountForm.php';
    var form_data = {};
  }

  else if ($(this).hasClass( "verify-account-link" )) {
    var form_url = 'views/Auth/VerifyAccountForm.php';
    var form_data = {};
  }

  else if ($(this).hasClass( "resend-verification-code-link" )) {
    var form_url = 'views/Auth/ResendVerificationCodeForm.php';
    var form_data = {};
  }

  else if ($(this).hasClass( "user-account-link" )) {
    var form_url = 'views/Account/Account.php';
    var form_data = {};
  }
  else if ($(this).hasClass( "admin-dashboard-link" )) {
    var form_url = 'views/Dashboard/Dashboard.php';
    var form_data = {};
    $('#dynamic-content-1').empty();
  }
  else if ($(this).hasClass( "admin-manage-users-link" )) {
    var form_url = 'views/AdminPanel/ManageUsers.php';
    var form_data = {};
    $('#dynamic-content-1').empty();
  }
  else if ($(this).hasClass( "admin-manage-orders-link" )) {
    var form_url = 'views/AdminPanel/ManageOrders.php';
    var form_data = {};
    $('#dynamic-content-1').empty();
  }
  else if ($(this).hasClass( "admin-manage-products-link" )) {
    var form_url = 'views/AdminPanel/ManageProducts.php';
    var form_data = {};
    $('#dynamic-content-1').empty();
  }
  else if ($(this).hasClass( "admin-manage-product-categories-link" )) {
    var form_url = 'views/AdminPanel/ManageProductCategories.php';
    var form_data = {};
    $('#dynamic-content-1').empty();
  }
  else if ($(this).hasClass( "admin-manage-payments-link" )) {
    var form_url = 'views/AdminPanel/ManagePayments.php';
    var form_data = {};
    $('#dynamic-content-1').empty();
  }
  else 
  {
    return false;
  }

  var form_method = 'POST';
  var link_title = $(this).text().replace(/\d+/g,'');
  var page_title =  link_title + static_page_title;

$.ajax({
      data: form_data,
      url: form_url,
      method: form_method,
      success: function(data)
      {
          $('#page-title').html(page_title);
          $('#dynamic-content').html(data);

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
});




