 @extends('Frontend.Layoutes.app')

@section('main')

<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Saved Jobs</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('Frontend.account.sidebar')
            </div>


            <div class="col-lg-9">
            <!-- ================> Alert Here <============== -->
            @include('Frontend.messages')

                <div id="showAlert" class="card border-0 shadow mb-4 p-3">
                    <div class="card-body card-form">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="fs-4 mb-1">Saved Jobs</h3>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table " id="jobs-table">
                                {{-- @yield('saved-jobs-table') --}}
                            </table>
                        </div>
                        <div id="pagination-container">
                            {{-- {{ $savedJobs->links() }} --}}
                            {{-- @if ($savedJobs->lastPage() > 1)
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item {{ $savedJobs->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $savedJobs->previousPageUrl() }}" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        @for ($i = 1; $i <= $savedJobs->lastPage(); $i++)
                                            <li class="page-item {{ $savedJobs->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $savedJobs->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        <li class="page-item {{ $savedJobs->currentPage() == $savedJobs->lastPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $savedJobs->nextPageUrl() }}" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customeJs')
<script>
    $(document).ready(function(){
        loadSavedJobs();
    });

    function loadSavedJobs() {
        $.ajax({
            url: '{{ route("saveJob.show") }}',
            type: 'GET',
            dataType: 'html',
            success: function(response) {
                $('#jobs-table').html(response);
            },
            error: function(xhr, status, error) {
                showAlert('There is some issue with your code.',6000)
                console.error(error);
            }
        });
    }

    function removeJob(id){
        if (confirm("Are You sure you want to Remove Job?")) {
            $.ajax({
                url: '{{ route("job.removeJobs") }}',
                type:'delete',
                dataType:'json',
                data:{ id:  id},
                success:function (response) {
                }
            });
        }
    }
</script>
@endsection
                    {{-- // window.location.href = "{{ route('job.mysavedJobs') }}"; --}}