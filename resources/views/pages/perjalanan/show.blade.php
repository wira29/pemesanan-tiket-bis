
@extends('layouts.layout')

@section('content')

    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Halaman Detail Perjalanan</h4>
                <p class="text-muted">Detail perjalanan yang terjual</p>
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
            <input type="hidden" id="travel_id" name="travel_id" value="{{ $travel->id }}">
            <div class="px-4 py-3 border-bottom">
              <h4 class="card-title mb-0">List Penumpang</h4>
            </div>
            <div class="card-body p-4 border-bottom">
                <table class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark fs-4">
                    <tr>
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
                  <tbody>
                    @foreach($tickets as $ticket)
                      <tr>
                        <td>
                          {{ $ticket->seat_no }}
                        </td>
                        <td>
                          <h6>{{ $ticket->name }}</h6>
                            <p class="text-muted">{{ $ticket->gender == 'm' ? 'Laki-Laki' : 'Perempuan' }}</p>
                        </td>
                        <td>
                          {{ $ticket->whatsapp }}
                        </td>
                        <td>
                          {{ $ticket->age }}
                        </td>
                        <td>
                          {{ $ticket->passport ?? 'Tidak ada' }}
                        </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
            </div>
            <div class="px-4 py-3 border-bottom">
                <a  target="_blank" href="{{ route('travels.print', $travel->id) }}" class="btn btn-danger">
                    <i class="ti ti-file-text fs-4"></i>
                    Cetak PDF
                </a>
            </div>
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

        setSeats();
        function setSeats() {
             const travelId = $("#travel_id").val();

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
        }
    });
</script>
@endpush