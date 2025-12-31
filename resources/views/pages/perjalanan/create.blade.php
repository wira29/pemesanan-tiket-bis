
@extends('layouts.layout')

@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Halaman Tambah Perjalanan</h4>
                <p class="text-muted">Isi formulir dibawah ini dengan benar.</p>
            </div>
            <div class="col-3">
                <div class="text-center mb-n5">
                <img src="../assets/images/breadcrumb/ChatBc.png" alt="modernize-img" class="img-fluid mb-n4">
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="card w-100 position-relative overflow-hidden">
        <form action="{{ route('travels.store') }}" method="POST">
            @method('POST')
            @csrf()
            <div class="px-4 py-3 border-bottom">
              <h4 class="card-title mb-0">Formulir Tambah Perjalanan</h4>
            </div>
            <div class="card-body p-4 border-bottom">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Plat Nomor <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="vehicle_number" value="{{ old('vehicle_number') }}" placeholder="N XXXX OE" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('vehicle_number')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" name="date" class="form-control" value="{{ old('date') }}" id="exampleInputPassword1">
                            @error('date')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Asal <span class="text-danger">*</span></label>
                            <input type="text" name="from" class="form-control" value="{{ old('from') }}" placeholder="Malang" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('from')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tujuan <span class="text-danger">*</span></label>
                            <input type="text" name="destination" value="{{ old('destination') }}" class="form-control" placeholder="Surabaya" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('destination')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <div class="form-check">
                            <input class="form-check-input" name="is_half" type="checkbox" value="1" id="flexCheckDefault" {{ old('is_half') ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheckDefault">
                              Setengah Perjalanan
                            </label>
                            @error('is_half')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Catatan</label>
                            <textarea class="form-control" name="remarks" rows="3" placeholder="Catatan ...">{{ old('remarks') }}</textarea>
                            @error('remarks')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 border-bottom">
                <button type="submit" class="btn btn-primary hstack gap-6">
                    <i class="ti ti-send fs-4"></i>
                    Submit
                </button>
            </div>
        </form>
          </div>
@endsection