
@extends('layouts.layout')

@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Halaman Tiket</h4>
                <p class="text-muted">Kumpulan tiket yang terjual</p>
                <a href="{{ route('tickets.create') }}" class="btn btn-primary text-white"><i class="ti ti-plus"></i> Tambah Tiket</a>
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
            <div class="px-4 py-3 border-bottom">
              <h4 class="card-title mb-0">List Tiket</h4>
            </div>
            <div class="card-body p-4 border-bottom">
              <div class="table-responsive mb-4 border rounded-1">
                <table class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Kendaraan</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Nama</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Whatsapp</h6>
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
                    @forEach($tickets as $ticket)
                      <tr>
                        <td>
                          <div class="d-flex align-items-center">
                            <a href="javascript:void(0)" class="text-bg-secondary text-white fs-6 round-40 rounded-circle me-n2 card-hover border border-2 border-white d-flex align-items-center justify-content-center">
                                      <i class="ti ti-bus"></i>
                                  </a>
                            <div class="ms-3">
                            <h6 class="fs-4 fw-semibold mb-0">{{ $ticket->travel->vehicle_number }}</h6>
                            <span class="fw-normal">{{ $ticket->travel->from }} - {{ $ticket->travel->destination }}</span>
                            </div>

                          </div>
                        </td>
                        <td>
                          {{ $ticket->name }} (No. {{ $ticket->seat_no }})
                        </td>
                        <td>
                          {{ $ticket->whatsapp }}
                        </td>
                        <td>
                          {{ $ticket->travel->date->format('d F Y') }}
                        </td>
                        <td class="text-center">
                          <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn bg-warning-subtle text-warning text-warning"><i class="ti ti-edit"></i></a>
                          <a href="#" class="btn bg-danger-subtle text-danger btn-delete" data-id="{{ $ticket->id }}" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm"><i class="ti ti-trash"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="px-4 py-3 border-bottom">
                {{ $tickets->links() }}
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
            $('#delete-form').attr('action', `{{ route('tickets.destroy', ':id') }}`.replace(':id', id));
        });
    });
</script>
@endpush