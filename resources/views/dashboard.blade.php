<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div>
                        <p>
                            <img src="{{ 'images/easywords-full.png' }}" alt="EasyWords">
                        </p>
                    </div>

                    <div class="mt-8 text-2xl">
                        Welcome to EasyWords!
                    </div>

                    <div class="mt-6 text-gray-500">
                        Most popular words:
                    </div>
                    <div class="mt-6">
                        <div class="my-6 overflow-hidden bg-white rounded-md shadow">
                            <table class="w-full text-left border-collapse">
                                <thead class="border-b">
                                <tr>
                                    <th
                                        class="px-5 py-3 text-sm font-medium text-gray-100 uppercase bg-indigo-800"
                                    >
                                        Word
                                    </th>
                                    <th
                                        class="px-5 py-3 text-sm font-medium text-gray-100 uppercase bg-indigo-800"
                                    >
                                        Number of views
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($words as $word)
                                <tr
                                    class="hover:bg-gray-200"
                                >
                                    <td class="px-6 py-4 text-lg text-gray-700 border-b">
                                        {{ $word->original }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 border-b">
                                        {{$word->views}}
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
