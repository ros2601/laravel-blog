@include('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('http://localhost/laravel/blog/resources/css/app.css')}}">
<!-- ---------------------------------------------------------------------------------------------------- -->

@if(isset($product))
@foreach($product as $row)

<div class="container d-flex justify-content-center" style="text-align:center;">
    <div class="col-md-12 mt-5 card2">

<form action="{{url('detail/'.$row->id)}}" method="post" > 
{{csrf_field()}}
	<a href="{{url('detail/'.$row->id)}}"><img src="storage/images/{{$row->image}}" height=200px width=300px></a>
    <b style="font-size:20px; color:black; margin-left:100px;">{{$row->title}}</b>
    <!-- <button type="button" class="btn btn-dark">Read More</button> -->
    </div>
</div>
</form>
@endforeach
@endif
<!-- ---------------------------------------------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------------------------------------------- -->

@if(isset($findrec))
@foreach($findrec as $row)

<div class="container d-flex justify-content-center" style="text-align:center;">
    <div class="col-md-12 mt-5 card2">

<form action="{{url('detail/'.$row->id)}}" method="post" > 
{{csrf_field()}}
	<a href="{{url('detail/'.$row->id)}}"><img src="storage/images/{{$row->image}}" height=200px width=300px></a>
    <b style="font-size:20px; color:black; margin-left:100px;">{{$row->title}}</b>
    </div>
</div>
</form>
@endforeach
@endif

<!-- ---------------------------------------------------------------------------------------------------- -->

@if(isset($user))
<br/><h2 style="color:black; margin-left:45%; font-weight:bold; font-family:cursive; text-shadow:0 1px 2px grey; text-decoration:underline;">Posts by {{ Auth::user()->name }} </h2>  
@foreach($user as $row)
<div class="container d-flex justify-content-center" style="text-align:center;">
    <div class="col-md-12 mt-5 card2">
            <form action="{{url('detail/'.$row->id)}}" method="post" > 
            {{csrf_field()}}
	            <a href="{{url('detail/'.$row->id)}}"><img src="storage/images/{{$row->image}}" height=200px width=300px></a>
                <b style="font-size:20px; color:black; margin-left:100px;">{{$row->title}}</b>&nbsp;
                <a href="{{'delete/'.$row->id}}" onclick="return confirm('Are you sure you want to delete this post?')"><img src="delete.jpeg" width=20px height=20px></a>
            </form>
    </div>
</div>
@endforeach
@endif