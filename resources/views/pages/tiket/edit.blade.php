
@extends('layouts.layout')

@section('content')

    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Halaman Edit Tiket</h4>
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

    @if ($errors->any())
      <div class="alert alert-danger">
          <ul class="mb-0">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card position-relative overflow-hidden">
        <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
            @method('PATCH')
            @csrf()
            <input type="hidden" id="seat_no" name="seat_no" value="{{ old('seat_no', $ticket->seat_no) }}">
            <input type="hidden" id="travel_id" name="travel_id" value="{{ $ticket->travel_id }}">
            <div class="px-4 py-3 border-bottom">
              <h4 class="card-title mb-0">Formulir Edit Tiket</h4>
            </div>
            <div class="card-body p-4 border-bottom">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tanggal Berangkat <span class="text-danger">*</span></label>
                            <input type="date" name="date" class="form-control" value="{{ $ticket->travel->date->format('Y-m-d') }}" id="date">
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
                                <option value="kupang" {{ $ticket->from == 'kupang' ? 'selected' : '' }}>Kupang</option>
                                <option value="soe" {{ $ticket->from == 'soe' ? 'selected' : '' }}>Soe</option>
                                <option value="kefa" {{ $ticket->from == 'kefa' ? 'selected' : '' }}>Kefa</option>
                                <option value="atambua" {{ $ticket->from == 'atambua' ? 'selected' : '' }}>Atambua</option>
                                <option value="dili" {{ $ticket->from == 'dili' ? 'selected' : '' }}>Dili</option>
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
                                <option value="kupang" {{ $ticket->destination == 'kupang' ? 'selected' : '' }}>Kupang</option>
                                <option value="soe" {{ $ticket->destination == 'soe' ? 'selected' : '' }}>Soe</option>
                                <option value="kefa" {{ $ticket->destination == 'kefa' ? 'selected' : '' }}>Kefa</option>
                                <option value="atambua" {{ $ticket->destination == 'atambua' ? 'selected' : '' }}>Atambua</option>
                                <option value="dili" {{ $ticket->destination == 'dili' ? 'selected' : '' }}>Dili</option>
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
                            <label for="exampleInputPassword1">Nama <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Rahmat Arianto" name="name" class="form-control" value="{{ $ticket->name }}" id="exampleInputPassword1">
                            @error('name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor Whatsapp <span class="text-danger">*</span></label>
                            <input type="text" name="whatsapp" class="form-control" value="{{ $ticket->whatsapp }}" placeholder="08XXXXXXXX" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('whatsapp')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Kelamin</label>
                            <select name="gender" class="form-control" id="">
                                <option {{ $ticket->gender == 'm' ? 'selected' : '' }} value="m">Laki-Laki</option>
                                <option {{ $ticket->gender == 'f' ? 'selected' : '' }} value="f">Perempuan</option>
                            </select>
                            @error('destination')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Usia</label>
                            <select name="age" class="form-control" id="">
                                <option {{ $ticket->age == 'dewasa' ? 'selected' : '' }} value="dewasa">Dewasa</option>
                                <option {{ $ticket->age == 'anak-anak' ? 'selected' : '' }} value="anak-anak">Anak-Anak</option>
                            </select>
                            @error('destination')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor Passport</label>
                            <input type="text" name="passport" class="form-control" value="{{ $ticket->passport }}" placeholder="XXXXXXXX" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('passport')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kewarganegaraan</label>
                            <select name="citizenship" class="form-control" id="">
                                <option value="WNI" {{ $ticket->citizenship == 'WNI' ? 'selected' : '' }}>WNI</option>
                                <option value="WNA" {{ $ticket->citizenship == 'WNA' ? 'selected' : '' }}>WNA</option>
                            </select>
                            @error('citizenship')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="pickup" {{ $ticket->pickup ? 'checked' : '' }}>
                            <label class="form-check-label" for="pickup">
                              Jemput Penumpang
                            </label>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 hide" id="input-pickup">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Posisi Jemput</label>
                            <input type="text" name="pickup" class="form-control" value="{{ $ticket->pickup }}" placeholder="Jemput di Hotel X" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('pickup')
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
            let travelId = $("#travel_id").val();

            travels.forEach(function(travel) {
                html += `<option value="${travel.id}" ${travel.id == travelId ? 'selected' : ''}>
                    ${travel.from} - ${travel.destination} (${travel.vehicle_number})
                </option>`;
            });

            $('#rute')
                .html(html)
                .trigger('change');
        }

        $('#rute').change(function () {
            const travelId = $(this).val();
            const seat_no = $("#seat_no").val();

            $('#travel_id').val(travelId);

            // reset semua seat
            $('.seat')
                .removeClass('seat-booked active')
                .prop('disabled', false);

            if (seat_no) {
                $(`.seat[data-val="${seat_no}"]`)
                    .addClass('active')
                $('#seat_no').val(seat_no);
            } else {
                $('#seat_no').val("");
            }

            if (!travelId) return;

            $.get(`/travel/${travelId}/seats`, function (res) {
                res.booked_seats.filter(seat => seat != seat_no).forEach(seat => {
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
        
        $('.seat').click(function() {
            // check if checked 
            let checks = $(this).attr('class');
            if (checks.indexOf('active') > -1) {
                $('#seat_no').val("");
                $(this).removeClass('active');
                return;
            }

            $('.seat.active').removeClass('active');

            var seat_no = $(this).data('val');
            $('#seat_no').val(seat_no);
            $(this).addClass('active');
        });
    });
</script>
@endpush