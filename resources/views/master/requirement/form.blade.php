<x-app-layout>
    <x-slot name="bearerToken">{{$bearerToken}}</x-slot>
    <div class="sm:pt-8 mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 p-6 pt-1">
                    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden">
                        <div class="grid grid-cols-1 md:grid-cols-12 table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xs">
                            <h2 class="text-center">{{ isset($data) ? "Ubah" : "Tambah" }} Persyaratan</h2>
                            <hr class="bg-gray-500"/>
                            <form action="" id="form-data">
                                @csrf
                                @if(@$data)
                                    <input type="hidden" id="id" value="{{ $data->id }}">
                                @endif
                                <div class="row">
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <label for="name">Nama Persyaratan</label>
                                            <input type="text" class="form-control focus:border-emerald-300-important focus:ring focus:ring-emerald-100 {{ $errors->has('name') ? 'border-red-700-important' : '' }}" id="name" name="name" value="{{ old('name',@$data->name) }}" placeholder="Nama Persyaratan" required>
                                            {!! $errors->first('name', '<label class="help-block error-validation">:message</label>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mt-4">
                                        <button type="submit" class="btn btn-primary btn-md">Simpan</button>
                                        <a href="{{ route('master.requirement.index') }}" class="btn btn-danger btn-md">Batal</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
        {!! LoadAssets([
            "toastr-css",
            "custom-form-css",
        ]) !!}
    @endpush
    @push('scripts')
        {!! LoadAssets([
            "toastr-js",
        ]) !!}

        <script src="{{ asset('js/requirement/form.js') }}"></script>
    @endpush
</x-app-layout>
