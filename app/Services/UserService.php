<?php 
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService
{
    public function index($request){
        $query = User::query()->latest();

        if($search = $request->input('search')){
            $query->whereDate('joined_on', 'like', $search.'%')
                ->orWhere('id', 'like', $search.'%')
                ->orWhere('name', 'like', $search.'%')
                ->orWhere('email', 'like',$search.'%')
                ->orWhere('gender', 'like', $search.'%')
                ->orWhere('phone', 'like', $search.'%')
                ->orWhere('address', 'like', $search.'%');
        }

        if($request->has('order') && $request->order && $request->has('sort') && $request->sort){
            $query->orderBy($request->order, $request->sort);
        }

        if ($request->has('limit')) {
                $list = $query->paginate( $request['limit'] );
            } else {
                $list = $query->paginate(10);
        }

        return $list;
    }

    public function print(){
        $list = User::orderBy('name', 'asc')->get();

        return $list;
    }

    public function countUser(){
        $list = User::count();
        return $list;
    }

    public function show($id){
        $show = User::where('id', $id)->first();
        if ( !$show ) throw ValidationException::withMessages([
            'data' => ['Data tidak ditemukan.'],
        ]); 
        return $show;
    }

    public function store($request){
        $store = User::firstOrCreate([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'phone'     => $request->phone,
            'gender'    => $request->gender,
            'joined_on' => $request->joined_on,
            'address'   => $request->address,
            'role'      => $request->role,
        ]);
        return $store;
    }   

    public function update($request, $id){  
        $user = User::findOrFail($id);
        $user->fill([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'phone'     => $request->phone,
            'gender'    => $request->gender,
            'joined_on' => $request->joined_on,
            'address'   => $request->address,
            'role'      => $request->role,
        ]);

        if ($user->isDirty('email')) {//true
            $user->email_verified_at = null;
        }

        $user->save(); 
        return $user;
    }

    public function destroy($id){
        $destroy = User::findOrFail($id);
        $destroy->delete();
        return $destroy;
    }   
}   
?>