@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <passport-clients></passport-clients>
                        <passport-authorized-clients></passport-authorized-clients>
                        <passport-personal-access-tokens></passport-personal-access-tokens>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>

        /*
        lists
        axios.get('/oauth/clients')
        .then(response => {
            console.log(response.data);
        });
        */


        /*
        added
        const data = {
            name: 'Client Name',
            redirect: 'http://example.com/callback'
        };

        axios.post('/oauth/clients', data)
            .then(response => {
                console.log(response.data);
            })
            .catch (response => {
                // List errors on response...
            });
        */

        /*
        updated
        const clientId = 7;
        const data = {
            name: 'New Client Name',
            redirect: 'http://example.com/callback'
        };

        axios.put('/oauth/clients/' + clientId, data)
            .then(response => {
                console.log(response.data);
            })
            .catch (response => {
                // List errors on response...
            });
        */

        /*
        deleted
        axios.delete('/oauth/clients/' + 8)
            .then(response => {
                //
            });
        */

    </script>
@endpush
