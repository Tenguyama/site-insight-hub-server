@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ Auth::user()->name }}'s sites</div>
                <div class="card-body text-md-center">
                    <button type="button" class="btn btn-success mb-4" onclick="addSiteButtonClick()">Add site to the list</button>
                    @if(count($sites)>0)
                        <table class="table">
                            <tr>
                                <th scope="col">Site name</th>
                                <th scope="col">Site page</th>
                                <th scope="col">Actions</th>
                            </tr>
                            @foreach($sites as $site)
                                <tr>
                                    <td>{{$site->name}}</td>
                                    <td>{{$site->url_page}}</td>
                                    <td>
                                        <div class="flex-row">
                                            <button type="button" class="btn btn-primary" onclick="showSiteButtonClick({{$site->id}})">Show</button>
                                            <button type="button" class="btn btn-danger" onclick="deleteSiteButtonClick({{$site->id}})">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>It looks like you don't have a single website</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function addSiteButtonClick(){
        window.location.href = '/site/add';
    }

    function showSiteButtonClick(siteId) {
        console.log('{{ url('/api/v1/site') }}/' + siteId);
        // Тут викликати редірект на сторінку з показом сайту і його статистики
    }

    function deleteSiteButtonClick(siteId) {
        if (confirm("Are you sure you want to remove this site from the list?")) {
            axios.delete('{{ url('/api/v1/site') }}/' + siteId, {
                headers: {
                    Authorization: `Bearer ${'{{ Auth::user()->createToken("token-name")->plainTextToken }}'}`
                }
            })
                .then(response => {
                    console.log(response.data);
                    location.reload();
                })
                .catch(error => {
                    console.error(error);
                });
        } else {
            alert("Your site has not been removed from the list");
        }
    }

</script>


@endsection
