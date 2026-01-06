
@extends('layouts.layout')

@section('content')

    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Halaman Tambah Tiket</h4>
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
        <div class="col-md-8">
            <div class="card position-relative overflow-hidden">
        <form action="{{ route('tickets.store') }}" method="POST">
            @method('POST')
            @csrf()
            <div id="seat-input-wrapper"></div>
            <input type="hidden" id="travel_id" name="travel_id" value="{{ old('travel_id') }}">
            <div class="px-4 py-3 border-bottom">
              <h4 class="card-title mb-0">Formulir Tambah Tiket</h4>
            </div>
            <div class="card-body p-4 border-bottom">
                <div class="row">
                    <div class="col-md-6 mb-3">
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
                    <div class="col-md-6 mb-3">
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
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Naik</label>
                            <select name="from" class="form-control" id="">
                                <option value="" selected> -- Pilih -- </option>
                                <option value="kupang" {{ old('form') == 'kupang' ? 'selected' : '' }}>Kupang</option>
                                <option value="soe" {{ old('form') == 'soe' ? 'selected' : '' }}>Soe</option>
                                <option value="kefa" {{ old('form') == 'kefa' ? 'selected' : '' }}>Kefa</option>
                                <option value="atambua" {{ old('form') == 'atambua' ? 'selected' : '' }}>Atambua</option>
                                <option value="dili" {{ old('form') == 'dili' ? 'selected' : '' }}>Dili</option>
                            </select>
                            @error('from')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Turun</label>
                            <select name="destination" class="form-control" id="">
                                <option value="" selected> -- Pilih -- </option>
                                <option value="kupang" {{ old('destination') == 'kupang' ? 'selected' : '' }}>Kupang</option>
                                <option value="soe" {{ old('destination') == 'soe' ? 'selected' : '' }}>Soe</option>
                                <option value="kefa" {{ old('destination') == 'kefa' ? 'selected' : '' }}>Kefa</option>
                                <option value="atambua" {{ old('destination') == 'atambua' ? 'selected' : '' }}>Atambua</option>
                                <option value="dili" {{ old('destination') == 'dili' ? 'selected' : '' }}>Dili</option>
                            </select>
                            @error('destination')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor Whatsapp <span class="text-danger">*</span></label>
                            <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp') }}" placeholder="08XXXXXXXX" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('whatsapp')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group" >
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="pickup" {{ old('pickup') ? 'checked' : '' }}>
                            <label class="form-check-label" for="pickup">
                              Jemput Penumpang
                            </label>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 hide" id="input-pickup">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Posisi Jemput</label>
                            <input type="text" name="pickup" class="form-control" value="{{ old('pickup') }}" placeholder="Jemput di Hotel X" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('pickup')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="row passenger-item passenger-template">
                        <div class="col-md-12 text-end mb-2 remove-wrapper d-none">
                            <button type="button" class="btn btn-sm btn-outline-danger remove-passenger">
                                Hapus Penumpang
                            </button>
                        </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nama <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Rahmat Arianto" name="passengers[0][name]" class="form-control" value="{{ old('passengers.0.name') }}" id="exampleInputPassword1">
                            @error('passengers.0.name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Kelamin</label>
                            <select name="passengers[0][gender]" class="form-control" id="">
                                <option value="m">Laki-Laki</option>
                                <option value="f">Perempuan</option>
                            </select>
                            @error('passengers.0.gender')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Usia</label>
                            <select name="passengers[0][age]" class="form-control" id="">
                                <option value="dewasa">Dewasa</option>
                                <option value="anak-anak">Anak-Anak</option>
                            </select>
                            @error('passengers.0.age')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor Passport</label>
                            <input type="text" name="passengers[0][passport]" class="form-control" value="{{ old('passengers.0.passport') }}" placeholder="XXXXXXXX" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('passengers.0.passport')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kewarganegaraan</label>
                            <select name="passengers[0][citizenship]" class="form-control" id="">
                                <option value="WNI" {{ old('passengers.0.citizenship') == "WNI" ? 'selected' : '' }}>WNI</option>
                                <option value="WNA" {{ old('passengers.0.citizenship') == "WNA" ? 'selected' : '' }}>WNA</option>
                            </select>
                            @error('passengers.0.citizenship')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="button" id="add-passenger" class="btn btn-outline-primary btn-sm">
                            + Tambah Penumpang
                        </button>
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
        <div class="col-md-4">
            <div class="card position-relative overflow-hidden">
                <div class="px-4 py-3 border-bottom">
                  <h4 class="card-title mb-0">List Kursi</h4>
                   @error('seat_no')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="card-body">
                    <div class="seat-wrapper">

                        <!-- ROW 1 -->
                        <div class="seat-row">
                            <button data-val="1" class="seat">1</button>
                            <button data-val="2" class="seat">2</button>
                            <div class="aisle"></div>
                            <button data-val="3" class="seat">3</button>
                            <button data-val="4" class="seat">4</button>
                        </div>

                        <!-- ROW 2 -->
                        <div class="seat-row">
                            <button data-val="5" class="seat">5</button>
                            <button data-val="6" class="seat">6</button>
                            <div class="aisle"></div>
                            <button data-val="7" class="seat">7</button>
                            <button data-val="8" class="seat">8</button>
                        </div>

                        <!-- ROW 3 -->
                        <div class="seat-row">
                            <button data-val="9" class="seat">9</button>
                            <button data-val="10" class="seat">10</button>
                            <div class="aisle"></div>
                            <button data-val="11" class="seat">11</button>
                            <button data-val="12" class="seat">12</button>
                        </div>

                        <!-- ROW 4 -->
                        <div class="seat-row">
                            <button data-val="13" class="seat">13</button>
                            <button data-val="14" class="seat">14</button>
                            <div class="aisle"></div>
                            <button data-val="15" class="seat">15</button>
                            <button data-val="16" class="seat">16</button>
                        </div>

                        <!-- ROW 5 -->
                        <div class="seat-row">
                            <button data-val="17" class="seat">17</button>
                            <button data-val="18" class="seat">18</button>
                            <div class="aisle"></div>
                            <button data-val="19" class="seat">19</button>
                            <button data-val="20" class="seat">20</button>
                        </div>

                        <!-- ROW 6 -->
                        <div class="seat-row">
                            <button data-val="21" class="seat">21</button>
                            <button data-val="22" class="seat">22</button>
                            <div class="aisle"></div>
                            <button data-val="23" class="seat">23</button>
                            <button data-val="24" class="seat">24</button>
                        </div>

                        <!-- ROW 7 -->
                        <div class="seat-row">
                            <div class="empty"></div>
                            <div class="empty"></div>
                            <div class="aisle"></div>
                            <button data-val="25" class="seat">25</button>
                            <button data-val="26" class="seat">26</button>
                        </div>

                        <!-- ROW 8 -->
                        <div class="seat-row center">
                            <button data-val="27" class="seat">27</button>
                            <button data-val="28" class="seat">28</button>
                            <button data-val="29" class="seat">29</button>
                            <button data-val="30" class="seat">30</button>
                            <button data-val="31" class="seat">31</button>
                        </div>

                    </div>
                </div>
            </div>  
        </div>
    </div>
@endsection

@push('js')

<script>
    $(document).ready(function() {

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

            // reset semua seat
            $('.seat')
                .removeClass('seat-booked active')
                .prop('disabled', false);

            $('#seat_no').val("");

            if (!travelId) return;

            $.get(`/travel/${travelId}/seats`, function (res) {
                res.booked_seats.forEach(seat => {
                    $(`.seat[data-val="${seat}"]`)
                        .addClass('seat-booked')
                        .prop('disabled', true);
                });
            });
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
        
        let passengerIndex = 1;

        $('#add-passenger').click(function () {

            let clone = $('.passenger-template').first().clone();

            // update name index & reset value
            clone.find('input, select').each(function () {
                let name = $(this).attr('name');

                if (name) {
                    let newName = name.replace('[0]', '[' + passengerIndex + ']');
                    $(this).attr('name', newName);

                    if ($(this).is('input')) {
                        $(this).val('');
                    }
                }
            });

            // tampilkan tombol hapus
            clone.find('.remove-wrapper').removeClass('d-none');

            clone.insertBefore($(this).closest('.col-md-12'));
            passengerIndex++;
        });

        $(document).on('click', '.remove-passenger', function () {
            $(this).closest('.passenger-item').remove();
        });

        $('.seat').click(function () {

            if ($(this).hasClass('seat-booked')) return;

            let seatNo = $(this).data('val');

            // batal pilih
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $(`#seat-input-wrapper input[value="${seatNo}"]`).remove();
                return;
            }

            // pilih kursi
            $(this).addClass('active');

            $('#seat-input-wrapper').append(
                `<input type="hidden" name="seat_no[]" value="${seatNo}">`
            );
        });
    });
</script>
@endpush