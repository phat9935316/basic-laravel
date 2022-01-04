<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show B1.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewBlade()
    {
        return view('B1.home');
    }

    /**
     * Show B2.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function queryBuilder()
    {
        return view('B2.index');
    }

     /**
     * Show datatable.
     *
     */
    public function  queryBuilderDatatable(Request $request, Post $post)
    {
        if ($request->ajax()) {
            $data = $post->orderBy('id', 'DESC');
            return DataTables::of($data->get())
                ->addIndexColumn()
                ->editColumn('title', function ($data) {
                    return '<a href="'. route('post.view', ['id' => $data->id]) .'">'. $data->title .'</a>';
                })
                ->addColumn('action', function($data){
                    return view('elements.action', [
                        'model' => $data,
                        'url_edit' => route('post.edit', ['id' => $data->id]),
                        'url_destroy' => route('post.delete', ['id' => $data->id]),
                    ]);
                })
                ->rawColumns(['title', 'action'])
                ->make(true);
        }
    }

    /**
     * Show B3.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function  eloquentORM()
    {
        return view('B3.index');
    }

    /**
     * Show datatable.
     *
     */
    public function  eloquentORMDatatable(Request $request, User $user)
    {
        if ($request->ajax()) {
            $data = $user::with('phones', 'roles');
            if($request->user_id)
                $data->where('id', $request->user_id);
            if($request->phone){
                $phone = $request->phone;
                $data->whereHas('phones', function($q) use($phone){
                    $q->where('number', 'like', '%'.$phone.'%');
                });
            }
            if($request->role_name){
                $roleName = $request->role_name;
                $data->whereHas('roles', function($q) use($roleName){
                    $q->where('name', 'like', '%'.$roleName.'%');
                });
            }
            $data->orderBy('id', 'ASC');
            return DataTables::of($data->get())
                ->addIndexColumn()
                ->editColumn('user_id', function ($data) {
                    return $data->id;
                })
                ->editColumn('phone', function ($data) {
                    return implode(',', $data->phones->pluck('number')->toArray());
                })
                ->editColumn('role_name', function ($data) {
                    return implode(',', $data->roles->pluck('name')->toArray());
                })
                ->rawColumns(['user_id', 'phone', 'role_name'])
                ->make(true);
        }
    }

}
