<x-app-layout>
    <x-slot name="bearerToken">{{ ArrToStr($bearerToken) }}</x-slot>
    <div class="sm:pt-8 mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 p-6 pt-1">
                    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden">
                        <div class="grid grid-cols-1 md:grid-cols-12 table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xs">
                            <h2 class="text-center">{{ isset($data) ? "Ubah" : "Tambah" }} Program Studi</h2>
                            <hr class="bg-gray-500"/>
                            <form action="" id="form-data">
                                @csrf
                                @if(@$data)
                                    <input type="hidden" id="id" value="{{ $data->id }}">
                                @endif
                                <div class="row">
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <label for="name">Nama Program Studi</label>
                                            <input type="text" class="form-control {{ $errors->has('name') ? 'form-control-danger' : '' }}" id="name" value="{{ old('name',@$data->name) }}" placeholder="Full Name" required>
                                            {!! $errors->first('name', '<label class="help-block error-validation">:message</label>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <label for="college">Perguruan Tinggi</label>
                                            <select id="college" class="form-select" pk="{{ old('college',@$data->college) }}" required></select>
                                            {!! $errors->first('college', '<label class="help-block error-validation">:message</label>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <label for="stage">Jenjang</label>
                                            <select id="stage" class="form-select" pk="{{ old('stage',@$data->stage) }}" required></select>
                                            {!! $errors->first('stage', '<label class="help-block error-validation">:message</label>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <label for="front_degree">Gelar Depan</label>
                                            <input type="text" class="form-control {{ $errors->has('front_degree') ? 'form-control-danger' : '' }}" id="front_degree" value="{{ old('front_degree',@$data->front_degree) }}" placeholder="Gelar Depan">
                                            {!! $errors->first('front_degree', '<label class="help-block error-validation">:message</label>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <label for="back_degree">Gelar Belakang</label>
                                            <input type="text" class="form-control {{ $errors->has('back_degree') ? 'form-control-danger' : '' }}" id="back_degree" value="{{ old('back_degree',@$data->back_degree) }}" placeholder="Gelar Belakang">
                                            {!! $errors->first('back_degree', '<label class="help-block error-validation">:message</label>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mt-4">
                                        <button type="submit" class="btn btn-primary btn-md">Simpan</button>
                                        <a href="{{ route('master.major.index') }}" class="btn btn-danger btn-md">Batal</a>
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

        <script src="{{ asset('js/major/form.js') }}"></script>
    @endpush
</x-app-layout>
