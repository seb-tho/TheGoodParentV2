<x-layout>
    <h1>Add your child</h1>
    <form method="POST" action="/{{ route('children.create') }}" enctype="multipart/form-data">
        @csrf

        <x-form.input name="name" required/>
        <x-form.input type="date" name="dateOfBirth" required/>

        <x-form.field>
            <x-form.label name="characterTraits"/>

            <select name="character_trait_id" id="character_trait_id" required>
                @foreach (\App\Models\CharacterTrait::all() as $ct)
                    <option
                        value="{{ $ct->id }}"
                        {{ old('character_trait_id') == $ct->id ? 'selected' : '' }}
                    >{{ ucwords($ct->name) }}</option>
                @endforeach
            </select>

            <x-form.error name="characterTrait"/>
        </x-form.field>

        <x-form.button>Add Child</x-form.button>
    </form>
</x-layout>
