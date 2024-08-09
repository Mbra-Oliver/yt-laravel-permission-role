@extends('layout.appLayout')
@section('content')
    <div class="shadow-sm border border-gray-100 rounded-md p-8">
        <div class="font-semibold text-2xl"> {{ $connectedUser->name }}</div>
        <div>role: {{ $connectedUser->roles[0]->name }} </div>
        <div>
            Permissions disponible: @foreach ($connectedUser->roles[0]->permissions as $permission)
                <span class="border border-gray-100 bg-green-300 rounded-md p-2 text-xs">{{ $permission->name }}</span>
            @endforeach
        </div>


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

                    @if ($connectedUser->can('ADD_NEW_EMPLOYE'))
                        <button class="bg-blue-500 rounded-md p-2 text-xs text-white">Ajouter un employer</button>
                    @endif


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

                                    @if ($connectedUser->can('ADD_DATA') || $connectedUser->can('EDIT_DATA'))
                                        <a href="{{ route('admin.manageData', $user->id) }}"
                                            class="bg-blue-800 text-sm px-1 py-2 rounded-lg text-white cursor-pointer">Modifier
                                            les
                                            données</a>
                                    @endif


                                    @if ($connectedUser->can('DELETE_AN_EMPLOYE'))
                                        <a href=""
                                            class="bg-red-900 p-3 rounded-md text-white text-center">Supprimer</a>
                                    @endif



                                    {{-- @if ($connectedUser->roles[0]->name === 'DATA_MANAGER')
                                        <button>Gerer les donnees</button>
                                    @endif --}}

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>
@endsection
