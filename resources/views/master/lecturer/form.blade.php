<x-app-layout>
    <x-slot name="bearerToken">{{$bearerToken}}</x-slot>
    <div class="sm:pt-8 mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 p-6 pt-1">
                    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden">
                        <div class="grid grid-cols-1 md:grid-cols-12 table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xs">
                            <h2 class="text-center">{{ isset($data) ? "Ubah" : "Tambah" }} Dosen</h2>
                            <hr class="bg-gray-500"/>
                            <form action="" id="form-data">
                                @csrf
                                @if(@$data)
                                    <input type="hidden" id="id" value="{{ $data->id }}">
                                @endif
                                <div class="row">
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <label for="name">Nama Lengkap</label>
                                            <input type="text" class="form-control focus:border-emerald-300-important focus:ring focus:ring-emerald-100 {{ $errors->has('name') ? 'border-red-700-important' : '' }}" id="name" name="name" value="{{ old('name',@$data->name) }}" placeholder="Full Name" required>
                                            {!! $errors->first('name', '<label class="help-block error-validation">:message</label>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control focus:border-emerald-300-important focus:ring focus:ring-emerald-100 {{ $errors->has('email') ? 'border-red-700-important' : '' }}" id="email" name="email" value="{{ old('email',@$data->email) }}" placeholder="Email" required>
                                            {!! $errors->first('email', '<label class="help-block error-validation">:message</label>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <label for="gender">Jenis Kelamin</label>
                                            <select id="gender" class="form-select" pk="{{ old('rank',@$data->gender) }}" required>
                                                <option value="">Pilih Jenis Kelamin</option>
                                                @foreach (@config("data.gender") as $gender)
                                                    <option>{{ $gender }}</option>
                                                @endforeach
                                            </select>
                                            {!! $errors->first('gender', '<label class="help-block error-validation">:message</label>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <label for="birth_place">Tempat Lahir</label>
                                            <input type="text" class="form-control focus:border-emerald-300-important focus:ring focus:ring-emerald-100 {{ $errors->has('birth_place') ? 'border-red-700-important' : '' }}" id="birth_place" name="birth_place" value="{{ old('birth_place',@$data->birth_place) }}" placeholder="Tempat Lahir">
                                            {!! $errors->first('birth_place', '<label class="help-block error-validation">:message</label>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <label for="birth_date">Tanggal Lahir</label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control focus:border-emerald-300-important focus:ring focus:ring-emerald-100 {{ $errors->has('birth_date') ? 'border-red-700-important' : '' }}" id="birth_date" name="birth_date" value="{{ old('birth_date',@$data->birth_date) }}" placeholder="Tanggal Lahir" autocomplete="off">
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-th"></span>
                                                </div>
                                            </div>
                                            {!! $errors->first('birth_date', '<label class="help-block error-validation">:message</label>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mt-4" style="font-size:80%;">
                                        Password akan otomatis terisi menjadi '123'. Harap dosen untuk mengubahnya nanti
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary btn-md">Simpan</button>
                                        <a href="{{ route('master.lecturer.index') }}" class="btn btn-danger btn-md">Batal</a>
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
            "bs-dp-css",
            "toastr-css",
            "custom-form-css",
        ]) !!}
    @endpush
    @push('scripts')
        {!! LoadAssets([
            "select2-js",
            "bs-dp-js",
            "toastr-js"
        ]) !!}

        <script src="{{ asset('js/lecturer/form.js') }}"></script>
    @endpush
</x-app-layout>
