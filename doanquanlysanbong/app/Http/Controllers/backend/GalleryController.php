<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GalleryController extends Controller
{
    public function create($id)
    {
        $pitch_id = $id;
        return view('admin.gallery.add', compact('pitch_id'));
    }
    public function select_gallery(Request $request)
    {
        $pitch_id = $request->pitch_id;
        $gallery = Gallery::where('pitch_id', $pitch_id)->get();
        $gallery_count = $gallery->count();
        $output = '<table class="table table-hover">
        <thead>
          <tr>
          <th>STT</th>

            <th>Tên hình ảnh</th>
            <th>Hình ảnh</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>';
        if ($gallery_count > 0) {
            $i = 0;
            foreach ($gallery as $key => $gal) {
                $i++;
                $output .= '
                <form> 
                '.csrf_field().'
                <tr>
                <td>' . $i . '</td>
                <td contenteditable class="edit_gal_name" data-gal_id="'.$gal->id.'">'. $gal->gallery_name . '</td>
                <td><img height="120px"  width=" 200px" class="img-thumbnail" src="' . url('/upload/gallery/' . $gal->gallery_image) . '"> 
                    <input type="file" class="file_image" style="width=40%" data-gal_id="'.$gal->id.'"
                    id="file-'.$gal->id.'" name="file" accept="image/*"/>
                </td>
                <td>
                    <button type="button" data-gal_id="'. $gal->id . '" class="btn btn-xs btn-danger delete-gallery">Xóa</button>
                </td>
              </tr>
                ';
            }
        } else {
            $output .= ' <tr>
            <td colspan="4">Sản phẩm chưa có thư viện ảnh</td>
           
          </tr>
            ';
           
        }
        $output .= ' </tbody>
            </table>
            </form>
                ';
        echo $output;
    }
    public function insert_gallery(Request $request,$pitch_id)
    {
        $get_image = $request->file('file');
        if ($get_image) {
            foreach ($get_image as $image) {
                $getnameimage = $image->getClientOriginalName();
                $nameimage = current(explode('.', $getnameimage));
                $new_image = $nameimage . rand(0, 99) . '.' . $image->getClientOriginalExtension();
                $image->move('upload/gallery', $new_image);
                $gallery = new Gallery();
                $gallery->gallery_name = $new_image;
                $gallery->gallery_image = $new_image;
                $gallery->pitch_id = $pitch_id;
                $gallery->save();
            }
        }
        Session::put('success','Thêm thư viện ảnh thành công');
        return redirect()->back();
    }
    public function update_galleryname(Request $request){
        $gal_id=$request->gal_id;
        $gal_text=$request->gal_text;
        $gallery=Gallery::find($gal_id);
        $gallery->gallery_name=$gal_text;
        $gallery->save();
    }
    public function update_gallery(Request $request){
        $get_image = $request->file('file');
        $gal_id=$request->gal_id;
        if ($get_image) {
            
                $getnameimage = $get_image->getClientOriginalName();
                $nameimage = current(explode('.', $getnameimage));
                $new_image = $nameimage . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('upload/gallery', $new_image);

                $gallery =Gallery::find($gal_id);
        unlink('upload/gallery/'.$gallery->gallery_image);

                $gallery->gallery_image = $new_image;
                $gallery->save();
    
        }
    }
    public function delete_gallery(Request $request){
        $gal_id=$request->gal_id;
        $gallery=Gallery::find($gal_id);
        unlink('upload/gallery/'.$gallery->gallery_image);
        $gallery->delete();
    }
}
