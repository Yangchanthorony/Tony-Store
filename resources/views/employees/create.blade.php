<div class="container">
    <h2>Create employees</h2>
    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="section" class="form-label">section</label>
            <input type="text" class="form-control" name="section" value="{{ old('section') }}">
            @error("section")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="qty" class="form-label">qty</label>
            <input type="text" class="form-control" name="qty" value="{{ old('qty') }}">
            @error("qty")
                <p class="text-danger">{{ $message }}</p>
            @enderror

        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>