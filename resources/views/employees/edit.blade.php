<div class="container">
    <h2>Edit employee</h2>
    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method("PATCH")
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>