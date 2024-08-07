@extends('layout._layout')
@section('content')
    <div class="shadow-sm border border-gray-100 rounded-md p-8">
        <div class="font-semibold text-2xl"> {{ auth()->user()->name }}</div>
        <div>role:</div>


        <div class="mt-4">



            <div>Gerer les employés</div>


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

            <div class="w-full mt-10 mb-10 ">
                <div class="flex gap-2 justify-end items-end">

                    <button class="bg-blue-500 rounded-md p-2 text-xs text-white">Ajouter un employer</button>

                    <form method="post" action="{{ route('admin.logout') }}">
                        @csrf
                        @method('post')
                        <button type="submit" href="{{ route('admin.logout') }}"
                            class="bg-red-500 rounded-md p-2 text-xs text-white">Me
                            déconnecter</button>
                    </form>
                </div>
                <h2 class="text-2xl mb-2">Utilisateurs</h2>
                <table class="w-full">
                    <thead class="bg-gray-300">
                        <th class="px-4 py-3">Nom</th>
                        <th>Contact</th>
                        <th class="px-4 py-3">Date d'enrolement</th>
                        <th>Actions</th>

                    </thead>
                    <tbody>
                        @foreach ($employes as $user)
                            <tr class="border">
                                <td class="px-4 py-3 border-r border-gray-100">{{ $user->first_name }}
                                    {{ $user->last_name }} </td>
                                <td class="px-4 py-3 border-r border-gray-100">{{ $user->phone_number }}</td>
                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ date('d-M-Y', strtotime($user->hire_date)) }}
                                </td>
                                <td class="px-4 py-3 ">



                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>
@endsection
