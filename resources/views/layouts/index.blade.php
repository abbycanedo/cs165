<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Bags | @yield('title') </title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="bookmark" href="favicon_16.ico"/>
    <!-- site css -->
    <link rel="stylesheet" href="/dist/css/site.min.css">
    <link rel="stylesheet" href="/bootflat-admin/css/site.min.css">
    <link rel="stylesheet" href="/bootflat-admin/css/site.css">
    <link rel="stylesheet" href="/bootflat-admin/css/additional.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
    <!--site script-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="/bootflat-admin/js/site.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="/dist/js/site.min.js"></script>
    <script type="text/javascript" src="/dist/js/bootbox.min.js"></script>
  </head>
  <body>

    <!--nav-->
    <nav role="navigation" class="navbar navbar-custom">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button data-target="#bs-content-row-navbar-collapse-5" data-toggle="collapse" class="navbar-toggle" type="button">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a href="{{route('home')}}" class="navbar-brand" style="color:#FFF; font-weight=700">BAGS</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div id="bs-content-row-navbar-collapse-5" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="{{ route('home') }}">Shop</a></li>
              @if (Auth::guest())
                <li class="dropdown">
                  <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    Welcome!
                  <b class="caret"></b></a>
                  <ul role="menu" class="dropdown-menu">
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ url('/register/admin') }}">Register as Admin</a></li>
                    <li><a href="{{ url('/register/customer') }}">Register as Customer</a></li>
                  </ul>
                </li>
              @else
                  <li class="active"><a href="{{route('transaction.view', Auth::user()->getKey())}}">Transactions</a></li>
                @if(Auth::user()->isadmin == 1)
                  <li class="active"><a href="{{ url('products') }}">Products</a></li>
                @else
                  <li class="active"><a href="{{route('cart.view', Auth::user()->getKey())}}">Cart</a></li>
                @endif
                <li class="dropdown">
                  <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    {{ Auth::user()->firstname }}
                  <b class="caret"></b></a>
                  <ul role="menu" class="dropdown-menu">
                    <li><a href="{{ route('profile', Auth::user()->getKey() ) }}">View Profile</a></li>
                    <li><a href="{{ route('profile.edit', Auth::user()->getKey()) }}">Edit Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ url('/logout')}}">Signout</a></li>
                  </ul>
                </li>
              @endif
    <!-- @yield('top-navigation')-->
            </ul>

          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <!--header-->
    <div class="container-fluid">
    <!--documents-->
      <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
          <ul class="list-group panel">
              <li class="list-group-item"><b>MENU</b></li>
              <!--Search
              <li class="list-group-item"><input type="text" class="form-control search-query" placeholder="Search Something"></li>
              -->
              <li class="list-group-item">
                <a href="{{ route('home') }}" >
                  <i class="glyphicon glyphicon-home"></i>Shop
                </a>
              </li>
              @if (Auth::guest())
                <li class="list-group-item">
                  <a href="{{ url('/login') }}">
                    <i class="glyphicon glyphicon-lock"></i>Login
                  </a>
                </li>
                <li>
                  <a href="#demo3" class="list-group-item " data-toggle="collapse">
                    <i class="glyphicon glyphicon-user"></i>Register Account
                    <span class="glyphicon glyphicon-chevron-right"></span>
                  </a>
                  <div class="collapse" id="demo3">
                    <a href="{{ url('/register/admin') }}" class="list-group-item">Admin Account</a>
                    <a href="{{ url('/register/customer') }}" class="list-group-item">Customer Account</a>
                  </div>
                </li>
              @else
                @if(Auth::user()->isadmin == 1)
                  <li class="list-group-item">
                    <a href="{{route('transaction.view', Auth::user()->getKey())}}" >
                      <i class="glyphicon glyphicon-briefcase"></i>Transactions
                    </a>
                  </li>
                  <li class="list-group-item">
                    <a href="{{ url('products') }}" >
                      <i class="glyphicon glyphicon-tag"></i>Products
                    </a>
                  </li>
                @else
                  <li class="list-group-item">
                    <a href="{{route('transaction.view', Auth::user()->getKey())}}" >
                      <i class="glyphicon glyphicon-briefcase"></i>Transactions
                    </a>
                  </li>
                  <li class="list-group-item">
                    <a href="{{route('cart.view', Auth::user()->getKey())}}" >
                      <i class="glyphicon glyphicon-shopping-cart"></i>Cart
                    </a>
                  </li>
                @endif
              @endif

              @yield('sidebar-menu')
            </ul>
        </div>
        <div class="col-xs-12 col-sm-9 content">
          @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissable">
              {{ Session::get('error') }}
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
          @endif
          @if (Session::has('success'))
            <div class="alert alert-success alert-dismissable">
              {{ Session::get('success') }}
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
          @endif
          @if (Session::has('message'))
            <div class="alert alert-info alert-dismissable">
              {{ Session::get('message') }}
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
          @endif
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">
                <a href="javascript:void(0);" class="toggle-sidebar">
                  <span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Menu"></span>
                  <b>
                    @yield('panel-title')
                  </b>
                </a>
              </h3>
            </div>
            <div class="panel-body">
              @yield('panel-body')
            </div><!-- panel body -->
          </div>
        </div><!-- content -->
      </div>
    </div>

    <!--footer-->
    <div class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h3>Talk to us</h3>
            <ul>
              <li>Tweet us at <a href="https://twitter.com" target="_blank">@bags_twitter</a>&nbsp;&nbsp;&nbsp;&nbsp;Email us at <span class="connect">info@bags.com</span></li>
              <li>
                <a title="Twitter" href="https://twitter.com" target="_blank" rel="external nofollow"><i class="icon" data-icon="&#xe121"></i></a>
                <a title="Facebook" href="https://www.facebook.com" target="_blank" rel="external nofollow"><i class="icon" data-icon="&#xe10b"></i></a>
              </li>
            </ul>
          </div>
          <div class="col-md-6">
            <!-- Begin MailChimp Signup Form -->
            <link href="//cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
            <div id="mc_embed_signup">
            <h3 style="margin-bottom: 15px;">Newsletter</h3>
            <!-- <form action="" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" novalidate> -->
                <input style="margin-bottom: 10px;" type="email" value="" name="EMAIL" class="email form-control" id="mce-EMAIL" placeholder="email address" required>
                <span class="clear"><button type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-primary">Subscribe</button>
            <!-- </form> -->
            </div>
            <!--End mc_embed_signup-->
          </div>
        </div>
        <hr class="dashed" />
        <div class="copyright clearfix">
          <p>
            <b>BAGS</b>
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="#">User Guide</a>
            &nbsp;&bull;&nbsp;<a href="https://github.com/abbycanedo/cs165/blob/master/docs/diagrams/CS%20165%20ERD.pdf">ER Diagram</a>
            &nbsp;&bull;&nbsp;<a href="https://github.com/abbycanedo/cs165/blob/master/docs/diagrams/CS%20165%20Schema.pdf">Database Schema</a>
            &nbsp;&bull;&nbsp;<a href="http://bootflat.github.io/">Bootflat</a>
          </p>
          <p>Project for CS 165. No items in here are for sale, all items are taken from <a href="www.polyvore.com">Polyvore</a>.</p>
        </div>
      </div>
    </div>
    @yield('scripts')
  </body>
</html>