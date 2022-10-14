<x-layout>
    {{--    @foreach ($childs as $child)--}}
    {{--        <article>--}}
    {{--            <h1>--}}
    {{--                <a href="/child/{{ $child->id }}">--}}
    {{--                    {{ $child->title }}--}}
    {{--                </a>--}}
    {{--            </h1>--}}
    {{--            <p>--}}
    {{--                {{ $child->excerpt }}--}}
    {{--            </p>--}}
    {{--        </article>--}}
    {{--    @endforeach--}}
    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        <div class="lg:grid lg:grid-cols-2">
            @if($children->count())
                @foreach($children as $child)
                    <a href="/child/{{$child->id}}">
                        <x-child-card :child="$child"></x-child-card>
                    </a>
                @endforeach
            @else
                <p class="text-center">No children added, please do.
            @endif
        </div>
    </main>
</x-layout>
