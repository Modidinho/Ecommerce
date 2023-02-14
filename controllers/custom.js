var success_message = 'Successfully Submitted';

var status_code_0 = `Unstable Network. Please try again`;
var status_code_403 = `You are Unauthorised.`;
var status_code_404 = `File Not Found`;
var status_code_500 = `Server Error. The Technical team is handling the error`;
var status_code_undefined = `An error occured. Please try again as we resolve it. `;

var spinner = `<div class="d-flex justify-content-center cma-font-color">
  <div class="spinner-border" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>`;

toastr.options = {
  closeButton: "true",
  progressBar:"true"
}

var spinner=`
<div class="col-md-12 m-3 d-flex justify-content-center">
<div class="spinner-border text-primary m-3" role="status">
  <span class="sr-only">Loading...</span>
</div>
</div>
`;



function GetProductCategories()
{
  $.ajax({
    type: "POST",
    url: "views/HomePage/ProductCategories.php",
    beforeSend: function()
    {
      $("#dynamic-content").html(spinner);
    },
    success: function(data){

      $("#dynamic-content").html(data);
    },
    error: function(xhr)
    {
      var retry=`
<div class="d-flex justify-content-center">
<button type="button" class="btn btn-outline-danger btn-sm btn-rounded waves-effect" onclick="GetProductCategories()"><i class="fas fa-history"></i> Retry</button>
</div>
`;

      $('#dynamic-content').html(retry);
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

function GetProducts()
{
  $.ajax({
          type: "POST",
          url: "views/HomePage/Products.php",
          beforeSend: function()
          {
            $("#dynamic-content-1").html(spinner);
          },
          success: function(data){
            $("#dynamic-content-1").html(data);
          },
          error: function(xhr)
          {
            var retry=`
            <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-outline-danger btn-sm btn-rounded waves-effect" onclick="GetProducts()"><i class="fas fa-history"></i> Retry</button>
            </div>
            `;
            
            $('#dynamic-content-1').html(retry);

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

function ShowOrderDetails(id)
{
  var form_url = 'views/Orders/ShowOrderDetails.php';
  var form_method = 'POST';
  var form_data = {
    'id' : id
  };

  $.ajax({
      data: form_data,
      url: form_url,
      method: form_method,
      beforeSend: function()
      {
        $('.payment-orders-modal-content').html(spinner);
      },
      success: function(data)
      {
          $('.payment-orders-modal').modal('show');
          $('.payment-orders-modal-content').html(data);

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


function OpenEditProductModal(id)
{
  var form_url = 'views/AdminPanel/ModalEditProduct.php';
  var form_method = 'POST';
  var form_data = {
    'id' : id
  };

  $.ajax({
      data: form_data,
      url: form_url,
      method: form_method,
      beforeSend: function()
      {
        $('.edit-product-modal-content').html(spinner);
      },
      success: function(data)
      {
          $('.edit-product-modal').modal('show');
          $('.edit-product-modal-content').html(data);

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

function OpenEditProductCategoryModal(id)
{
  var form_url = 'views/AdminPanel/ModalEditProductCategory.php';
  var form_method = 'POST';
  var form_data = {
    'id' : id
  };

  $.ajax({
      data: form_data,
      url: form_url,
      method: form_method,
      beforeSend: function()
      {
        $('.edit-product-category-modal-content').html(spinner);
      },
      success: function(data)
      {
          $('.edit-product-category-modal').modal('show');
          $('.edit-product-category-modal-content').html(data);

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

function OpenChangePosterModal(id,item)
{
  var form_url = 'views/AdminPanel/ModalEditPoster.php';
  var form_method = 'POST';
  var form_data = {
    'id' : id,
    'item': item
  };

  $.ajax({
      data: form_data,
      url: form_url,
      method: form_method,
      beforeSend: function()
      {
        $('.edit-poster-modal-content').html(spinner);
      },
      success: function(data)
      {
          $('.edit-poster-modal').modal('show');
          $('.edit-poster-modal-content').html(data);

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


function OpenEditUserModal(id)
{
  var form_url = 'views/AdminPanel/ModalEditUser.php';
  var form_method = 'POST';
  var form_data = {
    'id' : id
  };

  $.ajax({
      data: form_data,
      url: form_url,
      method: form_method,
      beforeSend: function()
      {
        $('.edit-user-modal-content').html(spinner);
      },
      success: function(data)
      {
          $('.edit-user-modal').modal('show');
          $('.edit-user-modal-content').html(data);

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


function GetProductsByCategory(id)
{
  var form_data = {
    'id' : id,
    'category' : 'category'
  }
  $.ajax({
    type: "POST",
    url: "views/HomePage/Products.php",
    data: form_data,
    beforeSend: function()
    {
      $("#dynamic-content-1").html(spinner);
    },
    success: function(data){
      $("#dynamic-content-1").html(data);
    },
    error: function(xhr)
    {
      var retry=`
      <div class="d-flex justify-content-center">
      <button type="button" class="btn btn-outline-danger btn-sm btn-rounded waves-effect" onclick="SearchProducts(search)"><i class="fas fa-history"></i> Retry</button>
      </div>
      `;
      
      $('#dynamic-content-1').html(retry);

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

function SearchProducts()
{
  var search = $('.search-field').val();
  var form_data = {
    'search' : search
  }
  $.ajax({
    type: "POST",
    url: "views/HomePage/Products.php",
    data: form_data,
    beforeSend: function()
    {
      $("#dynamic-content-1").html(spinner);
    },
    success: function(data){
      $("#dynamic-content-1").html(data);
    },
    error: function(xhr)
    {
      var retry=`
      <div class="d-flex justify-content-center">
      <button type="button" class="btn btn-outline-danger btn-sm btn-rounded waves-effect" onclick="SearchProducts(search)"><i class="fas fa-history"></i> Retry</button>
      </div>
      `;
      
      $('#dynamic-content-1').html(retry);

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

function LoadHomePage()
{
  GetProductCategories();
  GetProducts();
}

LoadHomePage();





// Add minus icon for collapse element which is open by default
$(".collapse.show").each(function(){
  $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
});

// Toggle plus minus icon on show hide of collapse element
$(".collapse").on('show.bs.collapse', function(){
  $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
}).on('hide.bs.collapse', function(){
  $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
});


function ShowPassword() {
  var x = document.getElementById("password");
  var y = document.getElementById("password1");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }

  if (y.type === "password") {
    y.type = "text";
  } else {
    y.type = "password";
  }
}