<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from bootstrapmaster.com/live/metro/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Jan 2018 16:56:12 GMT -->
<head>

    <!-- start: Meta -->
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="Metro Admin Template.">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- end: Meta -->

    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end: Mobile Specific -->

    <!-- start: CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" integrity="sha384-wESLQ85D6gbsF459vf1CiZ2+rr+CsxRY0RpiF1tLlQpDnAgg6rwdsUF1+Ics2bni" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/')}}/css/font-awesome.css">
    <link id="bootstrap-style" href="{{asset('/')}}/back-end/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('/')}}/back-end/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link id="base-style" href="{{asset('/')}}/back-end/css/style.css" rel="stylesheet">
    <link id="base-style-responsive" href="{{asset('/')}}/back-end/css/style-responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/')}}/back-end/css/all.min.css">
    <link rel="stylesheet" href="{{asset('/')}}/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('/')}}/css/select2-bootstrap.min.css">

{{--    <link rel="stylesheet" href="{{asset('/')}}/back-end/css/adminlte.min.css">--}}
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
    <!-- end: CSS -->


    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <link id="ie-style" href="{{asset('/')}}/back-end/css/ie.css" rel="stylesheet">
    <![endif]-->

<!--[if IE 9]>
        <link id="ie9style" href="{{asset('/')}}/back-end/css/ie9.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <![endif]-->

    <!-- start: Favicon -->
    <link rel="shortcut icon" href="{{asset('/')}}/back-end/img/favicon.ico">
    <!-- end: Favicon -->
    <script type="text/javascript" src="{{asset('/')}}/js/jquery-validation.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>
    <script src="{{asset('/')}}/back-end/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}/back-end/js/adminlte.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}/back-end/js/demo.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <style type="text/css">
        .notifyjs-corner{
            z-index: 10000 !important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<!-- start: Header -->
@include('back-end.includes.header')
<!-- start: Header -->

<div class="container-fluid-full">
    <div class="row-fluid">

        <!-- start: Main Menu -->
    @include('back-end.includes.sidebar')
    <!-- end: Main Menu -->

        <noscript>
            <div class="alert alert-block span10">
                <h4 class="alert-heading">Warning!</h4>
                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
            </div>
        </noscript>

        <!-- start: Content -->
        @yield('content')
        @if(session()->has('message'))
            <script type="text/javascript">
                $(function(){
                    $.notify("{{session()->get('message')}}",{
                        globalPosition:'top right' ,className:'message'
                    });
                });
            </script>
        @endif
        @if(session()->has('error'))
            <script type="text/javascript">
                $(function(){
                    $.notify("{{session()->get('error')}}",{
                        globalPosition: 'top right',
                        className: 'error'
                    });
                });
            </script>
        @endif
    <!--/.fluid-container-->

        <!-- end: Content -->
    </div><!--/#content.span10-->
</div><!--/fluid-row-->

<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Settings</h3>
    </div>
    <div class="modal-body">
        <p>Here settings can be configured...</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
        <a href="#" class="btn btn-primary">Save changes</a>
    </div>
</div>

<div class="clearfix"></div>

@include('back-end.includes.footer')

<!-- start: JavaScript-->

<script src="{{asset('/')}}/back-end/js/jquery-1.9.1.min.js"></script>
<script src="{{asset('/')}}/back-end/js/jquery-migrate-1.0.0.min.js"></script>

<script src="{{asset('/')}}/back-end/js/jquery-ui-1.10.0.custom.min.js"></script>

<script src="{{asset('/')}}/back-end/js/jquery.ui.touch-punch.js"></script>

<script src="{{asset('/')}}/back-end/js/modernizr.js"></script>

<script src="{{asset('/')}}/back-end/js/bootstrap.min.js"></script>

<script src="{{asset('/')}}/back-end/js/jquery.cookie.js"></script>

<script src='{{asset('/')}}/back-end/js/fullcalendar.min.js'></script>

<script src='{{asset('/')}}/back-end/js/jquery.dataTables.min.js'></script>

<script src="{{asset('/')}}/back-end/js/excanvas.js"></script>
<script src="{{asset('/')}}/back-end/js/jquery.flot.js"></script>
<script src="{{asset('/')}}/back-end/js/jquery.flot.pie.js"></script>
<script src="{{asset('/')}}/back-end/js/jquery.flot.stack.js"></script>
<script src="{{asset('/')}}/back-end/js/jquery.flot.resize.min.js"></script>

<script src="{{asset('/')}}/back-end/js/jquery.chosen.min.js"></script>

<script src="{{asset('/')}}/back-end/js/jquery.uniform.min.js"></script>

<script src="{{asset('/')}}/back-end/js/jquery.cleditor.min.js"></script>

<script src="{{asset('/')}}/back-end/js/jquery.noty.js"></script>

<script src="{{asset('/')}}/back-end/js/jquery.elfinder.min.js"></script>

<script src="{{asset('/')}}/back-end/js/jquery.raty.min.js"></script>

<script src="{{asset('/')}}/back-end/js/jquery.iphone.toggle.js"></script>

<script src="{{asset('/')}}/back-end/js/jquery.uploadify-3.1.min.js"></script>

<script src="{{asset('/')}}/back-end/js/jquery.gritter.min.js"></script>

<script src="{{asset('/')}}/back-end/js/jquery.imagesloaded.js"></script>

<script src="{{asset('/')}}/back-end/js/jquery.masonry.min.js"></script>

<script src="{{asset('/')}}/back-end/js/jquery.knob.modified.js"></script>

<script src="{{asset('/')}}/back-end/js/jquery.sparkline.min.js"></script>

<script src="{{asset('/')}}/back-end/js/counter.js"></script>

<script src="{{asset('/')}}/back-end/js/retina.js"></script>

<script src="{{asset('/')}}/back-end/js/custom.js"></script>
<script src="{{asset('/')}}/js/handlebars.min.js"></script>
<script src="{{asset('/')}}/js/bootstrap-notify.min.js"></script>
<script src="{{asset('/')}}/js/notify.min.js"></script>
<script src="{{asset('/')}}/js/select2.full.min.js"></script>


<!-- end: JavaScript-->

</body>

<!-- Mirrored from bootstrapmaster.com/live/metro/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Jan 2018 16:56:47 GMT -->
// Sweet Alert for Delete....
<script type="text/javascript">
    $(function(){
       $(document).on('click','#delete',function(e){
          e.preventDefault();
          var link = $(this).attr("href");
           Swal.fire({
               title: 'Are you sure?',
               text: "Delete this data!",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Yes, delete it!'
           }).then((result) => {
               if (result.isConfirmed) {
                   window.location.href = link;
                   Swal.fire(
                       'Deleted!',
                       'Your file has been deleted.',
                       'success'
                   )
               }
           })
       });
    });
</script>

//Sweet alert for Approve.....
<script type="text/javascript">
    $(function(){
       $(document).on('click','#approveBtn',function(e){
          e.preventDefault();
          var link = $(this).attr("href");
           Swal.fire({
               title: 'Are you sure?',
               text: "Approve this data!",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Yes, Approve it!'
           }).then((result) => {
               if (result.isConfirmed) {
                   window.location.href = link;
                   Swal.fire(
                       'Approved!',
                       'Your file has been approved.',
                       'success'
                   )
               }
           })
       });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
       $('#image').change(function(e){
          var reader = new FileReader();
          reader.onload = function(e){
              $('#showImage').attr('src',e.target.result);
          }
          reader.readAsDataURL(e.target.files['0']);
       });
    });
</script>
<script type="text/javascript">
    $(function(){
        $('.select2').select2();
    });
</script>
</html>
