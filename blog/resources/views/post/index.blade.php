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
            <div class="alert alert-success alert-dismissable">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
               {{ session('status')}}
            </div>
            @endif
            <form class="form-vertical" role="form" method="post" action="/post">
               {{csrf_field()}}
               <div class="form-group">
                  <input type="text" name="title" class="form-control" placeholder="Title">
               </div>
               <div class="form-group">
                  <textarea class="form-control" rows="5" name="body" class="form-control" placeholder="Content"></textarea>
               </div>
               <div class="form-group">
                  <button type="submit" class="btn btn-info">Submit Post</button>
               </div>
            </form>
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>Title</th>
                     <th>Content </th>
                     <th>Edit</th>
                     <th>Delete</th>
                  </tr>
               </thead>
               @foreach($posts as $post)
               <tbody>
                  <tr>
                     <td>{{$post->title}}</td>
                     <td>{{$post->body}}</td>
                     <form action="{{route('edit.post', $post->id)}}" method="GET">
                        <td>
                           <p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-success btn-xs" ><span class="fa fa-pencil fa-fw"></span></button></p>
                        </td>
                     </form>
                     <form action="{{route('destroy.post', $post->id)}}" method="POST">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <td>
                           <p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" ><span class="fa fa-fw fa-trash"></span></button></p>
                        </td>
                     </form>
                  </tr>
               </tbody>
               @endforeach
            </table>
         </div>
      </div>
   </body>
</html>