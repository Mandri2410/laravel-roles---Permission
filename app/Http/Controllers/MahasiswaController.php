<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-mahasiswa|edit-mahasiswa|delete-mahasiswa|show-mahasiswa', ['only' => ['index','show']]);
        $this->middleware('permission:create-mahasiswa', ['only' => ['create','store']]);
        $this->middleware('permission:edit-mahasiswa', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-mahasiswa', ['only' => ['destroy']]);
    }

    public function index()
    {
        $mahasiswas = User::role('Mahasiswa')->paginate(10);
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('mahasiswa.create', [
            'roles' => Role::pluck('name')->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'roles' => 'required|array',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $user = User::create($input);
        $user->assignRole($request->roles);

        return redirect()->route('mahasiswa.index')->withSuccess('New mahasiswa added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $mahasiswa): View
    {
        return view('mahasiswa.show', [
            'mahasiswa' => $mahasiswa
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $mahasiswa): View
    {
        return view('mahasiswa.edit', [
            'mahasiswa' => $mahasiswa,
            'roles' => Role::pluck('name')->all(),
            'userRoles' => $mahasiswa->roles->pluck('name')->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $mahasiswa): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $mahasiswa->id,
            'password' => 'nullable|string|min:6|confirmed',
            'roles' => 'required|array',
        ]);

        $input = $request->except(['_method', '_token', 'password_confirmation']);
        if ($request->password) {
            $input['password'] = Hash::make($request->password);
        }
        $mahasiswa->update($input);
        $mahasiswa->syncRoles($request->roles);

        return redirect()->route('mahasiswa.index')->withSuccess('Mahasiswa updated successfully.');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $mahasiswa): RedirectResponse
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->withSuccess('Mahasiswa deleted successfully.');
    }
}