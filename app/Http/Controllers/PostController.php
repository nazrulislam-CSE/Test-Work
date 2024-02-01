<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use DataTables;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $get = Post::latest()->get();

            if($request->filled('from_date') && $request->filled('to_date'))
            {
                $get = $get->whereBetween('created_at', [$request->from_date, $request->to_date]);
            }

            return DataTables::of($get)
                ->addIndexColumn()
                ->addColumn('image', function ($get) {
                    if ($get->image != null) {
                        $asset = asset('upload/post/' . $get->image);
                    } else {
                        $asset = asset('upload/post/user.png');
                    }
                    $picture = '<img class="rounded-circle border" src="' . $asset . '" alt="" height="100" width="100">';
                    $image = '<input type="file" name="image" class="border" style="width: 40%;">';
                    $button = '<button class="btn btn-sm btn-secondary rounded-0 py-0">Save</button>';
                    $div = '<div class="text-center">
                        ' . $picture . '
                            <br>
                            <br>
                            <form action="' . route('post_photo', $get->id) . '" method="POST" enctype="multipart/form-data">
                                ' . csrf_field() . '
                                ' . method_field('PUT') . '
                                <div class="input-group justify-content-center">
                                    ' . $image . '
                                    ' . $button . '
                                </div>
                            </form>
                    </div>';
                    return $div;
                    return '<a href="' . $asset . '" target="_blank"><img class="rounded-circle border border-dark" src="' . $asset . '" alt="" height="30" width="30"></a>';

                    
                })
                ->addColumn('action', function ($get) {
                    $button = '<div class="d-flex justify-content-center align-items-center buton-align" >';
                    $button .= '<a  href="javascript:void(0)" class="btn btn-primary shadow btn-sm sharp mx-1 editRow" onclick="post_edit(' . $get->id . ')" data-bs-toggle="modal" data-bs-target="#update_post"><i class="fas fa-edit"></i></a>';
                    $button .= '<a data-url="' . route('post.delete', $get->id) . '" data-id="' .$get->id . '"  href="javascript:void(0)" data-item-name="'.$get->title.'" class="btn btn-danger shadow btn-sm sharp  deleteRow"><i class="fa fa-trash"></i></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == '1') {
                        return "<span class='badge bg-success'>" . "Active" . "</span>";
                    }else if ($row->status == '0') {
                        return "<span class='badge bg-danger'>" . "Inactive" . "</span>";
                    }
                })
                ->rawColumns(['image','status', 'action' ])
                ->make(true);
            }

            return view('dasboard');
    }


    function postPhoto(Request $request, $post_id){

        // Check if the image is null
        if ($request->file('image') == null) {
            flash()->addError('No image selected.');
            return redirect()->back();
        }


        // $preview_image = $request->image;
        // $ext = $preview_image->getClientOriginalExtension();
        // $file_name = hexdec(uniqId()).'.'.$ext;
        // Image::make($preview_image)->save(public_path('upload/post/'.$file_name));

        $post = Post::findorFail($post_id);

        // Unlink the old image
        $old_image_path = public_path('upload/post/' . $post->image);
        if (File::exists($old_image_path)) {
            File::delete($old_image_path);
        }
        

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/post/'.$post->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/post'),$filename);
            $post['image'] = $filename;
        }

        $post->save();

        flash()->addSuccess('Post Photo Updated Successfully.');
        return redirect()->back();


    }


    function postDelete($post_id){

        $post = Post::findOrFail($post_id);
        try {
            if(file_exists($post->image)){
                unlink($post->image);
            }
        } catch (Exception $e) {

        }

        $post->delete();

        $post = Post::where('id',$post_id)->delete();


        return response()->json(['status'=>true,'message'=>"Post Deleted Success"]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   function store(Request $request){

        $validator = Validator::make($request->all(),[
            'title'=>"required",
            'content'=>"required",
            'status'=>"required",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example: Allow JPEG, PNG, JPG, GIF and maximum size of 2MB
        ]);


        if($validator->passes()){

            // $preview_image = $request->image;
            // $ext = $preview_image->getClientOriginalExtension();
            // $file_name = Str::lower(str_replace(' ', '-', $request->image)).'-'.hexdec(uniqid()).'.'.$ext;
            // Image::make($preview_image)->save(public_path('upload/post/'.$file_name));

            $post = Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'status' => $request->status,
                'created_at' => Carbon::now(),
            ]);

            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/post/'.$post->photo));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/post'),$filename);
                $post['image'] = $filename;
            }
    
            $post->save();

            return response()->json(['res'=>'success', 'message'=>'Post Added Successfully!']);
        }
        return response()->json(['error'=>$validator->getMessageBag()]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    function edit($id){

        $post = Post::findorFail($id);
        return response()->json(['post'=>$post]);

     }

    /**
     * Update the specified resource in storage.
     */
    function update(Request $request, $id){
        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->status = $request->status;
        $post->updated_at = Carbon::now();
        $post->save();

        return response()->json(['status'=>'success', 'message'=>'Post updated successfully']);

     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
