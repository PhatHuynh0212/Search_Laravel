<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LiveSearchController extends Controller
{
    function index()
    {
        return view('livesearch');
    }

    function action(Request $request)
    {
        if($request->ajax())
        {
            $output = '';
            $query = $request->get('query');
            if($query != '') {
                $data = DB::table('film')
                    ->where('name', 'like', '%'.$query.'%')
                    ->orWhere('evaluation', 'like', '%'.$query.'%')
                    ->orWhere('description', 'like', '%'.$query.'%')
                    ->orWhere('img', 'like', '%'.$query.'%')
                    ->orderBy('id', 'desc')
                    ->get();
                    
            } else {
                $data = DB::table('film')
                    ->orderBy('id', 'desc')
                    ->get();
            }
            
            $total_row = $data->count();
            if($total_row > 0){
                foreach($data as $row)
                {
                    $output .= '
                    <div class="col-md-4">
                        <div class="card" style="background: transparent;">
                            <img src="'.$row->img.'" class="card-img-top" alt="Film Image">
                            <div class="card-body">
                                <h4 class="card-title text-center">'.$row->name.'</h4>
                                <p class="card-text mt-2">Đánh giá: '.$row->evaluation.' ⭐️</p>
                                <p class="card-text">Thể Loại: '.$row->description.'</p>
                            </div>
                        </div>
                    </div>
                    ';
                }
            } else {
                $output = '
                <tr>
                    <td align="center" colspan="5">No Film Found</td>
                </tr>
                ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );
            echo json_encode($data);
        }
    }
}