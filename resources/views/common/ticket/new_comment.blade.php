<br/>
@if($ticket->status == OPEN_TICKET_STATUS)
<div class="row justify-content-center">
    <div class="col-md-8">
        <form method="POST" action="{{ url($routePrefix . '/ticket/' . $ticket->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group{{ $errors->has('comment') ? ' has-error  has-feedback' : '' }}">
                <label for="comment">Comment</label>
                <textarea class="form-control" rows="5" id="comment" name="comment">{{ e(old('comment')) }}</textarea>
                @if ($errors->has('comment'))
                <span class="text-danger" role="alert">
                    <strong>{{ $errors->first('comment') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Send</button>
            </div>
        </form>
    </div>
</div>
@endif
