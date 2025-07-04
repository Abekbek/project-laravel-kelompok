<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select(['id', 'name', 'email', 'created_at', 'is_admin']);
            return DataTables::of($data)
                ->addColumn('action', function($row){
                    $deleteBtn = '<button onclick="deleteUser('.$row->id.')" class="p-2 bg-red-600 text-white text-xs rounded hover:bg-red-500">Hapus</button>';
                    return $deleteBtn;
                })
                ->editColumn('is_admin', function($row){
                    return $row->is_admin ? '<span class="px-2 py-1 bg-green-600 text-white text-xs rounded">YA</span>' : '<span class="px-2 py-1 bg-slate-600 text-white text-xs rounded">TIDAK</span>';
                })
                ->rawColumns(['action', 'is_admin'])
                ->make(true);
        }
        return view('admin.users.index');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return response()->json(['error' => 'Anda tidak bisa menghapus akun Anda sendiri.'], 403);
        }
        $user->delete();
        return response()->json(['success' => 'User berhasil dihapus.']);
    }
}
