<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="_token" content="{{csrf_token()}}" />
    <title>Blog</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
 
    <div class="alert alert-success" style="display:none"></div>
   <form id="myForm" action="/blog/update">
    
        <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="title" value="{{ $Blog->title}}">
        <input type="hidden" class="form-control" id="id" value="{{ $Blog->id}}">
        </div>
        <div class="form-group">
        <label for="type">Type:</label>
        <textarea name="content" id="content" cols="30" rows="10" class="form-control" >{{ $Blog->content}}</textarea>
        </div>
        <button class="btn btn-primary" id="ajaxSubmit">Edit</button>  
        
    </form> 

 </div>
<script> 

jQuery(document).ready(function(){
       $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
             }
         });   

         jQuery('#ajaxSubmit').click(function(e){
               e.preventDefault();
               jQuery.ajax({
                  url: "{{ url('/blog/update') }}",
                  method: 'post',
                  data: {
                     title: jQuery('#title').val(),
                     content: jQuery('#content').val(),
                     id: jQuery('#id').val(),    
                  },
                  success: function(result){
     
                     jQuery('.alert').show();
                     jQuery('.alert').html(result.success);
                  }});
              });
        
    });
</script>


</body>
</html>