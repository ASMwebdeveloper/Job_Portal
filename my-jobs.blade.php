@extends('Frontend.Layoutes.app')

@section('main')

<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">My Jobs</li>
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

                <div class="card border-0 shadow mb-4 p-3">
                    <div class="card-body card-form">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="fs-4 mb-1">My Jobs</h3>
                            </div>
                            <div style="margin-top: -10px;">
                                <a href="{{ route('job.createJob') }}" class="btn btn-primary">Post a Job</a>
                            </div>

                        </div>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Update</th>
                                        <th scope="col">Applicants</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @if($jobs->isNotEmpty())
                                        @foreach($jobs as $job)
                                            <tr class="active">
                                                <td class="" style="width: 250px;">
                                                    <div class="job-name">{{ $job->title }}</div>
                                                    <div class="info1 d-flex flex-column gap-2">
                                                        <div>
                                                            <i class="text-lightgreen fa fa-tags" aria-hidden="true" style="rotate: 100deg; transform:translate(2px);"></i>
                                                            <span class="fs-6">{{ $job->jobType->name }}</span>
                                                        </div>
                                                        <div>
                                                            <i class="text-success fs-5 fa fa-map-marker" aria-hidden="true"></i>
                                                            <p class="fs-6 d-inline fst-italic text-secondary-emphasis">{{ $job->location }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="fw-bolder fs-6"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>
                                                        {{ \Carbon\Carbon::parse($job->updated_at)->format('d M, Y') }}
                                                    </div>
                                                    <div>
                                                        <span class="fw-bolder fs-6"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                                        {{$job->created_at->diffForHumans()}}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="fw-bolder fs-6"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                                        {{$job->updated_at->diffForHumans()}}
                                                    </div>
                                                </td>
                                                <td>0 Applications</td>
                                                <td>
                                                    <div class="job-status text-capitalize"  style="color:{{ ($job->status == 1) ? 'lightgreen' : '#FF3800' }};" >{{ ($job->status == 1) ? 'Active' : 'Block' }}</div>
                                                </td>
                                                <td>
                                                    <div class="action-dots float-end">
                                                        <button class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="{{ route('jobs.detail',$job->id) }}"> <i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                            <li><a class="dropdown-item" href="{{ route('job.editJob',$job->id) }}"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></li>
                                                            <li><a class="dropdown-item" href="#" onclick="deleteJob({{ $job->id }})"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>

                            </table>
                        </div>
                        <div>
                            {{ $jobs->links() }}
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
    // Remove alert after few seconds
    removeAfter('success',2000);

    function deleteJob(jobId){
        if (confirm("Are You sure you want to delete?")) {
            $.ajax({
                url: '{{ route("job.deleteJob") }}',
                type:'delete',
                dataType:'json',
                data:{ jobId:  jobId},
                success:function (response) {
                    window.location.href = "{{ route('job.myJobs') }}";
                }
            });
        }
    }
</script>
@endsection