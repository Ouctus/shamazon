@extends('backend.layouts.master')
@section('content')
    <style>
        .error {
            color: red !important;
        }
    </style>
                <div class="app-main__outer">
                    <div class="app-main__inner">
                       <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Add Address Book</h5>
                <form id="product-form" method="POST" action="{{route('seller.product.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group mb-3" >
                            <label for="firstName2">Name</label>
                            <input type="text" class="form-control form-control-rounded" value="{{ old('name') }}" id="name" name="name" placeholder="Enter name">
                            @error('name')
                            <label id="label-error" class="error" for="first_name">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group mb-3" >
                            <label for="firstName2">Unit Price</label>
                            <input type="number" min="0" class="form-control form-control-rounded" value="{{ old('unit_price') }}" id="unit_price" name="unit_price" placeholder="Enter unit price">
                            @error('unit_price')
                            <label id="label-error" class="error" for="first_name">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group mb-3" >
                            <label for="firstName2">Available Quantity</label>
                            <input type="number" min="1" class="form-control form-control-rounded" value="{{ old('available_quantity') }}" id="available_quantity" name="available_quantity" placeholder="Enter available quantity">
                            @error('available_quantity')
                            <label id="label-error" class="error" for="first_name">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group mb-3" >
                        <label for="firstName2">Currency</label>
                            <select class="form-control form-control-rounded"  id="currency" name="currency" placeholder="Enter your city name">
                                <option value="">Select Currency</option>
                                @if(!$currencies->isEmpty())
                                    @foreach($currencies as $currency)
                                <option value="{{$currency->id}}">{{$currency->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('currency')
                            <label id="label-error" class="error" for="first_name">{{ $message }}</label>
                            @enderror
                            </div>

                        <div class="col-md-12">
                            <button type="" id="btn-submit" class="btn btn-primary ">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="app-wrapper-footer">
                        <div class="app-footer">
                            <div class="app-footer__inner">
                                <div class="app-footer-left">
                                    <ul class="nav">
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                Footer Link 1
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                Footer Link 2
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="app-footer-right">
                                    <ul class="nav">
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                Footer Link 3
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                <div class="badge badge-success mr-1 ml-0">
                                                    <small>NEW</small>
                                                </div>
                                                Footer Link 4
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
</div>
@endsection
@section('script')
<script>

    var ajax_req;

    $(document).ready(function(){     
        
        $("#product-form").validate({
            rules: {
            
                name: {
                    required              : true,
                    normalizer: function( value ) {
                        return $.trim( value );
                    },
                },
                unit_price: {
                    required              : true,
                    normalizer: function( value ) {
                        return $.trim( value );
                    },
                },
               
                available_quantity: {
                    required              : true,
                    normalizer: function( value ) {
                        return $.trim( value );
                    },
                },
                currency: {
                    required              : true,
                    normalizer: function( value ) {
                        return $.trim( value );
                    },
                },
                
            },
            messages: {
                name   :  {
                    required              : "The name field is required.",
                },
               
                unit_price   :  {
                    required              : "The unit price field is required.",
                },
                available_quantity   :  {
                    required              : "The available quantity field is required.",
                },
                currency   :  {
                    required              : "The currency field is required.",
                },
            },
        });

    });
</script>
@endsection
