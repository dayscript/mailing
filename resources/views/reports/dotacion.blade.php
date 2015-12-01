@extends('app')

@section('content')
    <div class="container">
        <table class="table table-bordered table-stripped">
            <thead>
            <tr>
                <th>No.</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php $count = 1;?>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $count }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->lastEvent()[0]}}</td>
                </tr>
                <?php $count++;?>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection