<h1>About US</h1>
<hr>
<form action="@if(isset($about)){{url("updateAbout")}}/{{$about->id}}@else {{url("createAbout")}}@endif" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    @if(isset($errors))
        @foreach($errors->about->all() as $message)
            {{$message}}
        @endforeach
    @endif
    <input type="text" name="title" value="@if(isset($about)){{$about->title}}@endif" placeholder="Enter Title">
    <br>
    <textarea name="details" id="" cols="30"
              rows="10">@if(isset($about)){{$about->details}}@endif</textarea>
    <br>
    <input type="file" name="image">
    @if(isset($about))
        <img src="{{asset("/upload/")}}/{{$about->image}}" style="width:50px;height: 50px;" />
    @endif
    <br>
    <input type="submit" name="submit" value="send">
</form>
<br>
<form action="@if(session("editPerson")){{url("updatePerson")}}/{{session("editPerson")->id}}@else{{url("createPerson")}}@endif" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    @if(isset($errors))
        @foreach($errors->person->all() as $message)
            {{$message}}
        @endforeach
    @endif
    <input type="text" name="name" value="@if(session("editPerson")){{session("editPerson")->name}}@endif">
    <br>
    <input type="text" name="job" value="@if(session("editPerson")){{session("editPerson")->job}}@endif" placeholder="Enter Job">
    <input type="file" name="image">
    @if(session("editPerson"))
        <img src="{{asset("/upload/")}}/{{session("editPerson")->image}}" style="width:50px;height: 50px;" />
    @endif
    <br>
    <input type="submit" name="submit" value="send">
</form>
<br>
<table border="1">
    <tr>
        <th>id</th>
        <th>image</th>
        <th>name</th>
        <th>edit</th>
        <th>delete</th>
    </tr>
    @if(isset($persons))
        @foreach($persons as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td><img src="{{asset("/upload/")}}/{{$item->image}}" style="width:50px;height: 50px;" /></td>
                <td>{{$item->name}}</td>
                <td><a href="{{url("editPerson")}}/{{$item->id}}">edit</a></td>
                <td><a href="{{url("deletePerson")}}/{{$item->id}}">del</a></td>
            </tr>
        @endforeach
    @endif
</table>