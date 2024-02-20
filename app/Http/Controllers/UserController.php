<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        return Inertia::render('Users/Index', [
//            'title' => 'Пользователи',
//            'users' => User::orderByDesc('created_at')->paginate(5)
//        ]);
        return Inertia::render(

            'Admin/Control/UsersView',
            [

                'users' =>
                    User::query()
                        ->when(\request()->input('search'), function (Builder $query, $search) {
                            $query->where('name', 'like', '%' . $search . '%')
                                ->OrWhere('email', 'like', '%' . $search . '%');
                        })->paginate(10)
                        ->withQueryString(),
                'filters' => \request()->only(['search'])
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Users/Create', [
            'title' => 'Добавить пользователя'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create($request->validate([
            'name' => ['required'],
            'email' => ['required', Rule::unique('users')],
            'password' => ['required']
        ]));

        return to_route('admin.users.index');


    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'title' => 'Редактирование пользователя',
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required'],
            'email' => ['required', Rule::unique('users')->ignore($user->id)]
        ]);

        $user->update($data);

        return to_route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }
}
