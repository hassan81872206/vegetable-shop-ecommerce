@extends('admin.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <h2>Customers</h2>
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                @php
                    $count = 1 
                @endphp
                @forelse ($customers as $customer)
                    <tr meta-data = "tr-{{$customer->userID}}">
                        <td>{{$count}}</td>
                        <td>{{$customer->name}}</td>
                        <td>{{$customer->email}}</td>
                        <td>{{$customer->phone}}</td>
                        <td>{{ \Carbon\Carbon::parse($customer->created_at)->toFormattedDateString() }}</td>                       
                        <td>
                            <button onclick="deleteCustomer({{$customer->userID}})" type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    @php
                        $count++ 
                    @endphp
                @empty
                    <tr>
                        <td>Empty</td>
                        <td>Empty</td>
                        <td>Empty</td>
                        <td>Empty</td>
                        <td>Empty</td>
                        <td>Empty</td>
                    </tr>
                @endforelse
            </table>
            {{$customers->links()}}
        </div>
    </div>
    
@endsection
<script>
    function deleteCustomer(customerID){
        const myHeaders = new Headers();
        myHeaders.append("X-CSRF-TOKEN", "{{csrf_token()}}");

        const requestOptions = {
        method: "DELETE",
        headers: myHeaders,
        // redirect: "follow"
        };

        fetch(`/customers/${customerID}`, requestOptions)
        .then((response) => response.json())
        .then((result) => getData(result , customerID))
        .catch((error) => console.error(error));
    }
    function getData(result , customerID){
        if(result.deleted){
            let row = document.querySelector(`tr[meta-data="tr-${customerID}"]`);
            row.remove();
        }
    }
</script>