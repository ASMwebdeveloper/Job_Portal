@extends('Frontend.Layoutes.app')

@section('main')

<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Job Details</li>
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
                <form action="" name="createJobForm" id="createJobForm">
                    <div id="showAlert" class="card border-0 shadow mb-4">
                         <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-1">Job Details</h3>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-2">Title<span class="req">*</span></label>
                                    <input type="text" placeholder="Job Title" id="title" name="title" class="form-control">
                                </div>
                                <div class="col-md-6  mb-4">
                                    <label for="" class="mb-2">Category<span class="req">*</span></label>
                                    <select name="category" id="category" class="form-select">
                                        <option value="" selected disabled>Select a Category</option>
                                        @if($categories->isNotEmpty())
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-2">Job Types<span class="req">*</span></label>
                                    <select name="jobType" id="jobType" class="form-select">
                                        <option value="" selected disabled>Select Job Type</option>
                                        @if($jobTypes->isNotEmpty())
                                            @foreach($jobTypes as $jobType)
                                                <option value="{{ $jobType->id }}">{{ $jobType->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6  mb-4">
                                    <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                    <input type="number" min="1" placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Salary</label>
                                    <input type="text" placeholder="Salary" id="salary" name="salary" class="form-control">
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Location<span class="req">*</span></label>
                                    <input type="text" placeholder="location" id="location" name="location" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-4 col-6">
                                    <label for="" class="mb-2">Experience<span class="req">*</span></label>
                                    <select name="experience" id="experience" class="form-select">
                                        <option selected disabled>Select Experience</option>
                                        @if($experiences->isNotEmpty())
                                            @foreach($experiences as $experience)
                                                <option value="{{ $experience->id }}">{{ $experience->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="mb-4 col-6">
                                    <label for="" class="mb-2">Keywords</label>
                                    <input type="text" placeholder="keywords" id="keywords" name="keywords" class="form-control">
                                </div>

                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Description<span class="req">*</span></label>
                                <textarea class="form-control" name="description" id="description" cols="5" rows="5" placeholder="Description"></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Benefits</label>
                                <textarea class="form-control" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits"></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Responsibility</label>
                                <textarea class="form-control" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility"></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Qualifications</label>
                                <textarea class="form-control" name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Qualifications"></textarea>
                            </div>


                            <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Name<span class="req">*</span></label>
                                    <input type="text" placeholder="Company Name" id="company_name" name="company_name" class="form-control">
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Location</label>
                                    <input type="text" placeholder="Location" id="company_location" name="company_location" class="form-control">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Website</label>
                                <input type="text" placeholder="Website" id="company_website" name="company_website" class="form-control">
                            </div>
                        </div>
                        <div class="card-footer  p-4">
                            <button type="submit" class="btn btn-primary saveBtn">Save Job</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customeJs')
<script type="text/javascript">
    $('#createJobForm').submit(function (e){
        e.preventDefault();
        // Add loader
        disableLoader('.saveBtn','text-light');

        $.ajax({
            url: '{{ route("job.save") }}',
            type:'post',
            dataType:'json',
            data:$("#createJobForm").serializeArray(),
            success:function (response) {
                if (response.status == false ) {
                    removeDisableLoader('.saveBtn','Save Job');
                    showAlert(response.message,'danger',7000);
                    handleValidationErrors(response.errors);
                }else{
                    removeErrors();
                    removeDisableLoader('.saveBtn','Save Job');
                    window.location.href = "{{ route('job.myJobs') }}";
                }

            }
        })
    })
</script>
@endsection