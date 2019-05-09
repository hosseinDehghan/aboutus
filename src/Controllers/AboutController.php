<?php

namespace Hosein\Aboutus\Controllers;

use Hosein\Aboutus\About;
use Hosein\Aboutus\Personal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    public function index(){
        $about=About::first();
        $person=Personal::select("*")->get();
        $data=[];
        if(!empty($about)){
            $data["about"]=$about;
        }
        if(!empty($person)){
            $data["persons"]=$person;
        }
        return view("AboutView::about",$data);
    }
    public function createAbout(Request $request){
        $input=$request->all();
        $validator=Validator::make($input,[
            "title"=>'required|string',
            "details"=>'required|string',
            "image"=>'required|mimes:jpg,jpeg,png|max:10000'
        ]);
        if($validator->fails()){
            return redirect('about')
                ->withErrors($validator,"about")
                ->withInput();
        }
        $file = $request->file('image');
        $destination=public_path()."/upload/";
        $filename=$this->uploadfile($destination,$file);
        if($filename!=false){
            $about=new About();
            $about->title=$request->all()["title"];
            $about->details=$request->all()["details"];
            $about->image=$filename;
            $about->save();
        }
        return redirect('about');
    }
    public function updateAbout(Request $request,$id){
        $about=About::where("id",$id)->first();
        $destination=public_path()."/upload/";
        $file=$about->image;
        if(!empty($request->file("image"))){
            $oldfile=$file;
            $file=$this->uploadfile($destination,$request->file("image"));
            if($file!=false){
                $this->deletefile($destination,$oldfile);
            }
        }
        $about->title=$request->all()["title"];
        $about->details=$request->all()["details"];
        $about->image=$file;
        $about->save();
        return redirect("about");
    }
    public function createPerson(Request $request){
        $input=$request->all();
        $validator=Validator::make($input,[
            "name"=>'required|string',
            "job"=>'required|string',
            "image"=>'required|mimes:jpg,jpeg,png|max:10000'
        ]);
        if($validator->fails()){
            return redirect('about')
                ->withErrors($validator,"person")
                ->withInput();
        }
        $file = $request->file('image');
        $destination=public_path()."/upload/";
        $filename=$this->uploadfile($destination,$file);
        if($filename!=false){
            $person=new Personal();
            $person->name=$request->all()["name"];
            $person->job=$request->all()["job"];
            $person->image=$filename;
            $person->save();
        }
        return redirect('about');
    }
    public function editPerson($id){
        $person=Personal::where("id",$id)->first();
        return redirect("about")->with("editPerson",$person);
    }
    public function updatePerson(Request $request,$id){
        $person=Personal::where("id",$id)->first();
        $destination=public_path()."/upload/";
        $file=$person->image;
        if(!empty($request->file("image"))){
            $oldfile=$file;
            $file=$this->uploadfile($destination,$request->file("image"));
            if($file!=false){
                $this->deletefile($destination,$oldfile);
            }
        }
        $person->name=$request->all()["name"];
        $person->job=$request->all()["job"];
        $person->image=$file;
        $person->save();
        return redirect("about");
    }
    public function uploadfile($destination,$file){
        $filename=$file->getClientOriginalName();
        $name=explode('.',$file->getClientOriginalName())[0];
        $extenstion=$file->getClientOriginalExtension();
        while(file_exists($destination.$filename)){
            $filename=$name."_".rand(1,10000000).".".$extenstion;
        }
        if($file->move($destination,$filename)){
            return $filename;
        }
        return false;
    }
    public function deletefile($destination,$filename){
        if(file_exists($destination."/".$filename)){
            unlink($destination."/".$filename);
            return 1;
        }
        return 0;
    }
}
