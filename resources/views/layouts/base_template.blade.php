<!doctype html>
<html lang="en">
<head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="icon" href="favicon.ico">
    <title>{{ $page_title ?? 'Title'  }}</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Template CSS Files
    ================================================== -->
    <!-- Twitter Bootstrs CSS -->
    <link rel="stylesheet" href="{{ asset("plugins")  }}/bootstrap/bootstrap.min.css">
    <!-- Ionicons Fonts Css -->
    <link rel="stylesheet" href="{{ asset("plugins")  }}/ionicons/ionicons.min.css">
    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset("plugins")  }}/animate-css/animate.css">
    <!-- Hero area slider css-->
    <link rel="stylesheet" href="{{ asset("plugins")  }}/slider/slider.css">
    <!-- slick slider -->
    <link rel="stylesheet" href="{{ asset("plugins")  }}/slick/slick.css">
    <!-- Fancybox -->
    <link rel="stylesheet" href="{{ asset("plugins")  }}/facncybox/jquery.fancybox.css">
    <!-- hover -->
    <link rel="stylesheet" href="{{ asset("plugins")  }}/hover/hover-min.css">
    <!-- template main css file -->
    <link rel="stylesheet" href="{{ asset("css/style.css")  }}">

    <!-- CKEditor CSS -->
    <link rel="stylesheet" href="{{ asset("css/CKEditor_CSS.css")  }}">
</head>

<body>
    <!--
        ==================================================
        Header Section Start
        ================================================== -->
    @extends('layouts.header')
    <!-- /#Header -->

    @yield('content')

    @yield('scripts')

    <!-- Template Javascript Files
                ================================================== -->
    <!-- jquery -->
    <script src="{{ asset("plugins") }}/jQurey/jquery.min.js"></script>
    <!-- Form Validation -->
    <script src="{{ asset("plugins") }}/form-validation/jquery.form.js"></script>
    <script src="{{ asset("plugins") }}/form-validation/jquery.validate.min.js"></script>
    <!-- slick slider -->
    <script src="{{ asset("plugins") }}/slick/slick.min.js"></script>
    <!-- bootstrap js -->
    <script src="{{ asset("plugins") }}/bootstrap/bootstrap.min.js"></script>
    <!-- wow js -->
    <script src="{{ asset("plugins") }}/wow-js/wow.min.js"></script>
    <!-- slider js -->
    <script src="{{ asset("plugins") }}/slider/slider.js"></script>
    <!-- Fancybox -->
    <script src="{{ asset("plugins") }}/facncybox/jquery.fancybox.js"></script>
    <!-- template main js -->
    <script src="js/main.js"></script>



</body>

</html>
