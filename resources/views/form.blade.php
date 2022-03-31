@extends('layout')

@section('content')
    <div class="container">
        <form method="post" action="{{ route('submit_form') }}" class="needs-validation" novalidate>
            {{ csrf_field() }}

            <div class="form-group">
                <label>Symbol:</label>
                <select class="form-select" aria-label="Company Symbol:" name="symbol">
                    @foreach($symbols as $symbol)
                        <option value="{{$symbol->getSymbol()}}">{{$symbol->getSymbol()}}</option>
                    @endforeach
                </select>
                @if ($errors->has('symbol'))
                    <span class="text-danger">{{ $errors->first('symbol') }}</span>
                @endif
            </div>

            <div class="form-group has-validation">
                <label for="email">Email:</label>
                <input type="text" name="email" class="form-control" placeholder="Email" id="email" required>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <div class="invalid-feedback">
                    Email required
                </div>
            </div>

            <div class="form-group has-validation">
                <label for="dateStart" class="col-1 col-form-label">Start date:</label>
                <div class="col">
                    <div class="input-group date" id="datepicker">
                        <input type="text" class="form-control" id="dateStart" name="dateStart" required/>
                        <span class="input-group-append">
                          <span class="input-group-text bg-light d-block">
                            <i class="fa fa-calendar"></i>
                          </span>
                        </span>
                        @if ($errors->has('dateStart'))
                            <span class="text-danger">{{ $errors->first('dateStart') }}</span>
                        @endif
                        <div class="invalid-feedback">
                            Start date required
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group has-validation">
                <label for="dateEnd" class="col-1 col-form-label">End date:</label>
                <div class="col">
                    <div class="input-group date" id="datepicker1">
                        <input type="text" class="form-control" id="dateEnd" name="dateEnd" required/>
                        <span class="input-group-append">
                          <span class="input-group-text bg-light d-block">
                            <i class="fa fa-calendar"></i>
                          </span>
                        </span>
                        @if ($errors->has('dateEnd'))
                            <span class="text-danger">{{ $errors->first('dateEnd') }}</span>
                        @endif
                        <div class="invalid-feedback">
                            End end required
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="form-group">
                <button class="btn btn-success btn-submit">Submit</button>
            </div>
        </form>

    </div>
@endsection

@push('bottomScripts')
    <script>
        window.onload = function () {
            $(function(){
                $('#datepicker').datepicker({
                    format: 'yyyy-mm-dd'
                });
            });
            $(function(){
                $('#datepicker1').datepicker({
                    format: 'yyyy-mm-dd'
                });
            });

            (function () {
                'use strict'

                // Получите все формы, к которым мы хотим применить пользовательские стили проверки Bootstrap
                var forms = document.querySelectorAll('.needs-validation')

                // Зацикливайтесь на них и предотвращайте отправку
                Array.prototype.slice.call(forms)
                    .forEach(function (form) {
                        form.addEventListener('submit', function (event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                    })
            })()
        }
    </script>
@endpush
