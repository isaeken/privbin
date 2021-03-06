<x-app-layout>
    <div class="mx-auto flex flex-wrap overflow-hidden">
        <div class="w-full overflow-hidden lg:w-8/12 xl:w-9/12">
            <form action="{{ route('web.entry.store') }}" method="post">
                @csrf
                <div class="py-5">

                    @foreach($errors->all() as $error)
                        <div class="text-center py-4">
                            <div class="block w-full p-2 bg-red-800 items-center text-red-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                                <span class="flex rounded-full bg-red-500 uppercase px-2 py-1 text-xs font-bold mr-3">{{ __('privbin.error') }}</span>
                                <span class="font-semibold mr-2 text-left flex-auto">{{ $error }}</span>
                            </div>
                        </div>
                    @endforeach

                    <div class="block w-full relative mb-3">
                        <textarea id="editor_contents" name="content" class="hidden">{{ old('content') }}</textarea>
                        <label>
                            <div id="editor" class="text-gray-200 bg-gray-800 border-gray-900 appearance-none border-2 rounded w-full py-2 px-4 leading-tight focus:outline-none focus:border-purple-500">{{ old('content') }}</div>
                        </label>
                    </div>

                    <div class="block w-full relative">
                        <label>
                            <span class="block mx-1 py-2">{{ __('privbin.format') }}</span>
                            <select name="format" class="text-gray-200 bg-gray-800 border-gray-900 focus:border-purple-500 block appearance-none w-full border px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                @foreach ($highlighters as $class => $highlighter)
                                    <option value="{{ $highlighter->getName() }}" {{ $highlighter->getName() == config("app.default_highlighter") ? "selected" : null }}>
                                        {{ __('highlighters.'.$highlighter->getName()) }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>

                    <div class="block w-full relative">
                        <label>
                            <span class="block mx-1 py-2">{{ __("privbin.title") }}</span>
                            <input name="title" type="text" placeholder="{{ __("privbin.title") }}" class="text-gray-200 bg-gray-800 border-gray-900 focus:border-purple-500 block appearance-none w-full border px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        </label>
                    </div>

                    <div class="block w-full relative">
                        <label>
                            <span class="block mx-1 py-2">{{ __('privbin.expires') }}</span>
                            <select name="expires" class="text-gray-200 bg-gray-800 border-gray-900 focus:border-purple-500 block appearance-none w-full border px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                @foreach(\App\Helpers\Expires::all() as $expire)
                                    <option value="{{ $expire->name }}">
                                        {{ __($expire->lang) }}
                                        @foreach($expire->requirements as $requirement)
                                            ({{ __("expires.requirement_" . $requirement) }})
                                        @endforeach
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>

                    <div class="block w-full relative">
                        <label>
                            <span class="block mx-1 py-2">{{ __('privbin.password') }}</span>
                            <input type="password" name="password" placeholder="{{ __('privbin.password') }}" class="text-gray-200 bg-gray-800 border-gray-900 focus:border-purple-500 appearance-none border-2 rounded w-full py-2 px-4 leading-tight focus:outline-none">
                        </label>
                    </div>

                    <div class="mt-6 w-full block">
                        <button type="submit" class="block w-full bg-purple-700 hover:bg-purple-600 text-gray-200 font-semibold py-2 px-4 border border-purple-500 rounded shadow transition">
                            {{ __('privbin.save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="w-full overflow-hidden lg:w-4/12 xl:w-3/12 px-0 lg:px-8 py-10">
            <div class="card w-full my-4">
                <div class="card-body inline-block">
                    @auth()
                        <div class="px-2 py-6 relative z-0" style="min-height: 600px;">
                            <div class="absolute top-0 bottom-0 left-0 right-0 opacity-25" style="z-index: -1; background-image: url('{{ url("images/notes.svg") }}'); background-size: contain; background-position: center; background-repeat: no-repeat;"></div>
                            <div class="text-xl mb-2 mx-2">
                                Your notes is here!
                            </div>
                            @forelse(auth()->user()->entries()->where("state", \App\Enums\State::Active())->get() as $entry)
                                <div class="my-4">
                                    <a href="{{ route("web.entry.show", $entry) }}" class="block py-2 px-3 hover:bg-gray-700 hover:bg-opacity-25 waves-effect w-full">
                                        {{ $entry->title ?? $entry->slug }}
                                    </a>
                                </div>
                            @empty
                                <div class="my-4 text-center">You not have any notes.</div>
                            @endforelse
                        </div>
                    @else
                        <div class="p-6">
                            <img src="{{ url("images/welcome.svg") }}" alt="" class="w-full">
                        </div>
                        <div class="text-xl mb-2 mx-2">Hi there!</div>
                        <div class="mb-4 mx-2 text-gray-200">
                            Please <a href="{{ route("login") }}">login</a> or <a href="{{ route("register") }}">register</a> to save your notes, long time store and more features.
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
