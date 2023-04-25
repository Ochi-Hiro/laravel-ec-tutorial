<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Owner; //Eloquent
use Illuminate\Support\Facades\DB; //QueryBuilder
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class OwnersController extends Controller
{

    public function __constuct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $date_now = Carbon::now();
        // $date_parse = Carbon::parse(now());
        // echo $date_now;
        // echo $date_now->year;
        // echo $date_parse;


        // $eloquent_all = Owner::all();

        // $querybuilder_get = DB::table('owners')->select('name', 'created_at')->get();
        // $querybuilder_first = DB::table('owners')->select('name')->first();

        // $collection_test = collect([
        //     'name' => 'テスト'
        // ]);

        // dd($eloquent_all, $querybuilder_get, $querybuilder_first, $collection_test);

        $owners = Owner::select('name', 'email', 'created_at')->get(); //eroquent使用

        return view('admin.owners.index',
        compact('owners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.owners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) //フォームに入力された値がRequestクラスになってインスタンス化で$request
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Owner::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        Owner::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
        ->route('admin.owners.index')
        ->with('message', 'オーナー登録を実施しました。');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}