@include('head')
<style>
   body,
   div,
   form,
   input,
   select,
   textarea,
   p {
       padding: 0;
       margin: 0;
       outline: none;
       font-size: 14px;
       color: #666;
       line-height: 22px;
   }

   .testbox {
       display: flex;
       justify-content: center;
       align-items: center;
       height: inherit;
       padding: 20px;
   }
   
   form {
       width: 60%;
       padding: 20px;
       border-radius: 6px;
       background: #fff;
       box-shadow: 0 0 30px 0 #a37547;
   }
   
   .banner {
       position: relative;
       height: 180px;
       background-image: url("/uploads/media/default/0001/02/3dd647f39593e88f45f61aaac6ff3027dce15506.jpeg");
       background-size: cover;
       display: flex;
       justify-content: center;
       align-items: center;
       text-align: center;
   }
   
   .banner::after {
       content: "";
       background-color: rgba(0, 0, 0, 0.4);
       position: absolute;
       width: 100%;
       height: 100%;
   }
   
   input,
   select,
   textarea {
       margin-bottom: 10px;
       border: 1px solid #ccc;
       border-radius: 3px;
   }
   
   input {
       width: calc(100% - 10px);
       padding: 5px;
   }
   
   select {
       width: 100%;
       padding: 7px 0;
       background: transparent;
   }
   
   textarea {
       width: calc(100% - 12px);
       padding: 5px;
   }
   
   .item:hover p,
   .item:hover i,
   .question:hover p,
   .question label:hover,
   input:hover::placeholder {
       color: #a37547;
   }
   
   .item input:hover,
   .item select:hover,
   .item textarea:hover {
       border: 1px solid transparent;
       box-shadow: 0 0 6px 0 #a37547;
       color: #a37547;
   }
   
   .item {
       position: relative;
       margin: 10px 0;
   }
   
   input[type=radio],
   input[type=checkbox] {
       display: none;
   }
   
   label.radio {
       position: relative;
       display: inline-block;
       margin: 5px 20px 15px 0;
       cursor: pointer;
   }
   
   .question span {
       margin-left: 30px;
   }
   
   label.radio:before {
       content: "";
       position: absolute;
       left: 0;
       width: 17px;
       height: 17px;
       border-radius: 50%;
       border: 2px solid #ccc;
   }
   
   input[type=radio]:checked+label:before,
   label.radio:hover:before {
       border: 2px solid #a37547;
   }
   
   label.radio:after {
       content: "";
       position: absolute;
       top: 6px;
       left: 5px;
       width: 8px;
       height: 4px;
       border: 3px solid #a37547;
       border-top: none;
       border-right: none;
       transform: rotate(-45deg);
       opacity: 0;
   }
   
   input[type=radio]:checked+label:after {
       opacity: 1;
   }
   
   .btn-block {
       margin-top: 10px;
       text-align: center;
   }
   
   button {
       width: 150px;
       padding: 10px;
       border: none;
       border-radius: 5px;
       background: #6b4724;
       font-size: 16px;
       color: #fff;
       cursor: pointer;
   }
   
   button:hover {
       box-shadow: 0 0 18px 0 #3d2914;
   }
   
   @media (min-width: 568px) {
       .name-item,
       .city-item {
           display: flex;
           flex-wrap: wrap;
           justify-content: space-between;
       }
       .name-item input,
       .city-item input {
           width: calc(50% - 20px);
       }
       .city-item select {
           width: calc(50% - 8px);
       }
   }
   </style>
<body style=" background: linear-gradient(#facfcf, #9198e5);;">
    <div class="testbox" style="margin:5%;">
        <form method="post" action="{{url('contact1')}}"  enctype="multipart/form-data"> 
        {{csrf_field()}}
        
        <h1>Contact Us</h1>
        @error('custom_name')
        <div class="form-group" style="text-align:center; color:black; background:pink; width:97%; padding:15px; border-radius:10px;">
            <b>{{$message}}</b>
        </div><br/>
        @enderror

        <div class="banner">
            <img src="bg.png" width=100% height=100%>
        </div>
     
        <div class="item">
            <p>Name :</p>
            <input type="text" name="name" placeholder="Enter your name here"/>
        </div>
        @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
        <div class="item">
            <p>Email :</p>
            <input type="email" name="email" placeholder="Enter your email address here"/>
        </div>
        @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif

        <div class="item">
            <textarea name="message" rows="8" placeholder="Write your message here........."></textarea>
        </div>
        @if ($errors->has('content'))
            <span class="text-danger">{{ $errors->first('content') }}</span>
        @endif
        <input type="hidden" name="postedon" value="<?php echo now();?>"/>
        <input type="hidden" name="postedby" value=" {{ Auth::user()->name }}"/>
        <div class="btn-block" >
            <button type="submit" style="width:30%; background-color:green;">Send</button>
        </div>
        </form> 
    </div>
</body>
</html>