@include('head')<br/>

<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

@if(isset($findrec[0]))
    <p><h2 style="text-align:center;">{{isset($findrec[0]->title) ? $findrec[0]->title:""}}</h2></p>
    
    <div style="width:350px; height:auto; margin:auto;"><p ><img name="image" src="{{asset('storage/images/'. $findrec[0]->image)}}" height=350px width=300px/></p></div>

    <p style="text-align:center;">{{isset($findrec[0]->content) ? $findrec[0]->content:""}}</p>
    <p style="text-align:center;"> Posted By: {{isset($findrec[0]->postedby) ? $findrec[0]->postedby:""}}</p>
    <p style="text-align:center;"> Posted on: {{isset($findrec[0]->postedon) ? $findrec[0]->postedon:""}}</p>

    
@if(Auth::user())

<form action="{{url('comm/'.$findrec[0]->id)}}"  method="post" style="width:90%; margin:auto;"> 
{{csrf_field()}}
    <input type="hidden" name="post_id" value="{{isset($findrec[0]->id) ? $findrec[0]->id:""}}">
    <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
    <input type="hidden" name="user"  value="{{ Auth::user()->name}}"> 
    <textarea class="form-control" name="comment" rows="3" placeholder="Add a Comment"></textarea><br/>
    <input type="hidden" name="postedby" value="{{ Auth::user()->name }}"/>
   
    <button  type="submit"  class="btn btn-success">Post</button></a>
</form>
@else

<a href="" style="margin-left:60px;">Login to add a Comment</a>
</div>
<br/>
 </form>
@endif
@endif
<br/>
<h5 style="margin-left:78px; color:grey;">Comments: </h5>

   
@if(isset($cmnts))
    @foreach($cmnts as $row)

<div class="flex justify-center relative top-1/3">
<!-- This is an example component -->
<div class="relative grid grid-cols-1 gap-4 p-4 mb-12 border rounded-lg bg-white shadow-lg" style="width:90%; height:160px; ">
    <div class="relative flex gap-4">
        <!-- <img src="https://icons.iconarchive.com/icons/diversity-avatars/avatars/256/charlie-chaplin-icon.png" class="relative rounded-lg -top-8 -mb-4 bg-white border h-20 w-20" alt="" loading="lazy"> -->
        <div class="flex flex-col w-full">
            <div class="flex flex-row justify-between">
                <p class="relative text-xl whitespace-nowrap truncate overflow-hidden">{{$row->User->name}}</p>
                <a class="text-gray-500 text-xl" href="#"><i class="fa-solid fa-trash"></i></a>
            </div>
            <p class="text-gray-400 text-sm">Posted On: {{$row->created_at}}</p>
        </div>
    </div>
</div>

</div>

    @endforeach 
@endif


