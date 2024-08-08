@extends('layout._layout')
@section('content')
    <div class="px-12">
        @if (Session::get('success'))
            <div class="bg-green-400 p-2 rounded-md text-white">
                <div class="text-white font-semibold">{{ Session::get('success') }}</div>
            </div>
        @endif

        @if (Session::get('error'))
            <div class="bg-red-400 p-2 rounded-md text-white w-full">
                {{ Session::get('error') }}
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <div>



            <form action="{{ route('user.register') }}" method="post"
                class="flex flex-col gap-4 shadow-sm border border-gray-100 rounded-md p-8 ">
                @csrf
                @method('post')
                <h4 class="text-center text-2xl">Inscription</h4>
                <div class="px-8">

                </div>
                <label for="name">Nom</label>
                <input type="text" class="p-2 rounded-md border-gray-300 border " name="name">
                @error('name')
                    {{ $message }}
                @enderror
                <label for="name">Email</label>
                <input type="text" name="email" class="p-2 rounded-md border-gray-300 border ">

                @error('email')
                    <div class="text-red-900 font-semibold">{{ $message }}</div>
                @enderror

                <label for="name">Role</label>
                <select name="role_id" class="p-2 rounded-md border-gray-300 border ">
                    <option value=""></option>
                    @foreach ($roles as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('role_id')
                    <div class="text-red-900 font-semibold">{{ $message }}</div>
                @enderror


                <div class="flex justify-end items-end mt-3">
                    <button type="submit" class="bg-gray-700 text-white p-2 rounded-md">Creer mon
                        compte</button>
                </div>
            </form>
        </div>

        <div class=" shadow-sm border border-gray-100 rounded-md p-8 ">
            <form method="post" action="{{ route('user.login') }}" class="flex flex-col gap-4">
                @csrf
                @method('post')
                <h4 class="text-center text-2xl">Connexion</h4>

                <label for="name">Email</label>
                <input type="text" name="email" class="p-2 rounded-md border-gray-300 border ">
                <label for="name">Mot de passe</label>
                <input type="password" value="azerty" name="password" class="p-2 rounded-md border-gray-300 border ">


                <div class="flex justify-end items-end mt-3">
                    <button type="submit" class="bg-gray-700 text-white p-2 rounded-md">Me connecter</button>
                </div>
            </form>
        </div>
    </div>
    <div class="w-full mt-10 mb-10 ">

        <h2 class="text-2xl mb-2">Utilisateurs</h2>
        <table class="w-full">
            <thead class="bg-gray-300">
                <th class="px-4 py-3">Email</th>
                <th>Role</th>
                <th class="px-4 py-3">Mot de passe</th>

            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border">
                        <td class="px-4 py-3 border-r border-gray-100">{{ $user->email }}</td>
                        <td class="px-4 py-3 border-r border-gray-100">
                            @foreach ($user->roles as $item)
                                {{ $item->name }}
                            @endforeach
                        </td>
                        <td class="px-4 py-3">{{ 'azerty' }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
