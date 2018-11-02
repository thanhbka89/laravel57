<!DOCTYPE html>
<html>
   <head>
      <meta name="viewport" content="width=device-width">
      <title>Laravel Repositories and Services</title>
      <meta name="description" content="">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" crossorigin="anonymous">
   </head>
   <body>
      <div class="container">
         <div class="col-md-5">
            <h4 class="page-header">Laravel Repositories and Services </h4>
            @foreach ($errors->all() as $error)
            <p class="alert alert-danger">{{ $error }}</p>
            @endforeach 
            @if (session('status'))
            <div class="alert alert-success">
               {{ session('status')}}
            </div>
            @endif
            <form class="form-vertical" role="form" method="post" action="{{route('update.post', $post->id)}}">
               {{csrf_field()}}
               {{method_field('PUT')}}
               <div class="form-group">
                  <input type="text" name="title" class="form-control" placeholder="Title" value="{{$post->title}}">
               </div>
               <div class="form-group">
                  <textarea class="form-control" rows="5" name="body" class="form-control" placeholder="Content">{{$post->body}}</textarea>
               </div>
               <div class="form-group">
                  <button type="submit" class="btn btn-info">Update Post</button>
               </div>
            </form>
         </div>
      </div>
   </body>
</html>