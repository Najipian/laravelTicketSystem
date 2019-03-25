@extends('tenant.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Ticket</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/tenant/ticket') }}">
                        @csrf
                        <div class="col-md-6 offset-md-3 col-xs-12">
                            <div class="form-group{{ $errors->has('property_id') ? ' has-error  has-feedback' : '' }}">
                                <label for="property_id">Property</label>
                                <select class="form-control" name="property_id" id="property_id">
                                    <option value="">Select</option>
                                    @foreach(Auth::user()->properties as $property)
                                        <option value="{{ $property->id }}" @if(old('property_id') == $property->id) selected @endif>{{ $property->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('property_id'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('property_id') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('title') ? ' has-error  has-feedback' : '' }}">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                                @if ($errors->has('title'))
                                <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('description') ? ' has-error  has-feedback' : '' }}">
                                <label for="description">Description</label>
                                <textarea class="form-control" rows="5" id="description" name="description">{{ e(old('description')) }}</textarea>
                                @if ($errors->has('description'))
                                <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Send</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
