@extends('app')

@section('content')
    <div class="container">
        <table class="table table-bordered table-stripped">
            <thead>
            <tr>
                <th>No.</th>
                <th>Account</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php $count = 1;?>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $count }}</td>
                    <td>{{ $contact->account }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->event }}</td>
                </tr>
                <?php $count++;?>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection