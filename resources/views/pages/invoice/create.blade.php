
@extends('layouts.layout')

@section('content')

    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Halaman Tambah Invoice</h4>
                <p class="text-muted">Isi formulir dibawah ini dengan benar.</p>
            </div>
            <div class="col-3">
                <div class="text-center mb-n5">
                <img src="{{ asset('') }}assets/images/breadcrumb/ChatBc.png" alt="modernize-img" class="img-fluid mb-n4">
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card position-relative overflow-hidden">
                <form action="{{ route('invoices.store') }}" method="POST">
                    @method('POST')
                    @csrf()
                    <div id="seat-input-wrapper"></div>
                    <input type="hidden" id="travel_id" name="travel_id" value="{{ old('travel_id') }}">
                    <input type="hidden" id="passengers" name="passengers" value="{{ old('passengers') }}">
                    <div class="px-4 py-3 border-bottom">
                    <h4 class="card-title mb-0">Formulir Tambah Invoice</h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tanggal Berangkat <span class="text-danger">*</span></label>
                                    <input type="date" name="date" class="form-control" value="{{ old('date', date('Y-m-d')) }}" id="date">
                                    @error('date')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Rute <span class="text-danger">*</span></label>
                                    <select name="" class="form-control" id="rute">
                                        <option value="" disabled selected>- Pilih Tanggal Terlebih Dahulu -</option>
                                    </select>
                                    @error('travel_id')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="invoice">Kode Invoice <span class="text-danger">*</span></label>

                                    <div class="input-group">
                                        <input
                                            type="text"
                                            placeholder="INV-05267"
                                            name="invoice_code"
                                            class="form-control"
                                            value="{{ old('invoice_code') }}"
                                            id="invoice"
                                        >
                                        <button type="button" id="generate-btn" class="btn btn-info">
                                            Generate
                                        </button>
                                    </div>

                                    @error('invoice_code')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Total Harga <span class="text-danger">*</span></label>
                                    <input type="text" name="total_price" class="form-control" value="{{ old('total_price', 0) }}" id="total_price">
                                    @error('total_price')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12 p-4 border-bottom table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th width="40">
                                        <input type="checkbox" class="form-check-input" id="check-all">
                                    </th>
                                    <th>
                                        <h6 class="fs-4 fw-semibold mb-0">No Kursi</h6>
                                    </th>
                                    <th>
                                        <h6 class="fs-4 fw-semibold mb-0">Nama</h6>
                                    </th>
                                    <th>
                                        <h6 class="fs-4 fw-semibold mb-0">Whatsapp</h6>
                                    </th>
                                    <th>
                                        <h6 class="fs-4 fw-semibold mb-0">Umur</h6>
                                    </th>
                                    <th>
                                        <h6 class="fs-4 fw-semibold mb-0">Passport</h6>
                                    </th>
                                    </tr>
                                </thead>
                                <tbody id="ticket-tbody">
                                    
                                </tbody>
                                </table>
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
        </div>
    </div>
@endsection

@push('js')

<script>
    $(document).ready(function() {

        // generaet code 
        function generateInvoice() {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let result = '';
            for (let i = 0; i < 8; i++) {
                result += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            $('#invoice').val('INV-' + result);
        }

        $('#generate-btn').click(function() {
            generateInvoice();
        });

        if ($('#pickup').is(':checked')) {
            $('#input-pickup').removeClass('hide');
        }

        $('#pickup').change(function() {
            if ($(this).is(':checked')) {
                $('#input-pickup').removeClass('hide');
            } else {
                $('#input-pickup').addClass('hide');
            }
        });

        getTravelsByDate($('#date').val());

        $('#date').change(function() {
            console.log('change');
            var date = $(this).val();
            
            getTravelsByDate(date);
        });

        function setTravels(travels) {
            let html = '<option value="">-- Pilih Rute --</option>';

            travels.forEach(function(travel) {
                html += `<option value="${travel.id}" data-is-half='${travel.is_half}'>
                    ${travel.from} - ${travel.destination} (${travel.vehicle_number})
                </option>`;
            });

            $('#rute')
                .html(html)
                .trigger('change');
        }

        $('#rute').change(function () {
            const travelId = $(this).val();
            $('#travel_id').val(travelId);

            const selected = $(this).find('option:selected');

            if (!selected.val()) {
                console.log('Belum ada rute dipilih');
                return;
            }

            if (!travelId) return;

            $.get(`/tickets/getTicketByTravel/${travelId}`, function (res) {
                console.log(res);
                let html = ''
                res.tickets.forEach(ticket => {
                    html += `<tr>
                        <td>
                            <input
                                type="checkbox"
                                class="ticket-checkbox form-check-input"
                                name="ticket_ids[]"
                                value="${ticket.id}"
                            >
                        </td>
                        <td>
                            ${ticket.seat_no}
                        </td>
                        <td>
                            <h6>${ticket.name}</h6>
                                <p class="text-muted">${ticket.gender == 'm' ? 'Laki-Laki' : 'Perempuan'}</p>
                        </td>
                        <td>
                            ${ticket.whatsapp}
                        </td>
                        <td>
                            ${ticket.age}
                        </td>
                        <td>
                            ${ticket.passport ?? 'Tidak ada'}
                        </td>
                    </tr>`
                });

                $('#ticket-tbody').html(html);
            });
        });

        function updatePassengersInput() {
            let selectedIds = [];

            $('.ticket-checkbox:checked').each(function () {
                selectedIds.push($(this).val());
            });

            // Simpan sebagai string dipisah koma
            $('#passengers').val(selectedIds.join(','));
        }
        
        $(document).on('change', '.ticket-checkbox', function () {
            updatePassengersInput();
        });

        $(document).on('change', '#check-all', function () {
            $('.ticket-checkbox').prop('checked', this.checked);
            updatePassengersInput();
        });

        function getTravelsByDate(date) {
            $.ajax({
                url: "{{ route('travels.getTravelsByDate') }}",
                type: 'GET',
                data: {
                    date: date
                },
                success: function(data) {
                    console.log(data);
                    if (data.travels.length > 0) {
                        setTravels(data.travels);
                    } else {
                        $('#rute').html('<option value="">-- Pilih Rute --</option>');
                        $('.seat')
                        .removeClass('seat-booked active')
                        .prop('disabled', false);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
        
        
    });
</script>
@endpush