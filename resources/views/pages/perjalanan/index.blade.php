
@extends('layouts.layout')

@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Halaman Perjalanan</h4>
                <p class="text-muted">Kumpulan perjalanan di perushanan anda</p>
                <a href="{{ route('travels.create') }}" class="btn btn-primary text-white"><i class="ti ti-plus"></i> Tambah Perjalanan</a>
            </div>
            <div class="col-3">
                <div class="text-center mb-n5">
                <img src="../assets/images/breadcrumb/ChatBc.png" alt="modernize-img" class="img-fluid mb-n4">
                </div>
            </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
      <div class="alert alert-danger">
          <ul class="mb-0">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

    <div class="card w-100 position-relative overflow-hidden">
            <div class="px-4 py-3 border-bottom">
              <h4 class="card-title mb-0">List Perjalanan</h4>
              <form method="GET" class="row g-2 align-items-end">
                  <div class="col-md-3">
                      <label class="form-label">Tanggal</label>
                      <input
                          type="date"
                          name="date"
                          class="form-control"
                          value="{{ request('date', now()->toDateString()) }}"
                      >
                  </div>

                  <div class="col-md-3">
                      <label class="form-label">No Kendaraan</label>
                      <input
                          type="text"
                          name="vehicle_number"
                          class="form-control"
                          placeholder="DH 7168 AA"
                          value="{{ request('vehicle_number') }}"
                      >
                  </div>

                  <div class="col-12 d-flex gap-2 mt-2">
                      <button class="btn btn-primary">
                          Filter
                      </button>

                      <a href="{{ url()->current() }}" class="btn btn-outline-secondary">
                          Reset
                      </a>
                  </div>
              </form>
            </div>
            <div class="card-body p-4">
              <div class="table-responsive mb-4 border rounded-1">
                <table class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Kendaraan</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Rute</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Penumpang</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Tanggal</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Aksi</h6>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($travels as $travel)
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          <a href="javascript:void(0)" class="text-bg-secondary text-white fs-6 round-40 rounded-circle me-n2 card-hover border border-2 border-white d-flex align-items-center justify-content-center">
                                    <i class="ti ti-bus"></i>
                                </a>
                          <div class="ms-3">
                            <h6 class="fs-4 fw-semibold mb-0">{{ $travel->vehicle_number }}</h6>
                            <!-- <span class="fw-normal">Web Designer</span> -->
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="mb-0 fw-normal fs-4">{{ $travel->from }} - {{ $travel->destination }}</p>
                      </td>
                      <td>
                        @if ($travel->tickets->count() > 3)
                        <div class="d-flex align-items-center gap-4 mb-4">
                            <div class="d-flex align-items-center">
                                @for ($i = 0; $i < 3; $i++)
                                  <a href="javascript:void(0)" class="text-bg-secondary text-white fs-6 round-40 rounded-circle me-n2 card-hover border border-2 border-white d-flex align-items-center justify-content-center">
                                    {{ $travel->tickets[$i]->name[0] }}
                                </a>
                                @endfor
                            </div>
                            <p class="mb-0">+{{ $travel->tickets->count() - 3 }} penumpang lainnya</p>
                        </div>
                        @else 
                            <p class="mb-0">{{ $travel->tickets->count() }} penumpang</p>
                        @endif
                      </td>
                      <td>
                        {{ $travel->date->format('d F Y') }}
                      </td>
                      <td>
                        <a href="{{ route('travels.show', $travel->id) }}" class="btn bg-primary-subtle text-primary">
                            <i class="ti ti-eye"></i>
                        </a>
                        <a href="{{ route('travels.edit', $travel->id) }}" class="btn bg-warning-subtle text-warning">
                            <i class="ti ti-edit"></i>
                        </a>
                        <button class="btn bg-danger-subtle text-danger btn-delete" data-id="{{ $travel->id }}" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm">
                            <i class="ti ti-trash"></i>
                        </button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="px-4 py-3 border-bottom">
                {{ $travels->links() }}
            </div>
          </div>

          <div class="modal fade" id="bs-example-modal-sm" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">
                            <form action="" method="post" id="delete-form">
                              @method('DELETE')
                              @csrf
                            <div class="modal-header d-flex align-items-center">
                              <h4 class="modal-title" id="myModalLabel">
                                Konfirmasi
                              </h4>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <p>
                                Apakah anda yakin ingin menghapus?
                              </p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn text-dark waves-effect" data-bs-dismiss="modal">
                                Tutup
                              </button>
                              <button type="submit" class="btn bg-danger-subtle text-danger  waves-effect">
                                Hapus
                              </button>
                            </div>
                            </form>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('.btn-delete').click(function() {
            let id = $(this).data('id');
            $('#delete-form').attr('action', `{{ route('travels.destroy', ':id') }}`.replace(':id', id));
        });
    });
</script>
@endpush