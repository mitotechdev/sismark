@extends('components.app.layouts')
@push('style')
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/upload.css') }}">
@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">My Profile</h4>
        @if ($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible text-black" role="alert">
            {{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endforeach
        <div class="card">
            <div class="card-header p-md-5 text-md-start text-center">
                <h5>Information</h5>
            </div>
            <div class="card-body px-md-5">
                <div class="row g-3">
                    <div class="col-md-2 col-sm-2 col-12 my-auto">
                        @if (Auth::user()->image)
                        <img src="{{ asset('storage/'. Auth::user()->image) }}" class="img-thumbnail rounded-circle border border-secondary" />
                        @else
                        <img src="{{ Vite::asset('resources/assets/img/avatars/avatar.png') }}" class="img-thumbnail rounded-circle border border-secondary"/>    
                        @endif
                    </div>
                    <div class="col-md-10 col-sm-10 col-12 my-md-auto text-center text-sm-start">
                        <h2 class="mb-0">{{ $user->full_name }}</h2>
                        <p class="mb-0">{{ $user->title }}</p>
                        @if (Auth::user()->image)
                            <form action="{{ route('user.image', Auth::user()->id) }}" method="POST" class="needs-validation form-destroy">
                                @csrf
                                @method('PUT')
                                <small><button type="submit" class="btn badge bg-label-danger rounded">Delete Image</button></small>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="row g-3 mt-md-3 mt-2">
                    <form class="needs-validation form-edit" action="{{ route('user.update', Auth::user()->id) }}" novalidate method="POST" enctype="multipart/form-data" id="uploadForm">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="employee_id" class="col-sm-2 col-form-label">Employee ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="employee_id" name="employee_id" title="Employee ID" placeholder="0323.07.6.1.1.065" value="{{ $user->employee_id }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="full_name" class="col-sm-2 col-form-label">Full Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="full_name" name="full_name" title="Full Name" placeholder="Tn. Toni Serf" value="{{ $user->full_name }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nick_name" class="col-sm-2 col-form-label">Nick Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nick_name" name="nickname" title="Nickname" placeholder="Toni" value="{{ $user->nickname }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title" title="Title of User" placeholder="Sales" value="{{ $user->title }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="title" class="col-sm-2 col-form-label">Role System</label>
                            <div class="col-sm-10">
                                <select class="form-select select-box" name="role" id="role" required title="Role in System">
                                    <option value="" selected>Choose Role...</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}" {{ $user->hasRole($role->id) ? "selected" : "" }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" title="Email User" placeholder="example@mitoindonesia.com" value="{{ $user->email }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="username" title="Username User" placeholder="toni.serf" value="{{ $user->username }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone" name="phone" title="Phone Number" placeholder="(+62 XXX XXXX XXXX)" value="{{ $user->phone_number }}" required>
                            </div>
                        </div>
                        @can('view-branch')
                        <div class="row mb-3">
                            <label for="title" class="col-sm-2 col-form-label">Branch</label>
                            <div class="col-sm-10">
                                <select class="form-select select-box" name="branch" id="branch" required title="Branch">
                                    <option value="" selected>Choose Branch...</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}" {{ $branch->id == $user->branch_id ? "selected" : "" }}>{{ $branch->code }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endcan
                        <div class="row mb-3">
                            <label for="image" class="col-sm-2 col-form-label">Photo</label>
                            <div class="col-sm-10">
                                <div class="hero">
                                    <label for="input-file" id="drop-area">
                                        <input type="file" accept="image/*" id="input-file" name="image" hidden>
                                        <div id="img-view">
                                            <div id="placeholder_image">
                                                <img src="{{ Vite::asset('resources/assets/img/elements/upload_icon.png') }}" alt="">
                                                <p>Drag and Drop or click here <br>to upload image</p>
                                                <span>Upload any images from desktop</span>
                                            </div>
                                        </div>
                                    </label>
                                    <div class="overlay-btn-delete">
                                        <button class="btn btn-outline-danger" id="btn_img_del"><i class='bx bx-trash-alt'></i></button>
                                    </div>
                                </div>
                                <small>Rekomendasi Upload foto anda dengan ukuran 200x200 (1:1)</small>
                            </div>
                        </div>
                        
                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="Pria" {{ $user->gender == "Pria" ? "checked" : "" }}>
                                    <label class="form-check-label" for="male">Pria</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="Perempuan" {{ $user->gender == "Perempuan" ? "checked" : "" }}>
                                    <label class="form-check-label" for="female">Perempuan</label>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row mb-3">
                            <div class="col-sm-10 offset-sm-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="valid" required>
                                    <label class="form-check-label" for="valid">Informasi yang saya berikan merupakan data benar</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    const dropArea = document.getElementById('drop-area');
    const inputFile = document.getElementById('input-file');
    const imgView = document.getElementById('img-view');
    const overlayBtnDelete = document.querySelector('.overlay-btn-delete');

    btn_img_del.addEventListener('click', clearImage);

    inputFile.addEventListener('change', uploadImage);

    function uploadImage() {
        let imgLink = URL.createObjectURL(inputFile.files[0]);
        imgView.style.backgroundImage = `url(${imgLink})`;
        placeholder_image.style.display = "none";
        // imgView.style.border = 0;
        overlayBtnDelete.classList.add("show");
    }

    dropArea.addEventListener('dragover', function(e) {
        e.preventDefault();

    });

    dropArea.addEventListener('drop', function(e) {
        e.preventDefault();
        inputFile.files = e.dataTransfer.files;
        uploadImage();
    });

    function clearImage(){
        imgView.style.backgroundImage = '';
        placeholder_image.style.display = "block";
        // imgView.style.border = "2px dashed #bbb5ff";
        inputFile.value = "";
        overlayBtnDelete.classList.remove("show");
    }
</script>

@endpush