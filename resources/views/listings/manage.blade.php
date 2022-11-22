@extends('layout')

@section('content')

<div class="mx-4">
    <x-card class="bg-gray-50 border border-gray-200 p-10 rounded">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">
                Manage Gigs
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless($listings->isEmpty())
                @foreach($listings as $listing)
                <tr class="border-gray-300">
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <a href="show.html">
                            {{$listing->title}}
                        </a>
                    </td>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <a href="{{url('/listings/'.$listing->id.'/edit')}}">
                            <i class="fa-solid fa-pen-to-square"></i> edit
                    </td>

                    </a>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <form method="POST" action="{{url('/listings/'.$listing->id)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500"><span><i class="fa-solid fa-trash-can"> </i> delete</span></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr class="border-gray-300">
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <p class="text-center">no posts yet</p>
                    </td>
                </tr>
                @endunless

            </tbody>
        </table>
    </x-card>
</div>
@endsection
