


<form action="{{ route('GymManagers.store') }}" method="POST">

    @csrf
    <label for="">name</label>
    <input type="text" name="name"><br>

    <label for="">email</label>
    <input type="email" name="email"><br>

    <label for="">password</label>
    <input type="password" name="password"><br>

    <label for="">national id</label>
    <input type="number" name="national_id"><br>

    <label for="">profile img</label>
    <input type="text" name="img"><br>

    <button type="submit">Save</button>

</form>
