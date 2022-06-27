<x-app-layout>
    <x-slot name="bearerToken">{{ ArrToStr($bearerToken) }}</x-slot>
    <div class="sm:pt-8 mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 p-6 pt-1">
                    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden">
                        <div class="grid grid-cols-1 md:grid-cols-12 table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xs">
                            <h2 class="text-center">{{ isset($data) ? "Ubah" : "Tambah" }} Pangkat</h2>
                            <hr class="bg-gray-500"/>
                            <form action="" id="form-data">
                                @csrf
                                @if(@$data)
                                    <input type="hidden" id="id" value="{{ $data->id }}">
                                @endif
                                <div class="row">
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <label for="name">Nama Pangkat</label>
                                            <input type="text" class="form-control {{ $errors->has('name') ? 'form-control-danger' : '' }}" id="name" value="{{ old('name',@$data->name) }}" placeholder="Full Name" required>
                                            {!! $errors->first('name', '<label class="help-block error-validation">:message</label>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <label for="position">Jabatan</label>
                                            <select id="position" class="form-select" pk="{{ old('position',@$data->position) }}" required></select>
                                            {!! $errors->first('position', '<label class="help-block error-validation">:message</label>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mt-4">
                                        <button type="submit" class="btn btn-primary btn-md">Simpan</button>
                                        <a href="{{ route('master.rank.index') }}" class="btn btn-danger btn-md">Batal</a>
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
            "select2-css",
            "toastr-css",
            "custom-form-css",
        ]) !!}
    @endpush
    @push('scripts')
        {!! LoadAssets([
            "select2-js",
            "toastr-js",
        ]) !!}

        <script src="{{ asset('js/rank/form.js') }}"></script>
    @endpush
</x-app-layout>
