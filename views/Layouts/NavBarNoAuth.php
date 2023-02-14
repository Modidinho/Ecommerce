<nav class="navbar fixed-top navbar-expand-lg navbar-light white mx-2 mb-3" style="opacity:0.9">

<!-- SideNav slide-out button -->
<div class="float-left mr-1">
    <a href="">
        <img class="img-fluid rounded-circle mh-50 bg-white" src="<?php echo app_logo;?>"
            style="max-height:30px;" alt=" logo">
    </a>

</div>


<!-- Collapse button -->
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1"
    aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<!-- Collapsible content -->
<div class="collapse navbar-collapse" id="navbarSupportedContent1">

    <!-- Links -->
    <ul class="navbar-nav mr-auto">

        <!-- News -->
        <li class="nav-item dropdown mega-dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink1"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <i class="fas fa-search"></i> Search
            </a>
            <div class="dropdown-menu mega-menu v-1 z-depth-1 white py-5 px-3"
                aria-labelledby="navbarDropdownMenuLink1">
                <div class="row">
                    <div class="col-md-12 col-xl-12 sub-menu mb-xl-0 mb-5">
                        <div class="md-form input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" id="material-addon1"><i
                                        class="fas fa-search"></i></span>
                            </div>
                            <input type="text" name="search"
                                class="form-control font-weight-bold search-field"
                                onkeyup="SearchProducts()" placeholder="Search for products"
                                aria-label="Search" aria-describedby="material-addon1">
                        </div>
                    </div>
                </div>
            </div>
        </li>

    </ul>
    <!-- Links -->

    <!-- Links -->
    <ul class="navbar-nav nav-flex-icons ml-auto">
        <li class="nav-item">
            <a href="" class="nav-link waves-effect"><i class="far fa-home"></i> <span
                    class="clearfix d-none d-sm-inline-block">HOME</span></a>
        </li>

        <li class="nav-item dropdown ml-3">
            <a class="nav-link dropdown-toggle waves-effect btn blue-gradient btn-rounded btn-sm waves-effect waves-light"
                href="#" id="AccountDropdown" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false"> 
                <i class="fas fa-user"></i>
                <span class="clearfix d-none d-sm-inline-block font-weight-bold text-white">My Account</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="AccountDropdown">
            <a class="dropdown-item waves-effect waves-light link log-in-link" href="#">
                     <i class="far fa-sign-in-alt"></i> Sign In
                </a>
                <a class="dropdown-item waves-effect waves-light link create-account-link" href="#"> 
                    <i class="far fa-circle"></i> Create Account
                </a>

            </div>
        </li>


    </ul>
    <!-- Links -->

</div>
<!-- Collapsible content -->

</nav>