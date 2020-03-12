<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Blog</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<main class="py-4">
  <div class="container">
  <h2>BLOG</h2>
  <button style="float:right;" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Create</button>   
  <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Content</th>
        <th>User_id</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="show">
    </tbody>
  </table>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">ADD</h4>
        </div>
        <div class="modal-body">    
                <div class="alert alert-success" style="display:none"></div>
                <form id="myForm">
                    <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="title">
                    </div>
                    <div class="form-group">
                    <label for="type">Type:</label>
                    <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <button type="button" class="btn btn-primary" id="ajaxSubmit">Submit</button> 
                </form> 
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title1">Edit</h4>
        </div>
        <div class="modal-body">    
                <div class="alert alert-success" style="display:none"></div>
                <form id="myForm">
           
                    <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="title1">
                    </div>
                    <div class="form-group">
                    <label for="type">Type:</label>
                    <textarea name="content" id="content1" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <button type="button" class="btn btn-primary" id="ajaxSubmit1">Submit</button> 
                    <input type="hidden" class="form-control" id="id">
                </form> 
        </div>
      </div>
    </div>
  </div>
</div>
</main>
  <script>
 
    $(document).ready(function(){
      $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });   
       viewData();
       function viewData(){
          $.ajax({
            type: "Get",
            url: "{{ url('/blog') }}",
            dataType: "json",
            success:function(data){
              var html = '';
               var i;
               var ulrs= "{{ url('/blog') }}";
               for(i=0; i<data.length; i++){
                       var name = data[i].name;
                       html += '<tr>'+
                                '<td>'+data[i].id+'</td>'+
                               '<td>'+data[i].title+'</td>'+
                               '<td>'+data[i].content+'</td>'+
                               '<td>'+data[i].user_id+'</td>'+
                               '<td> <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'+data[i].id+'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBlog">Edit</a>  <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'+data[i].id+'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBlog">Delete</a> </td>'+
                               '</tr>';
                       }
                    $('#show').html(html);
            }
          });
       }
      //submit  
       $("#ajaxSubmit").click(function() {
         var val = 1 ;
          $.ajax({
            type:"post",
            url: "{{ url('/blog/store') }}",
            data:{
              title: jQuery('#title').val(),
              content: jQuery('#content').val(),
            },
            success:function(result){
              viewData();
              jQuery('.alert').show();
              jQuery('.alert').html(result.success);
            }
          });
       });
  // when click
     $('body').on('click', '.editBlog', function () {
        var id = $(this).data('id');
         var urls = "{{url('/blog/edit') }}" ;
        $.get(urls + "/"+ id, function (data) {
          $('#myModal1').modal('show');
          $('#title1').val(data.title);
          $('#content1').val(data.content);
          $('#id').val(data.id);
       });
     });


 //update

    $("#ajaxSubmit1").click(function() {
          $.ajax({
            type:"Post",
            url: "{{ url('/blog/update') }}",
            data:{
              title: $('#title1').val(),
              content: $('#content1').val(),
              id: $('#id').val(),    
            },
            success:function(result){
              viewData();
              $('.alert').show();
              $('.alert').html(result.success);
            }
          });
       });
  // delete 

    $('body').on('click', '.deleteBlog', function () {
        var id = $(this).data('id');
        var url = "{{url('/blog/delete') }}"
        var url1 = ""+url+"/"+id
        console.log(id);
        $.ajax({
            type:"get",
            url: url1 ,
            success:function(result){
                alert(result.success);
               viewData();
            }
          });
     });


    });
 </script>


</body>
</html>