<x-layout>
    <article>
        <div class="py-6 px-5">
            <div>
                <img src="/images/child.jpg" alt="Child" class="rounded-xl">
            </div>

            <div class="mt-8 flex flex-col justify-between">
                <header>
                    <div class="mt-4">
                        <h1 class="text-3xl">
                            {{ $child->name }}
                        </h1>
                    </div>
                    <div class="space-x-2">
                        <ul>
                            @foreach($child->characterTraits as $ct)
                                <li class="px-3 py-1 text-blue-300 text-xs uppercase font-semibold"
                                    style="font-size: 10px"> {{ $ct->name }} {{$ct->pivot->traitLevel}}</li>
                            @endforeach
                        </ul>
                    </div>
                </header>
            </div>
        </div>
    </article>
    <a href="/">Go Back</a>
</x-layout>


